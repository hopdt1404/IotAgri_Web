<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\API\CreateDeviceAPIRequest;

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
//            $device = $this->model->where(
//                ['user_id' => $user->id]
//            )->get();
            $device = DB::table('Devices')
                ->leftJoin('DeviceTypes', 'Devices.DeviceTypeID',
                    '=', 'DeviceTypes.DeviceTypeID')
                ->where(['user_id' => $user->id])
                ->select('Devices.*', 'DeviceTypes.DeviceType')->get();
            return $this->sendResponse($device, 'Get device success');
        } catch (\Exception $ex) {
            Log::error('DeviceAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDeviceAPIRequest $request)
    {
        $user = $request->user();
        $data = $request->all();
        try {
            $data['created_user'] = $user->email;
            $data['created_at'] = Carbon::now();
            $data['user_id'] = $user->id;
            $this->model->insert($data);
            return $this->sendSuccess('Success create data');
        } catch (Exception $ex) {
            Log::error('DeviceAPIController@store:' . $ex->getMessage().$ex->getTraceAsString());
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
            $user = $request->user();
            $data = $this->model->where([
                'DeviceID' => $id,
                'user_id' => $user->id
            ])->first();
            return $this->sendResponse($data, 'Get device detail success');
        } catch (\Exception $ex) {
            Log::error('DeviceAPIController@show:' . $ex->getMessage().$ex->getTraceAsString());
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
    // Todd: Coding
    public function update(CreateDeviceAPIRequest $request, $id)
    {
        $user = $request->user();
        $data = $request->all();
        $data['updated_at'] = Carbon::now();
        try {
            $data['updated_user'] = $user->email;
            $this->model->where([
                'DeviceID' => $id,
                'user_id' => $user->id
            ])->update($data);
            return $this->sendSuccess('Success update data');
        } catch (Exception $ex) {
            Log::error('DeviceAPIController@update:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
