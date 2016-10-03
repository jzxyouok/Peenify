<?php

namespace App\Console\Commands;

use App\Mail\Weekly;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWeekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send weekly mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public static function fire()
    {
        $emails = ['qadk211062@gmail.com'];

        foreach ($emails as $email){
            Mail::to($email)->send(new Weekly());
        }
    }
}
