<?php

namespace App\Console\Commands;

use App\Jobs\UpdateTaskCountJob;
use Illuminate\Console\Command;

class UpdateTaskStatisticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:tasks:statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users tasks statistics';

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
        UpdateTaskCountJob::dispatch();
    }
}
