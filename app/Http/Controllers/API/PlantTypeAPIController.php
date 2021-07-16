<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\PlantType;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PlantTypeAPIController extends Controller
{
    protected $model;
    public function __construct(PlantType $plantType)
    {
        $this->model = $plantType;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->model->get();
            return $this->sendResponse($data, 'Get device_type success');
        } catch (\Exception $ex) {
            Log::error('PlantTypeAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }}
