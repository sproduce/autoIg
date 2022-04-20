<?php

namespace App\Console\Commands;

use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Services\RentEventService;
use Illuminate\Console\Command;

class EventService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:addService';

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
    public function handle(RentEventService $rentEventServ,RentEventRepositoryInterface $rentEventRep)
    {
        
        $this->info('Display this on the screen');
        return Command::SUCCESS;
    }
}
