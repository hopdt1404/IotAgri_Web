<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Locate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LocateAPIController extends AppBaseController
{
    protected $model;
    public function __construct(Locate $locate)
    {
        $this->model = $locate;
    }

    public function index()
    {
        try {
            $data = $this->model
                ->select('LocateID',
                'LocateName')
                ->orderBy('LocateName', 'asc')
                ->get();
            return $this->sendResponse($data, 'Get Locate success');
        } catch (\Exception $ex) {
            Log::error('LocateAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
