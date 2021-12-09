<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\AnalyticsDataAPIRequest;
use App\Http\Utils\AppUtils;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isEmpty;

class AnalyticsDataAPIController extends AppBaseController
{
    public function getDataAnalytics(AnalyticsDataAPIRequest $request)
    {
        // @
        $data = $request->all();
        try {
            $farmId = $data['FarmID'];
            $deviceID = $data['DeviceID'];
            $plotId = $data['PlotID'];
            $date = $data['date'];
            $conditionAnalyticByFarm = 0;
            $result = DB::table('Sensing')
                ->select(DB::raw('round(AVG(SoilMoisture), 1) as SoilMoisture,
                round(AVG(Humidity), 1) as Humidity,
                round(AVG(Temperature), 1) as Temperature,
                round(AVG(LightLevel), 1) as LightLevel')
                );
            if ($deviceID) {
                $result->where('DeviceID', $deviceID);
            } else {
                $conditionAnalyticByFarm++;
            }
            if ($plotId) {
                $result->where('PlotID', $plotId);
            } else {
                $conditionAnalyticByFarm++;
            }
            $listPlotId = [];
            $analyticByFarm = false;
            if ($conditionAnalyticByFarm >= 2 && $farmId) {
                $listPlotId = DB::table('Plots')
                    ->where('Plots.status', AppUtils::PLOT_STATUS_ACTIVATE)
                    ->join('Farms', 'Farms.FarmID', '=', 'Plots.FarmID')
                    ->where([
                        'Farms.Status' => AppUtils::FARM_STATUS_ACTIVATE,
                        'Farms.FarmID' => $farmId
                    ])
                ->get()->pluck('PlotID');
                if (count($listPlotId)) {
                    $analyticByFarm = true;
                    $result->whereIn('PlotID', $listPlotId);
                }

            }
            if ($date) {
                $result->whereDate('TimeOfMeasurement', $date);
            }
            $result = $result->first();
            foreach ($result as $key => $value) {
                if ($result->$key == null) {
                    $result->$key = 0;
                }
            }
            $type = $data['type'];

            $dataSevenDays = $this->analyticDataSevenDayNearest($plotId, $deviceID, $date, $type, $analyticByFarm, $listPlotId);
            if ($dataSevenDays['success']) {
                $dataSevenDays = $dataSevenDays['data'];
                return $this->sendResponse([
                    'summary_data' => $result,
                    'seven_days' => $dataSevenDays
                ], 'Get data analytics success');
            } else {
                Log::error('AnalyticsDataAPIController@getDataAnalytics: Result get data analytics seven day nearest error');
                return $this->sendError('Get data analytics error', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

        } catch (Exception $ex) {
            Log::error('AnalyticsDataAPIController@getDataAnalytics:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Get data analytics error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function analyticDataSevenDayNearest($plotId, $deviceId, $date, $type, $analyticByFarm = false, $listPlotId = [])
    {
        $resultData = [
            'success' => false,
            'data' => ''
        ];
        $daySubtract = 6;
        try {
            if (!$date) {
                $date = Carbon::today()->format('Y-m-d');
            }
//            $today = '2020-05-02';
            $today = $date;
//            $sevenDayAgo = '2020-04-01';
            $sevenDayAgo = Carbon::parse($today)->subDays(6)->format('Y-m-d');
            $result = DB::table('Sensing')
                ->whereDate(
                    Db::raw('Date(TimeOfMeasurement)'), '>=', $sevenDayAgo)
                ->whereDate(Db::raw('Date(TimeOfMeasurement)'), '<=', $today)
                ->orderBy('dateMeasurement', 'ASC');

            if ($analyticByFarm) {
                $result->whereIn('PlotID', $listPlotId);
            } else {
                if ($plotId) {
                    $result->where('PlotID', $plotId);
                }
                if ($deviceId) {
                    $result->where('DeviceID', $deviceId);
                }
            }

            $columnSelect = [
                DB::raw('DATE(TimeOfMeasurement) as dateMeasurement')
            ];

            if ($type == AppUtils::ANALYTIC_DATA_TYPE_SOIL_MOISTURE) {
                $columnSelect[] = DB::raw('round(AVG(SoilMoisture), 1) as SoilMoisture');
                $columnPluck = 'SoilMoisture';
            } elseif ($type == AppUtils::ANALYTIC_DATA_TYPE_HUMIDITY) {
                $columnSelect[] = DB::raw('round(AVG(Humidity), 1) as Humidity');
                $columnPluck = 'Humidity';
            } elseif ($type == AppUtils::ANALYTIC_DATA_TYPE_LIGHT_LEVEL) {
                $columnSelect[] = DB::raw('round(AVG(LightLevel), 1) as LightLevel');
                $columnPluck = 'LightLevel';
            } else {
                // default AppUtils::ANALYTIC_DATA_TYPE_TEMPERATURE
                $columnSelect[] = DB::raw('round(AVG(Temperature), 1) as Temperature');
                $columnPluck = 'Temperature';
            }
            $result = $result->select($columnSelect)
                ->groupBy('dateMeasurement')
                ->get();

            $xAxis = [];
            $data = [];
            for ($i = $daySubtract; $i >= 0; $i-- ) {
                $currentDay = Carbon::parse($today)->subDays($i);
                $currentDayString = $currentDay->format('Y-m-d');
                $xAxis[]  = $currentDayString;
                $resultCurrentDay = $result->firstWhere('dateMeasurement', $currentDayString);
                if ($resultCurrentDay) {
                    $data[] = $resultCurrentDay->$columnPluck;
                } else {
                    $data[] = 0;
                }


            }


            $resultData['success'] = true;
            $resultData['data'] = [
                'data' => $data,
                'xAxis' => $xAxis,
                'series_name' => $columnPluck
            ];

            return $resultData;
        } catch (Exception $ex) {
            Log::error('AnalyticsDataAPIController@analyticDataSevenDayNearest:' . $ex->getMessage().$ex->getTraceAsString());
            return $resultData;
        }

    }
}
