<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\GetDeviceAssignForPlantOfFarm;
use App\Http\Requests\API\GetListDeviceSelectOfFarmPlantAPIRequest;
use App\Http\Utils\AppUtils;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\API\CreateDeviceAPIRequest;

class DeviceAPIController extends AppBaseController
{
    protected $model;
    public function __construct(Device $device)
    {
        $this->model = $device;
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
            $device = DB::table('Devices')
                ->leftJoin('DeviceTypes', 'Devices.DeviceTypeID',
                    '=', 'DeviceTypes.DeviceTypeID')
                ->where(['user_id' => $user->id])
                ->leftJoin('Plots',
                'Devices.PlotID', '=', 'Plots.PlotID')
                ->leftJoin('Farms',
                'Devices.FarmID', '=', 'Farms.FarmID')
                ->select('Devices.DeviceID',
                    'Devices.DeviceName',
                    'DeviceTypes.DeviceType',
                    'Devices.Status',
                    'Plots.name as plot_name',
                    'Farms.name as farm_name'
                )->get();
            return $this->sendResponse($device, 'Get device success');
        } catch (\Exception $ex) {
            Log::error('DeviceAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    public function getListDeviceAdmin(Request $request) {
        try {
            $user = $request->user();
            $device = [];
            if ($user->group_user_id === 1) {
                $device = DB::table('Devices')
                    ->leftJoin('DeviceTypes', 'Devices.DeviceTypeID',
                        '=', 'DeviceTypes.DeviceTypeID')
                    ->select('Devices.*', 'DeviceTypes.DeviceType')->get();
            }
            return $this->sendResponse($device, 'Get device success');
        } catch (\Exception $ex) {
            Log::error('DeviceAPIController@getListDeviceAdmin:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getListUserCanOwnerDevice (Request $request) {
        try {
            $user = $request->user();
            $listUser = [];
            if ($user->group_user_id === 1) {
                $listUser = DB::table('users')
                    ->where([
                        'users.group_user_id' => AppUtils::GROUP_USER
                    ])
                    ->select('users.id', 'users.name')->get();
            }
            return $this->sendResponse($listUser, '');
        } catch (\Exception $ex) {
            Log::error('DeviceAPIController@getListUserCanOwnerDevice:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDeviceAPIRequest $request)
    {
        $user = $request->user();
        $data = $request->all();
        try {
            $device['DeviceName'] = $data['DeviceName'];
            $device['DeviceTypeID'] = $data['DeviceTypeID'];
            $device['Status'] = $data['Status'];
            $device['PlotID'] = isset($data['PlotID']) ? $data['PlotID'] : 1;
            $device['FarmID'] = isset($data['FarmID']) ? $data['FarmID'] : null;

            $device['created_user'] = $user->email;
            $device['created_at'] = Carbon::now();
            $device['user_id'] = isset($data['user_id']) ? $data['user_id'] : $user->id;
            DB::transaction(function () use ($device, $data, $user) {
//                $this->model->insert($device);
                $id = $this->model->insertGetId($device);
                $plantDevice = DB::table('plant_devices')
                    ->where(['DeviceID' => $id])
                    ->first();
                $status = 0;
                if (isset($data['plant_id']) && isset($data['FarmID'])) {
                    $status = 1;
                }
                if(isset($data['plant_id'])) {
                    if (isset($plantDevice)) {
                        DB::table('plant_devices')
                            ->where(['DeviceID' => $id])
                            ->update([
                                'plant_id' => $data['plant_id'],
                                'FarmID' => $data['FarmID'],
                                'status' => $status,
                                'updated_user' => $user->email,
                                'updated_at' => Carbon::now()
                            ]);
                    } else {
                        DB::table('plant_devices')
                            ->insert([
                                'DeviceID' => $id,
                                'plant_id' => $data['plant_id'],
                                'FarmID' => $data['FarmID'],
                                'status' => $status,
                                'created_user' => $user->email,
                                'created_at' => Carbon::now()
                            ]);
                    }

                }

            });

            return $this->sendSuccess('Success create data');
        } catch (Exception $ex) {
            Log::error('DeviceAPIController@store:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
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
                'DeviceID' => $id,
            ]);
            if ($user->group_user_id === AppUtils::GROUP_USER) {
               $data->where([
                   'user_id' => $user->id
               ]);
            }
            $data = $data->select('DeviceID',
                    'DeviceName',
                    'DeviceTypeID',
                    'FarmID',
                    'PlotID',
                    'Status',
            )->first();
            return $this->sendResponse($data, 'Get device detail success');
        } catch (\Exception $ex) {
            Log::error('DeviceAPIController@show:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Todd: Coding
    public function update(CreateDeviceAPIRequest $request, $id)
    {
        $user = $request->user();
        $data = $request->all();

        try {
            $updated_at = Carbon::now();
//            $device['DeviceName'] = $data['DeviceName'];
//            $device['DeviceTypeID'] = $data['DeviceTypeID'];
//            $device['Status'] = $data['Status'];
            $device['PlotID'] = isset($data['PlotID']) ? $data['PlotID'] : null;
            $device['FarmID'] = isset($data['FarmID']) ? $data['FarmID'] : null;

            $updated_user = $user->email;
            $device['updated_at'] = $updated_at;
            $device['updated_user'] = $updated_user;

            $userId = isset($data['user_id']) ? $data['user_id'] : $user->id;
            DB::transaction(function () use ($id, $user, $device, $data, $userId){
                $this->model->where([
                    'DeviceID' => $id,
                    'user_id' => $userId
                ])->update($device);


                // Todo: not use table: plant_devices
//                $plantDevice = DB::table('plant_devices')
//                    ->where(['DeviceID' => $id])
//                    ->first();
//                $status = 0;
//                if (isset($data['plant_id']) && isset($data['FarmID'])) {
//                    $status = 1;
//                }
//                if (isset($data['plant_id'])) {
//                    if(isset($plantDevice)) {
//                        DB::table('plant_devices')
//                            ->where(['DeviceID' => $id])
//                            ->update([
//                                'plant_id' => $data['plant_id'],
//                                'FarmID' => $data['FarmID'],
//                                'status' => $status,
//                                'updated_user' => $user->email,
//                                'updated_at' => Carbon::now()
//                            ]);
//                    } else {
//                        // insert
//                        DB::table('plant_devices')
//                            ->insert([
//                                'DeviceID' => $id,
//                                'plant_id' => $data['plant_id'],
//                                'FarmID' => $data['FarmID'],
//                                'status' => $status,
//                                'created_user' => $user->email,
//                                'created_at' => Carbon::now()
//                            ]);
//                    }
//
//                }

            });

            return $this->sendSuccess('Success update data');
        } catch (Exception $ex) {
            Log::error('DeviceAPIController@update:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getDeviceSettingFarm (Request $request)
    {
        $user = $request->user();
        try {
             $data = $this->model->where([
                'user_id' => $user->id,
                'FarmId' => null
            ])->select('DeviceID', 'DeviceName')->get();
            return $this->sendResponse($data, 'Success get list device select');
        } catch (Exception $ex) {
            Log::error('DeviceAPIController@getDeviceSettingFarm:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getDeviceOfFarm (Request $request)
    {
        $data = $request->all();
        $user = $request->user();
        try {
            $result = $this->model->where([
                'FarmID' => $data['FarmID'],
                'user_id' => $user->id
            ])->select('DeviceID as id', 'DeviceName as name')->get();
            return $this->sendResponse($result, 'Success get device of farm');
        } catch (Exception $ex) {
            Log::error('DeviceAPIController@getDeviceOfFarm:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * plant_devices.plant_id = plant_id,
     * plant_devices.FarmID = FarmID,
     * plant_devices.user_id = user_id,
     * Inner join plant_devices - Devices where id = id
     */
    public function getListDeviceSelectOfFarmPlant(GetListDeviceSelectOfFarmPlantAPIRequest $request)
    {
        $data = $request->all();
        try {
            $farmId = $data['FarmID'];
            $plantId = $data['plant_id'];

            $device = DB::table('Devices')
                ->where('Devices.FarmID', $farmId)
                ->join('farm_plants',
                    'farm_plants.FarmID', '=',
                    'Devices.FarmID')
                ->where('farm_plants.plant_id', $plantId)
                // get device assign for plant_id of not (Left Join)
//                ->join('plant_devices',
//                    'plant_devices.plant_id', '=',
//                    'farm_plants.plant_id')
                ->select('Devices.DeviceID', 'Devices.DeviceName')
                ->get();
            return $this->sendResponse($device, 'Get getListDeviceSelectOfFarmPlant success');
        } catch (Exception $ex) {
            Log::error('DeviceAPIController@getListDeviceSelectOfFarmPlant:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getDeviceAssignForPlantFarm(GetDeviceAssignForPlantOfFarm $request)
    {
        $data = $request->all();
        Log::info('getDeviceAssignForPlantFarm');
        Log::info('$data');
        Log::info($data);
        try {
            $farmId = $data['FarmID'];
            $plantId = $data['plant_id'];
            $device = DB::table('Devices')
                ->where('Devices.FarmID', $farmId)
                ->join('plant_devices', function ($join) {
                   $join->on('plant_devices.DeviceID', '=', 'Devices.DeviceID');
                   $join->on('plant_devices.FarmID', '=', 'Devices.FarmID');
                })->where('plant_devices.plant_id', $plantId)->get();
            return $this->sendResponse($device, 'Get getDeviceAssignForPlantFarm success');
        } catch (Exception $ex) {
            Log::error('DeviceAPIController@getDeviceAssignForPlantFarm:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function getFarmAssignedDevice(Request $request, $deviceId)
    {
        try {
            $farm = DB::table('Devices')
                ->where('Devices.DeviceID', $deviceId)
                ->join('Farms', 'Farms.FarmID',
                '=', 'Devices.FarmID')
                ->select('Farms.FarmID', 'Farms.name')->first();

            return $this->sendResponse($farm, 'Get getFarmAssignedDevice success');
        } catch (Exception $ex) {
            Log::error('DeviceAPIController@getFarmAssignedDevice:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
