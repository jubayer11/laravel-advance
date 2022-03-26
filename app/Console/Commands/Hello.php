<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Hello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Hello {name=ahmed} {--L|lastname=jubayer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is a make command';

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
//        $lastName=$this->info($this->argument('name'));
//        $firstName=$this->info($this->option('lastname'));
//        $this->info($lastName.' '.$firstName);

        //asking question with command
//
//        $name=$this->ask('what is your name');
//        $this->error($name);

//
//        $password = $this->secret('what is your password');
//        $confirm = $this->confirm('Do you want to print your password');
//        if ($confirm) {
//            $this->info($password);
//        }


        $user = User::select('firstName','email')->get();
        $header=['firstName','Email'];
        $this->table($header,$user);

    }
}
