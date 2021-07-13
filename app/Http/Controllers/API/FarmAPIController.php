<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Farm;
use App\Http\Requests\API\CreateFarmAPIRequest;

class FarmAPIController extends AppBaseController
{
    protected $model;
    public function __construct(Farm $farm)
    {
        $this->model = $farm;
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
            $farm = $this->model->where(
                ['UserID' => $user->id]
            )->get();
            return $this->sendResponse($farm, 'FarmAPIController');
        } catch (\Exception $ex) {
            Log::error('FarmAPIController@index:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFarmAPIRequest $request)
    {
        $user = $request->user();
        $data = $request->all();
        try {
            $data['created_user'] = $user->name;
            $data['created_at'] = Carbon::now();
            $data['UserID'] = $user->id;
            $this->model->insert($data);
            return $this->sendSuccess('Success create data');
        } catch (Exception $ex) {
            Log::error('FarmAPIController@store:' . $ex->getMessage().$ex->getTraceAsString());
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
                'FarmID' => $id,
                'UserID' => $user->id
            ])->first();
            return $this->sendResponse($data, 'Get farm detail success');
        } catch (\Exception $ex) {
            Log::error('FarmAPIController@show:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            $data['updated_user'] = $user->name;
            $this->model->where([
                'FarmID' => $id,
                'UserID' => $user->id
            ])->update($data);
            return $this->sendSuccess('Success update data');
        } catch (Exception $ex) {
            Log::error('FarmAPIController@update:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
