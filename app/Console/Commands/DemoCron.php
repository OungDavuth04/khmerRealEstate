<?php

namespace App\Console\Commands;

use App\FeaturAd;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;


class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        FeaturAd::where('promoteId',1)->update([
            'disable' => 'false'
        ]);
//        $expire =  FeaturAd::where('disable','true')->get();
//        foreach ($expire as $disable){
//            if(dateDifference($disable->created_at,Carbon::now()->toDateTimeString())+1  == $disable->day){
//                FeaturAd::where('promoteId',$disable->promoteId)->update([
//                    'disable' => 'false'
//                ]);
//            }
//        }
//        function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
//        {
//            $interval = date_diff(date_create($date_1),date_create($date_2));
//            return $interval->format($differenceFormat);
//        }
    }
}
