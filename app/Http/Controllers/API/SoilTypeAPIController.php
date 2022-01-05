<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\SoilType;

class SoilTypeAPIController extends AppBaseController
{
    protected $model;
    public function __construct(SoilType $soilType)
    {
        $this->model = $soilType;
    }

    public function index()
    {
        try {
            $data = $this->model->get();
            return $this->sendResponse($data, 'Get soil_type success');
        } catch (\Exception $ex) {
            Log::error('FarmTypeAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
