<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\GetPlantAgricultureDetailAPIRequest;
use App\Http\Utils\AppUtils;
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
                'PlotID' => $data['PlotID'],
                'plant_id' => $data['plant_id'],
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
                'PlotID' => $id,
                'plant_id' => $data['plant_id'],
                'plant_state_id' => $data['plant_state_id'],
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
            $farm = DB::table('Farms')
                ->where([
                    'UserID' => $user->id,
                    'Status' => AppUtils::FARM_PLANT_ACTIVATE_STATUS
                ])->select('name', 'FarmID', 'LocateID');
            $farmPlant = DB::table('Plots')
                ->joinSub($farm, 'Farms',
                'Plots.FarmID', '=', 'Farms.FarmID')
                ->where([
                    'Plots.status' => AppUtils::PLOT_STATUS_ACTIVATE
                ])->join('plants',
                'plants.id', '=', 'Plots.plant_id')
                ->leftJoin('farm_plants',function ($join) {
                    $join->on('farm_plants.PlotID', '=', 'Plots.PlotID');
                    $join->on('farm_plants.plant_id', '=', 'Plots.plant_id');
                })->orderBy('Plots.FarmID')
                ->select(
                    'plants.name as plant_name',
                    'plants.id as plant_id',
                    'Farms.name as farm_name',
                    'Farms.FarmID',
                    'Plots.name as plot_name',
                    'Plots.PlotID as plot_id',
                    'farm_plants.status',
                    'farm_plants.id',
                    'farm_plants.start_time_season',
                    'farm_plants.end_time_season',
                )->get();
            return $this->sendResponse($farmPlant, 'Get plant agriculture management success');
        } catch (\Exception $ex) {
            Log::error('AgriculturePlantAPIController@getPlantAgricultureManagement:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getPlantAgricultureDetail(GetPlantAgricultureDetailAPIRequest $request) {
        $data = $request->all();
        try {
            $result = DB::table('farm_plants')
                ->where([
                    'plant_id' => $data['plant_id'],
                    'PlotID' => $data['PlotID'],
                ]);
            if (isset($data['id'])) {
                $result->where([
                    'id' => $data['id']
                ]);
            }
            $result = $result->first();
            return $this->sendResponse($result, 'Get plant agriculture detail success');
        } catch (\Exception $ex) {
            Log::error('AgriculturePlantAPIController@getPlantAgricultureDetail:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
