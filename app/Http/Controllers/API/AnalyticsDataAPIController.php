<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\AnalyticsDataAPIRequest;
use http\Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isEmpty;

class AnalyticsDataAPIController extends AppBaseController
{
    public function getDataAnalytics(AnalyticsDataAPIRequest $request)
    {
        $data = $request->all();
        try {
            $deviceID = isset($data['DeviceID']) ? $data['DeviceID'] : null ;
            $plotId = isset($data['PlotID']) ?  $data['PlotID'] : null;
            $date = $data['date'];
            if (!$date) {
                $date = '2020-04-20';
            }
            $result = DB::table('Sensing')
                ->select(DB::raw('AVG(SoilMoisture) as SoilMoisture,
                AVG(Humidity) as Humidity,
                AVG(Temperature) as Temperature,
                AVG(LightLevel) as LightLevel')
                );
            if ($deviceID) {
                $result->where('DeviceID', $deviceID);
            }
            if ($plotId) {
                $result->where('PlotID', $plotId);
            }
            if ($date) {
                $result->whereDate('TimeOfMeasurement', $date);
            }
            $result = $result->first();
            foreach ($result as $key => $value) {
                if ($result->$key == null) {
                    $result->$key = 0;
                } else {
                    $result->$key = round($result->$key, 1);
                }
            }
            return $this->sendResponse($result, 'Get data analytics success');
        } catch (Exception $ex) {
            Log::error('AnalyticsDataAPIController@getDataAnalytics:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Get data analytics error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
