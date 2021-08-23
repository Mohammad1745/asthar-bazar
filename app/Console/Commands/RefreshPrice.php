<?php

namespace App\Console\Commands;

use App\Console\Services\RefreshPriceService;
use Illuminate\Console\Command;

class RefreshPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the prices if collection expires';

    /**
     * @var RefreshPriceService
     */
    private $refreshPriceService;


    /**
     * Create a new command instance.
     *
     * @param RefreshPriceService $refreshPriceService
     */
    public function __construct(RefreshPriceService $refreshPriceService)
    {
        $this->refreshPriceService = $refreshPriceService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->refreshPriceService->refreshPrice();
    }
}
