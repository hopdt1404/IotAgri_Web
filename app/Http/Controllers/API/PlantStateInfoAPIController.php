<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\PlantStateInfo;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\API\CreatePlantStateInfoAPIRequest;

class PlantStateInfoAPIController extends AppBaseController
{
    protected $model;
    public function __construct(PlantStateInfo $plantStateInfo)
    {
        $this->model = $plantStateInfo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        try {
            $data = $this->model->where([
                'plant_state_id' => $data['plant_state_id'],
                'plant_id' => $data['plant_id']
            ])->first();
            return $this->sendResponse($data, 'Success get PlantStateInfo');
        } catch (\Exception $ex) {
            Log::error('PlantStateInfoAPIController@create:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(CreatePlantStateInfoAPIRequest $request)
    {
        $user = $request->user();
        $data = $request->all();
        try {
            $data['created_at'] = Carbon::now();
            $data['created_user'] = $user->email;
            $this->model->insert($data);
            return $this->sendSuccess('Success create data');
        } catch (Exception $ex) {
            Log::error('PlantStateInfoAPIController@store:' . $ex->getMessage().$ex->getTraceAsString());
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
    public function update(CreatePlantStateInfoAPIRequest $request, $id)
    {
        $user = $request->user();
        $data = $request->all();
        $data['updated_at'] = Carbon::now();
        try {
            $data['updated_user'] = $user->email;
            $this->model->where([
                'id' => $id,
                'plant_state_id' => $data['plant_state_id'],
                'plant_id' => $data['plant_id']
            ])->update($data);
            return $this->sendSuccess('Success update data');
        } catch (Exception $ex) {
            Log::error('PlantStateInfoAPIController@update:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
