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
            $this->model->insert($data);
            return $this->sendSuccess('Success create data agriculture plant');
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
}
