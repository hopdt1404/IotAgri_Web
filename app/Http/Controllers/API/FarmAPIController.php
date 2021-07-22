<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Farm;
use App\Http\Requests\API\CreateFarmAPIRequest;
use App\Http\Requests\API\SettingFarmAPIRequest;

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
            $farm = DB::table('Farms')
                ->leftJoin('FarmTypes', 'Farms.FarmTypeID',
                    '=', 'FarmTypes.FarmTypeID')
                ->where(['UserID' => $user->id])
                ->select('Farms.*','FarmTypes.FarmType')
                ->get();
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
            $data['created_user'] = $user->email;
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
    public function update(CreateFarmAPIRequest $request, $id)
    {
        $user = $request->user();
        $data = $request->all();
        $data['updated_at'] = Carbon::now();
        try {
            $data['updated_user'] = $user->email;
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

    public function setting (SettingFarmAPIRequest $request)
    {
        $data = $request->all();
        $user = $request->user();
        DB::beginTransaction();
        try {
            $farmId = $data['FarmID'];
            $deviceIds = $data['deviceIds'];
            $plantIds = $data['plantIds'];

            // unset all device of farmId
            DB::table('Devices')->where([
               'user_id' => $user->id,
                'FarmID' => $farmId
            ])->update([
                'FarmID' => null
            ]);

            if (count($deviceIds) > 0 ) {
                DB::table('Devices')
                    ->whereIn('DeviceID', $deviceIds)
                    ->update([
                        'FarmID' => $farmId,
                        'updated_at' => Carbon::now(),
                        'updated_user' => $user->email
                    ]);
            }

            // Delete data from table farm_plant then insert new record
            DB::table('farm_plants')->where([
                'user_id' => $user->id,
                'FarmID' => $farmId
            ])->delete();

            $farmPlantInsertData = [];
            foreach ($plantIds as $plantId) {
                $record['FarmID'] = $farmId;
                $record['plant_id'] = $plantId;
                $record['user_id'] = $user->id;
                $record['created_at'] = Carbon::now();
                $record['created_user'] = $user->email;
                array_push($farmPlantInsertData, $record);
            }
            DB::table('farm_plants')->insert($farmPlantInsertData);

            DB::commit();
            return $this->sendSuccess('Success setting farm');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error('FarmAPIController@setting:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
