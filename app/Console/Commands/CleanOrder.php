<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CleanOrder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清理15分钟未支付的订单';

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
     * @return mixed
     */
    public function handle()
    {
        //设置超时时间
        set_time_limit(0);
        //订单最后支付时间
        $end_time=time()-60*15;
        while (1){
            DB::table('orders')->where([
                ['order_status',0],
                ['order_birth_time','<',$end_time]
            ])->update(['order_status'=>2]);
            sleep(60);
        }
    }
}
