<?php

namespace App\Console\Commands;

use App\Models\Variants;
use Illuminate\Console\Command;

class SetDefaultNetPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'variants:set_net_price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give default value for net price';

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
        $this->info("Task started");
        $variants = Variants::all();

        foreach ($variants as $variant) {
            $newNetPrice = $variant->price;
            $newPrice = intval($newNetPrice * 1.27);

            $variant->net_price = $newNetPrice;
            $variant->price = $newPrice;
            $variant->save();
            
            $this->info("Variant-$variant->id done.");
        }

        $this->info("Task ended");
    }
}
