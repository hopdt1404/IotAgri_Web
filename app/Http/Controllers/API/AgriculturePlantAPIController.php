<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\AgriculturePlant;
use App\Http\Requests\API\CreateAgriculturePlantAPIRequest;
use App\Http\Requests\API\GetAgriculturePlantDetailAPIRequest;
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
        Log::info('$data');
        Log::info($data);
    }
}
