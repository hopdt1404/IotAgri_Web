<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Farm;
use App\Http\Requests\API\CreateFarmAPIRequest;
use App\Http\Requests\API\SettingFarmAPIRequest;
use App\Http\Utils\AppUtils;

class FarmAPIController extends AppBaseController
{
    protected $model;
    public function __construct(Farm $farm)
    {
        $this->model = $farm;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $farm = DB::table('Farms')
                ->leftJoin('FarmTypes', 'Farms.FarmTypeID',
                    '=', 'FarmTypes.FarmTypeID')
                ->leftJoin('Locates', 'Farms.LocateID',
                    '=', 'Locates.LocateID')
                ->where(['UserID' => $user->id])
                ->select('Farms.FarmID',
                    'Farms.Area',
                    'Farms.name',
                    'Farms.Status',
                    'FarmTypes.FarmType',
                    'Locates.LocateName')
                ->get();
            return $this->sendResponse($farm, 'Get list farm success');
        } catch (\Exception $ex) {
            Log::error('FarmAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError("Get list farm error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFarmAPIRequest $request)
    {
        $user = $request->user();
        $data = $request->all();
        try {
            $data['created_user'] = $user->email;
            $data['created_at'] = Carbon::now();
            $data['UserID'] = $user->id;
            $this->model->insert($data);
            return $this->sendSuccess('Success create farm');
        } catch (Exception $ex) {
            Log::error('FarmAPIController@store:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError("Error create farm", Response::HTTP_INTERNAL_SERVER_ERROR);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $user = $request->user();
            $data = $this->model->where([
                'FarmID' => $id,
                'UserID' => $user->id
            ])->select(
                'FarmID',
                'name',
                'Area',
                'LocateID',
                'FarmTypeID',
                'Status',
                'info',
            )->first();
            return $this->sendResponse($data, 'Get farm detail success');
        } catch (\Exception $ex) {
            Log::error('FarmAPIController@show:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Get farm detail error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateFarmAPIRequest $request, $id)
    {
        $user = $request->user();
        $data = $request->all();
        $data['updated_at'] = Carbon::now();
        try {
            $data['updated_user'] = $user->email;
            $this->model->where([
                'FarmID' => $id,
                'UserID' => $user->id
            ])->update($data);
            return $this->sendSuccess('Success update farm info');
        } catch (Exception $ex) {
            Log::error('FarmAPIController@update:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Error update farm info', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setting (SettingFarmAPIRequest $request)
    {
        $data = $request->all();
        $user = $request->user();
        DB::beginTransaction();
        try {
            $farmId = $data['FarmID'];
            $deviceIds = $data['deviceIds'];
            $plantIds = $data['plantIds'];

            // unset all device of farmId
            DB::table('Devices')->where([
               'user_id' => $user->id,
                'FarmID' => $farmId
            ])->whereNotIn(
                'DeviceID', $deviceIds
            ) ->update([
                'FarmID' => null,
                'updated_at' => Carbon::now(),
                "updated_user" => $user->email
            ]);

            if (count($deviceIds) > 0 ) {
                DB::table('Devices')
                    ->whereIn('DeviceID', $deviceIds)
                    ->update([
                        'FarmID' => $farmId,
                        'updated_at' => Carbon::now(),
                        'updated_user' => $user->email
                    ]);
            }

            // Delete data from table farm_plant then insert new record
            DB::table('farm_plants')->where([
                'user_id' => $user->id,
                'FarmID' => $farmId
            ])->whereNotIn('plant_id', $plantIds)
            ->update([
                'FarmID' => null,
                'updated_at' => Carbon::now(),
//                'status' => AppUtil::FARM_PLANT_DEACTIVATE_STATUS,
                'status' => AppUtils::FARM_PLANT_DEACTIVATE_STATUS,
                'updated_user' => $user->email
            ]);

            // update record exited
            $farmPlantUpdateIds = DB::table('farm_plants')->where([
                'user_id' => $user->id,
                'FarmID' => $farmId
            ])->whereIn('plant_id', $plantIds)->pluck('plant_id')->toArray();
            DB::table('farm_plants')
                ->where([
                    'user_id' => $user->id,
                    'FarmID' => $farmId
                ])->whereIn('plant_id', $farmPlantUpdateIds)
                ->update([
                    'updated_user' => $user->email,
                    'updated_at' => Carbon::now(),
                    'status' => AppUtils::FARM_PLANT_INIT_STATUS,
                ]);

            $farmPlantInsertIds = array_diff($plantIds, $farmPlantUpdateIds);

            $farmPlantInsertData = [];
            foreach ($farmPlantInsertIds as $plantId) {
                $record['FarmID'] = $farmId;
                $record['plant_id'] = $plantId;
                $record['user_id'] = $user->id;
                $record['created_at'] = Carbon::now();
                $record['created_user'] = $user->email;
                $record['current_growth_day'] = 0;
                $record['total_growth_day'] = 0;
                $record['status'] = AppUtils::FARM_PLANT_INIT_STATUS;
                array_push($farmPlantInsertData, $record);
            }
            DB::table('farm_plants')->insert($farmPlantInsertData);

            DB::commit();
            return $this->sendSuccess('Success setting farm');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error('FarmAPIController@setting:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    public function getFarmAgricultureSetting(Request $request)
    {
        $user = $request->user();
        try {
            $devices = DB::table('Devices')
                ->where([
                    'user_id' => $user->id,
                    ['FarmID', '<>', 'null']
                ])->groupBy('FarmID')
                ->selectRaw('FarmID, COUNT(DeviceID) AS number_device');
            $plant = DB::table('Plots')
                ->where([
                    'Plots.status' => AppUtils::PLOT_STATUS_ACTIVATE
                ])->groupBy('FarmID')
                ->selectRaw('FarmID, count(plant_id) as number_plant, count(PlotID) as number_plot');

            $farm = DB::table('Farms')
                ->where(['UserID' => $user->id])
                ->leftJoinSub(
                    $devices, 'Devices',
                    'Farms.FarmID', '=', 'Devices.FarmID')
                ->leftJoinSub($plant, 'plants',
                'plants.FarmID', '=', 'Farms.FarmID' )
                ->leftJoin('FarmTypes', 'Farms.FarmTypeID',
                    '=', 'FarmTypes.FarmTypeID')
                ->leftJoin('Locates',
                'Farms.LocateID', '=', 'Locates.LocateID')
                ->select('Farms.FarmID',
                    'Farms.name',
                    'Devices.number_device',
                    'plants.number_plot',
                    'plants.number_plant',
                    'Locates.LocateName',
                    'FarmTypes.FarmType')
                ->get();
            foreach ($farm as $item) {
                if (!$item->number_device) {
                    $item->number_device = 0;
                }
                if (!$item->number_plant) {
                    $item->number_plant = 0;
                }
                if (!$item->number_plot) {
                    $item->number_plot = 0;
                }
            }
            return $this->sendResponse($farm, 'Get farm agriculture setting success');
        } catch (\Exception $ex) {
            Log::error('FarmAPIController@getFarmAgricultureSetting:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getListFarmOfUser(Request $request)
    {
        $user = $request->user();
        try {
            Log::info('$user');
            Log::info($user);
            $data = $this->model->where([
                'UserID' => $user->id
            ])->select('FarmID', 'name')->get();
            return $this->sendResponse($data, 'Get list farm user success');
        } catch (\Exception $ex) {
            Log::error('FarmAPIController@getListFarmOfUser:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getListFarmSelect (Request $request) {
        $user = $request->user();
        try {
            $farms = DB::table('Farms')
                ->where([
                   'UserID' => $user->id
                ])->select('FarmID', 'name')->get();
            return $this->sendResponse($farms, 'Get list farm select success');
        }catch (\Exception $ex) {
            Log::error('FarmAPIController@listFarmSelect:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Get list farm select error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
