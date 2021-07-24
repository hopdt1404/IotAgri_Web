<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\AgriculturePlant;
use App\Http\Requests\API\CreateAgriculturePlantAPIRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AgriculturePlantAPIController extends AppBaseController
{
    protected $model;
    public function __construct(AgriculturePlant $agriculturePlant)
    {
        $this->model = $agriculturePlant;
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
}
