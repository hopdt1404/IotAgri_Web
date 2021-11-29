<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\SavePlantAgricultureAPIRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FarmPlantAPIController extends AppBaseController
{
    public function save(SavePlantAgricultureAPIRequest $request) {
        $data = $request->all();
        try {
            DB::table('farm_plants')->insert($data);

            return $this->sendSuccess('Create farm plant success');
        } catch (\Exception $ex) {
            Log::error('FarmPlantAPIController@save:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Create farm plant error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(SavePlantAgricultureAPIRequest $request, $id)
    {
        $data = $request->all();
        try {
            DB::table('farm_plants')
                ->where([
                    'id' => $id,
                    'plant_id' => $data['plant_id'],
                    'PlotID' => $data['PlotID']
                ])->update($data);
            return $this->sendSuccess('Update farm plant success');
        } catch (\Exception $ex) {
            Log::error('FarmPlantAPIController@save:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Update farm plant error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
