<?php

namespace App\Console\Commands;

use App\Http\Services\Action\StatisticAction;
use App\Http\Services\API\CovidService;
use App\Http\Services\API\HotelService;
use App\Http\Services\API\OpenweatherService;
use Illuminate\Console\Command;

class GetStatisticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apg:get-statistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get statistics (hotels, weather forecast, COVID)';

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
        (new StatisticAction())->get(
            new CovidService(),
            new HotelService(),
            new OpenweatherService()
        );

        return self::SUCCESS;
    }
}
