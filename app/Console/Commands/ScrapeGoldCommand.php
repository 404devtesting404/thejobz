<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GoldRateController;

class ScrapeGoldCommand extends Command
{
    protected $signature = 'scrape:gold';
    protected $description = 'Scrape gold rate daily at 8 AM Pakistan time';

    public function handle()
    {
        $controller = new GoldRateController();
        $controller->scrape_gold(); // route function ko direct call kar diya
        $this->info('Gold rate scraped successfully!');
    }
}
