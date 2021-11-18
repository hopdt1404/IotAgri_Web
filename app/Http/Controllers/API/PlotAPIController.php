<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\GetPlotOfFarmAPIRequest;
use Database\Seeders\SensingSeeder;
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
}
