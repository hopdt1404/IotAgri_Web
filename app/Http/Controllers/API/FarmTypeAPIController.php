<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\FarmType;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FarmTypeAPIController extends AppBaseController
{
    protected $model;
    public function __construct(FarmType $farmType)
    {
        $this->model = $farmType;
    }

    public function index()
    {
        try {
            $data = $this->model->get();
            return $this->sendResponse($data, 'Get farm_type success');
        } catch (\Exception $ex) {
            Log::error('FarmTypeAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function tamp() {

    }
}
