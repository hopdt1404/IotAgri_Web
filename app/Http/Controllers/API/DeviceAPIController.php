<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DeviceAPIController extends AppBaseController
{
    protected $model;
    public function __construct(Device $device)
    {
        $this->model = $device;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $device = $this->model->where(
                ['user_id' => $user->id]
            )->get();
            return $this->sendResponse($device, 'Get device success');
        } catch (\Exception $ex) {
            Log::error('DeviceAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
