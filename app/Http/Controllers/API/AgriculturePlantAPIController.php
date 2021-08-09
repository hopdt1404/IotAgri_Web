<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\AgriculturePlant;
use App\Http\Requests\API\CreateAgriculturePlantAPIRequest;
use App\Http\Requests\API\GetAgriculturePlantDetailAPIRequest;
use App\Http\Requests\API\SavePlantAgricultureAPIRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AgriculturePlantAPIController extends AppBaseController
{
    protected $model;
    public function __construct(AgriculturePlant $agriculturePlant)
    {
        $this->model = $agriculturePlant;
    }

    public function index()
    {

    }

    public function store(CreateAgriculturePlantAPIRequest $request)
    {
        $data = $request->all();
        $user = $request->user();
        try {
            $data['user_id'] = $user->id;
            $data['created_at'] = Carbon::now();
            $data['created_user'] = $user->email;
            $result['id'] = $this->model->insertGetId($data);
            return $this->sendResponse($result, 'Success create data agriculture plant');
        } catch (Exception $ex) {
            Log::error('AgriculturePlantAPIController@store:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(CreateAgriculturePlantAPIRequest $request, $id)
    {
        $user = $request->user();
        $data = $request->all();
        $data['updated_at'] = Carbon::now();
        try {
            $data['updated_user'] = $user->email;
            $this->model->where([
                'id' => $id,
                'user_id' => $user->id,
                'FarmID' => $data['FarmID'],
                'plant_state_id' => $data['plant_state_id']
            ])->update($data);
            return $this->sendSuccess('Success agriculture data');
        } catch (Exception $ex) {
            Log::error('AgriculturePlantAPIController@update:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(GetAgriculturePlantDetailAPIRequest $request, $id)
    {
        $user = $request->user();
        $data = $request->all();
        try {

            $result = $this->model->where([
                'FarmID' => $id,
                'plant_id' => $data['plant_id'],
                'plant_state_id' => $data['plant_state_id'],
                'user_id' => $user->id,
            ])->first();
            return $this->sendResponse($result, 'Get agriculture plant detail success');
        } catch (\Exception $ex) {
            Log::error('AgriculturePlantAPIController@show:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function getPlantAgricultureManagement (Request $request)
    {
        $user = $request->user();


        try {
            // Todo: order by
            $farm = DB::table('Farms')
                ->where([
                    'UserID' => $user->id
                ])->select('name', 'FarmID', 'LocateID');
//            $stateInfo =
            $farmPlant = DB::table('farm_plants')
                ->where([
                    'user_id' => $user->id,
                ])->leftJoinSub($farm, 'Farms',
                'Farms.FarmID', '=', 'farm_plants.FarmID')
                ->leftJoin('plants', 'plants.id', '=', 'farm_plants.plant_id')

//                ->leftJoin('plant_states', 'farm_plants.plant_state')
                ->select('farm_plants.*', 'plants.name AS plant_name', 'Farms.name AS farm_name')
                ->orderBy('farm_plants.created_at', 'desc')->get();
            return $this->sendResponse($farmPlant, 'Get plant agriculture management success');
        } catch (\Exception $ex) {
            Log::error('AgriculturePlantAPIController@getPlantAgricultureManagement:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getPlantAgricultureDetail(Request $request, $id) {
        $data = $request->all();
        $user = $request->user();
        try {
            $data = DB::table('farm_plants')
                ->where([
                    'id' => $id,
                    'plant_id' => $data['plant_id'],
                    'FarmID' => $data['FarmID'],
                    'user_id' => $user->id
                ])->first();
            return $this->sendResponse($data, 'Get plant agriculture detail success');
        } catch (\Exception $ex) {
            Log::error('AgriculturePlantAPIController@getPlantAgricultureDetail:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function savePlantAgriculture(SavePlantAgricultureAPIRequest $request, $id) {
        $data = $request->all();
        $user = $request->user();
        Log::info('$data');
        Log::info($data);
        try {
            DB::transaction(function () use ($id, $data, $user) {
                $plantDevice = $data['plant_device_ids'];
                $plantId = $data['plant_id'];
                $farmId = $data['FarmID'];
                $userId = $user->id;
                DB::table('farm_plants')->where([
                    'id' => $id,
                    'FarmID' => $farmId,
                    'plant_id' => $plantId,
                    'user_id' => $userId
                ])->update([
                    'start_time_season' => $data['start_time_season'],
                    'end_time_season' => $data['end_time_season'],
                    'current_growth_day' => $data['current_growth_day'],
                    'current_plant_state' => $data['current_plant_state'],
                    'total_growth_day' => $data['total_growth_day'],
                    'status' => $data['status'],
                    'updated_at' => Carbon::now(),
                    'updated_user' => $user->email
                ]);
                if (count($plantDevice) > 0) {
                    $listPlantDeviceSave = [];
                    // save new
                    foreach ($plantDevice as $deviceId) {
                        $record['plant_id'] = $plantId;
                        $record['DeviceID'] = $deviceId;
                        $record['FarmID'] = $farmId;
                        $record['status'] = 1;
                        $record['created_at'] = Carbon::now();
                        $record['created_user'] = $user->email;

                        array_push($listPlantDeviceSave, $record);
                    }
                    Db::table('plant_devices')->insert($listPlantDeviceSave);
                }

            });

            return $this->sendSuccess('Save plant agriculture success');
        } catch (\Exception $ex) {
            Log::error('AgriculturePlantAPIController@getPlantAgricultureDetail:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
