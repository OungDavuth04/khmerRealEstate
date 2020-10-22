<?php

namespace App\Console\Commands;

use App\FeaturAd;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;


class Feature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Disable:feature';

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
        function dateDifference($date1 , $date2)
        {
            //expire
            $datetime1 = new DateTime($date1);
            //date Now
            $datetime2 = new DateTime($date2);
            if($datetime1 >= $datetime2 ){
                return true;
            }else{
                return false;
            }
        }
        $FeaturAd =  FeaturAd::where('disable','true')->get();
        foreach ($FeaturAd as $expire){
            if(dateDifference($expire->expire,Carbon::now()->toDateTimeString()) == false){
                FeaturAd::where('promoteId',$expire->promoteId)->update([
                    'disable' => 'false'
                ]);
            }
        }
    }
}
