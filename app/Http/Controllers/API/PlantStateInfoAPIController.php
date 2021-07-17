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
    public function store(CreatePlantStateInfoAPIRequest $request)
    {
        $user = $request->user();
        $data = $request->all();
        DB::beginTransaction();
        try {
//            for ($i = 0; $i < count($data); $i++) {
//                $data[$i]['created_at'] = Carbon::now()->format('Y-m-d h:i:s');
//                $data[$i]['created_user'] = $user->email;
//                $temp = PlantStateInfo::create($data[$i]);
//                $temp->save();
//
////                $this->model->insert($data[$i]);
//            }
//            $this->model->insert($data);
//                ->insert($data[$i]);
//            foreach ($data as $item) {
//                $item['created_at'] = Carbon::now();
//                $item['created_user'] = $user->email;
//                Log::info($item);
//                $this->model->insert($item);
//            }
            DB::commit();
            return $this->sendSuccess('Success create data');
        } catch (Exception $ex) {
            Log::error('PlantAPIController@store:' . $ex->getMessage().$ex->getTraceAsString());
            DB::rollBack();
            return $this->sendError(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
