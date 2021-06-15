<?php

namespace BetterRating\BookRatingPackage\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run actions necessary to install Books Rating Package';

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
        // publish migration?
        // run migration
        // run seeder
        // save entry to `modules` table
        echo 'test'.PHP_EOL;
        return 0;
    }
}
