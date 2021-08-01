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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::channel('cron-daily')->info('Started UpdatePlantAgricultureInfo Command');
        try {
            // Todo: check user_id, plant_id, farm_id in db
            $ids = DB::table('farm_plants')->where([
                'status' => AppUtils::FARM_PLANT_ACTIVATE_STATUS
            ])->pluck('id');
            if (count($ids)) {
                $data = DB::table('farm_plants')
                    ->whereIn('id', $ids)
                    ->get();
                foreach ($data as $record) {
                    if (isset($record->start_time_season) &&
                        isset($record->total_growth_day)) {
                        // calculate  farm_plants.total_growth_day
                        $now = Carbon::now();
                        $start_time_season = $record->start_time_season;
                        $totalGrowthDay = $now->diffInDays($start_time_season);
                        $setDataUpdate = [];
                        $setDataUpdate['total_growth_day'] = $totalGrowthDay;
                        $setDataUpdate['updated_at'] = Carbon::now();
                        $setDataUpdate['updated_user'] = 'System';

                        // calculate farm_plants.current_plant_state
                        if (isset($record->current_plant_state)) {
                            // get numberPlantState
                            $numberPlantState = DB::table('plant_states')->count();
                            // get agriculturePlant
                            $agriculturePlant = DB::table('agriculture_plants')
                                ->where([
                                    'plant_id' => $record->plant_id,
                                    'FarmID' => $record->FarmID,
                                    'user_id' => $record->user_id,
                                ])->orderBy('plant_state_id')
                                // default orderBy acs
                                ->distinct('plant_state_id')->get();
                            $totalAgriculturePlantSetting = 0;
                            $agriculturePlant = $agriculturePlant->all();
                            $lastAgricultureIndex = 0;
                            // process in growthPeriod
                            for ($i = 0; $i < count($agriculturePlant); $i++) {
                                $plantSetting = $agriculturePlant[$i];
                                $currentGrowthDay = $totalGrowthDay - $totalAgriculturePlantSetting;
                                $totalAgriculturePlantSetting += $plantSetting->growth_period;
                                $lastAgricultureIndex = $i;
                                if ($totalGrowthDay <= $totalAgriculturePlantSetting) {
                                    $setDataUpdate['current_plant_state'] = $plantSetting->plant_state_id;
                                    $setDataUpdate['current_growth_day'] = $currentGrowthDay;
                                    break;
                                }
                            }
                            // process if out of growthPeriod => update value, status,
                            if (!isset($setDataUpdate['current_plant_state'])) {
                                $plantSetting = $agriculturePlant[$lastAgricultureIndex];
                                $setDataUpdate['current_plant_state'] = $plantSetting->plant_state_id;
                                $setDataUpdate['current_growth_day'] = $plantSetting->growth_period;
                                $setDataUpdate['status'] = AppUtils::FARM_PLANT_END_SEASON_STATUS;
                                $setDataUpdate['total_growth_day'] = $totalAgriculturePlantSetting;
                            }

                        }
                        DB::table('farm_plants')
                            ->where('id', $record->id)
                            ->update($setDataUpdate);
                    }
                }
            }
            Log::channel('cron-daily')->info('Finished UpdatePlantAgricultureInfo Command');
        } catch (\Exception $e) {
            Log::channel('cron-daily')->error('Exception UpdatePlantAgricultureInfo Command: ');
            Log::channel('cron-daily')->error($e->getMessage() . $e->getTraceAsString());
            throw $e;
        }


    }
}
