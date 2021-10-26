<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class GetProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:get {productId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get product by ID';

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
        $productId = (int) $this->argument('productId');
        if(! (bool) $productId) {
            echo "Podano niewłaściwy identyfikator\n";
            return Command::FAILURE;
        }
        var_dump(Product::where('id', $productId)->first());
        return Command::SUCCESS;
    }
}
