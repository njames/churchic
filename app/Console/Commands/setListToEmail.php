<?php

namespace Cic\Console\Commands;

use Illuminate\Console\Command;

class setListToEmail extends CicCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cic:setListsToEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy the participants details from a source system to email system';

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
    public function fire()
    {
        
    }
}
