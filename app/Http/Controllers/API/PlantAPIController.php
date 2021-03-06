<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Plant;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\API\CreatePlantAPIRequest;

class PlantAPIController extends AppBaseController
{
    protected $model;
    public function __construct(Plant $plant)
    {
        $this->model = $plant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $plant = DB::table('plants')
                ->leftJoin('soil_types', 'plants.soil_type_id', '=', 'soil_types.id')
                ->leftJoin('plant_types', 'plants.plant_type_id', '=', 'plant_types.id')
                ->orderby('plants.created_at', 'desc')
                ->select('plants.id',
                    'plants.name',
                    'plants.growth_period',
                    'soil_types.name AS soil_type',
                    'plant_types.name AS plant_type') ->get();
            return $this->sendResponse($plant, 'Get plant success');
        } catch (\Exception $ex) {
            Log::error('PlantAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Get plant error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $data = $request->all();
        try {
            $data['created_user'] = $user->email;
            $data['created_at'] = Carbon::now();
            $this->model->insert($data);
            return $this->sendSuccess('Success create data');
        } catch (Exception $ex) {
            Log::error('PlantAPIController@store:' . $ex->getMessage().$ex->getTraceAsString());
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
            $data = $this->model->where([
                'id' => $id,
            ])->first();
            return $this->sendResponse($data, 'Get plant detail success');
        } catch (\Exception $ex) {
            Log::error('PlantAPIController@show:' . $ex->getMessage().$ex->getTraceAsString());
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
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $data = $request->all();
        $data['updated_at'] = Carbon::now();
        try {
            $data['updated_user'] = $user->email;
            $this->model->where([
                'id' => $id
            ])->update($data);
            return $this->sendSuccess('Success update data');
        } catch (Exception $ex) {
            Log::error('PlantAPIController@update:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getPlantSettingFarm ()
    {
        try {
            $data = $this->model->select('id', 'name')->get();
            return $this->sendResponse($data, 'Success get plant setting farm');
        } catch (Exception $ex) {
            Log::error('PlantAPIController@getPlantSettingFarm:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Error get plant setting farm', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getPlantOfFarm(Request $request)
    {
        $data = $request->all();
        $user = $request->user();
        try {
            $result = DB::table('Plots')->where([
                'FarmID' => $data['FarmID'],
                'PlotID' => $data['PlotID']
            ])->join('plants', 'plants.id', '=', 'Plots.plant_id')
                ->select('Plots.plant_id as id', 'plants.name')->get();
            return $this->sendResponse($result, 'Success get plant of farm');
        } catch (Exception $ex) {
            Log::error('PlantAPIController@getPlantOfFarm:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getPlantAssignOfDevice(Request $request) {
        $data = $request->all();
        $user = $request->user();
        try {
            $result = DB::table('plant_devices')->where([
                'plant_devices.DeviceID' => $data['DeviceID'],
                'plant_devices.FarmID' => $data['FarmID']
            ])->join('plants','plant_devices.plant_id',
                '=', 'plants.id')
            ->select('plants.id', 'plants.name')->first();
            return $this->sendResponse($result, 'Success getPlantAssignOfDevice');
        } catch (Exception $ex) {
            Log::error('PlantAPIController@getPlantAssignOfDevice:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
