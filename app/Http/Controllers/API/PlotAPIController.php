<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreatePlotAPIRequest;
use App\Http\Requests\API\GetPlotOfFarmAPIRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlotAPIController extends AppBaseController
{
    public function getPlotOfFarm(GetPlotOfFarmAPIRequest $request)
    {
        $data = $request->all();
        $user = $request->user();
        try {
            $FarmID = $data['FarmID'];
            $devices = DB::table('Devices')
                ->where([
                    'FarmID' => $FarmID,
                    'user_id' => $user->id,
                ])->selectRaw('PlotID, COUNT(PlotID) AS number_device')
                ->groupBy('PlotID');

            $plots = DB::table('Plots')
                ->where([
                   'FarmID' => $FarmID
                ])->select(
                    'Plots.PlotID', 'Plots.name', 'Plots.Area',
                    'Plots.status', 'Devices.number_device'
                )->leftJoinSub($devices, 'Devices',
                'Plots.PlotID', '=', 'Devices.PlotID')
                ->get();
            foreach ($plots as $plot) {
                if (!($plot->number_device)) {
                    $plot->number_device = 0;
                }
            }
            return $this->sendResponse($plots, 'Get plots of farm success');
        } catch (\Exception $ex) {
            Log::error('PlotAPIController@getPlotOfFarm:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Get plots of farm error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Request $request, $plotId)
    {
        try {
            $plot = DB::table('Plots')->where([
                'PlotID' => $plotId
            ])->select(
                'PlotID',
                'name',
                'Area',
                'status'
            )->first();
            if (isset($plot)) {
                return $this->sendResponse($plot, 'Get plot detail success');
            } else {
                return $this->sendError('Not found plot', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $ex) {
            Log::error('PlotAPIController@show:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Get plot detail error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function update(CreatePlotAPIRequest $request, $plotId)
    {
        $data = $request->all();
        try {
            DB::table('Plots')
                ->where([
                   'PlotID' => $plotId,
                   'FarmID' => $data['FarmID']
                ])->update($data);
            return $this->sendSuccess('Update plot info success');
        } catch (\Exception $ex) {
            Log::error('PlotAPIController@update:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Update plot info error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(CreatePlotAPIRequest $request)
    {
        $data = $request->all();
        try {
            DB::table('Plots')->insert($data);
            return $this->sendSuccess('Create plot success');
        } catch (\Exception $ex) {
            Log::error('PlotAPIController@store:' . $ex->getMessage().$ex->getTraceAsString());
            return $this->sendError('Create plot error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
