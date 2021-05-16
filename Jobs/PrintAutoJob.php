<?php

namespace Modules\Dashboard\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Dashboard\Entities\SettingOrder;
use Modules\PrintAuto\Repositories\SettingPrintAutoRepository;
use Modules\Order\Entities\Order;


class PrintAutoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path;
    private $copies;

    public function __construct($path)
    {
        $this->path = $path;
        $this->copies = (SettingOrder::get())->number_copies;
    }

    public function handle()
    {
        for($i = 0; $i < $this->copies; $i++){
            exec('lp ' . $this->path);
        }
    }
}
