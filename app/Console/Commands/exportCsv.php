<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\WishListController;
class exportCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:export_csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all wishlist in csv separated with semicolon';

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
        $wishlistController=new WishListController();
        $wishlistController->exportCsv();
    }
}

