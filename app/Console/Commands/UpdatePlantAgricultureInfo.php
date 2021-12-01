<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Utils\AppUtils;
use Illuminate\Support\Facades\Log;

class UpdatePlantAgricultureInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:plantAgricultureInfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'UpdatePlantAgricultureInfo at ';
    private $logger;
//    private $timeSleep = 1*60*60; // 1 hour
    private $timeSleep = 10; // 10 second

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->logger = Log::channel("cron-daily");
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->logger->info('Started UpdatePlantAgricultureInfo Command');
        try {
            $i = 0;
            while (true) {
                $i++;
                $this->logger->info(' State update times: ' . $i . " at " . Carbon::now()->format('Y-m-d h:i:s'));
                $today = Carbon::today()->format('Y-m-d');
                $farmPlot = DB::table('Farms')
                    ->where([
                        'Farms.Status' => AppUtils::FARM_STATUS_ACTIVATE,
                        'Plots.status' => AppUtils::PLOT_STATUS_ACTIVATE
                    ])
                    ->join('Plots',
                        'Plots.FarmID', '=', 'Farms.FarmID')
                    ->select('Plots.PlotID',
                        'Plots.FarmID');
//                $tmp = $farmPlot->get();
//                $this->logger->info('$tmp');
//                $this->logger->info((array)$tmp);
                $farmPlant = DB::table('farm_plants')
                    ->whereIn('farm_plants.status', [
                        AppUtils::FARM_PLANT_ACTIVATE_STATUS,
                        AppUtils::FARM_PLANT_INIT_STATUS,
                    ])
                    ->joinSub($farmPlot, 'Plots',
                        'farm_plants.PlotID', '=','Plots.PlotID')
                    ->select(
                        'farm_plants.id',
                        'farm_plants.plant_id',
                        'farm_plants.PlotID',
                        'farm_plants.start_time_season',
                        'farm_plants.end_time_season',
                        'farm_plants.status',
                    )->get();
//                $this->logger->info('$farmPlant');
//                $this->logger->info((array)$farmPlant);
                if (count($farmPlant)) {
                    foreach ($farmPlant as $data) {
                        if (isset($data->end_time_season)) {
                            if ($data->end_time_season < $today) {
                                $infoUpdate['status'] = AppUtils::FARM_PLANT_END_SEASON_STATUS;
                                $startTimeSeason = Carbon::parse($data->start_time_season);
                                $endTimeSeason = Carbon::parse($data->end_time_season);
                                $totalGrowthDay = $startTimeSeason->diffInDays($endTimeSeason);
                                $infoUpdate['total_growth_day'] = $totalGrowthDay;
                                $plantId = $data->plant_id;
                                $plotId = $data->PlotID;
                                $plantStateInfo = DB::table('agriculture_plants')
                                    ->where([
                                        'plant_id' => $plantId,
                                        'PlotID' => $plotId
                                    ])->select(
                                        'agriculture_plants.plant_state_id',
                                        'agriculture_plants.growth_period',
                                    )->orderBy('agriculture_plants.plant_state_id')
                                    ->get();
                                $currentPlantState = 0;
                                $currentGrowthDay = 0;
                                for ($i = 0; $i < count($plantStateInfo); $i++) {
                                    $plantState = $plantStateInfo[$i];
                                    $currentPlantState = $plantState->plant_state_id;
                                    if ($totalGrowthDay <= $plantState->growth_period) {
                                        $currentGrowthDay = $plantState->growth_period - $totalGrowthDay;
                                        break;
                                    } else {
                                        $totalGrowthDay -=  $plantState->growth_period;
                                    }
                                }
                                $infoUpdate['current_plant_state'] = $currentPlantState;
                                $infoUpdate['current_growth_day'] = $currentGrowthDay;
                            } else {
                                $infoUpdate = $this->updateFarmPlantInSeason(
                                    $data->status,
                                    $data->start_time_season,
                                    $today,
                                    $data->plant_id,
                                    $data->PlotID
                                );
                                $id = $data->id;
                                DB::table('farm_plants')->where([
                                    'id' => $id
                                ])->update($infoUpdate);
                            }
                        } else {
                            // Only has startTimeSeason
                            if ($data->start_time_season <= $today) {
                                $infoUpdate = $this->updateFarmPlantInSeason(
                                    $data->status,
                                    $data->start_time_season,
                                    $today,
                                    $data->plant_id,
                                    $data->PlotID
                                );
                            }
                        }
                        if (isset($infoUpdate)) {
                            $infoUpdate['updated_at'] = Carbon::now();
                            $infoUpdate['updated_user'] = AppUtils::UPDATED_USER_SYSTEM_NAME;
                            $id = $data->id;
                            DB::table('farm_plants')->where([
                                'id' => $id
                            ])->update($infoUpdate);
                            $this->logger->info('$infoUpdate');
                            $this->logger->info($infoUpdate);
                        }

                        $this->logger->info('$data');
                        $this->logger->info((array)$data);
                    }
                }
                $this->logger->info('Done update times: ' . $i . " at " . Carbon::now()->format('Y-m-d h:i:s'));
                sleep($this->timeSleep);
            }

            $this->logger->info('Finished UpdatePlantAgricultureInfo Command');
        } catch (\Exception $e) {
            $this->logger->error('Exception UpdatePlantAgricultureInfo Command: ');
            $this->logger->error($e->getMessage() . $e->getTraceAsString());
            throw $e;
        }


    }

    public function updateFarmPlantInSeason($status, $startTimeSeason, $endTimeCompare, $plantId, $plotId) {
        if ($status != AppUtils::FARM_PLANT_ACTIVATE_STATUS) {
            $infoUpdate['status'] = AppUtils::FARM_PLANT_ACTIVATE_STATUS;
        }
        $startTimeSeason = Carbon::parse($startTimeSeason);
        $endTimeSeason = Carbon::parse($endTimeCompare);
        $totalGrowthDay = $startTimeSeason->diffInDays($endTimeSeason);
        $infoUpdate['total_growth_day'] = $totalGrowthDay;
        $plantStateInfo = DB::table('agriculture_plants')
            ->where([
                'plant_id' => $plantId,
                'PlotID' => $plotId
            ])->select(
                'agriculture_plants.plant_state_id',
                'agriculture_plants.growth_period',
            )->orderBy('agriculture_plants.plant_state_id')
            ->get();
        $currentPlantState = 0;
        $currentGrowthDay = 0;
        for ($i = 0; $i < count($plantStateInfo); $i++) {
            $plantState = $plantStateInfo[$i];
            $currentPlantState = $plantState->plant_state_id;
            if ($totalGrowthDay <= $plantState->growth_period) {
                $currentGrowthDay = $plantState->growth_period - $totalGrowthDay;
                break;
            } else {
                $totalGrowthDay -=  $plantState->growth_period;
            }
        }
        $infoUpdate['current_plant_state'] = $currentPlantState;
        $infoUpdate['current_growth_day'] = $currentGrowthDay;
        $this->logger->info('$infoUpdate');
        $this->logger->info($infoUpdate);
        return $infoUpdate;
    }
}
