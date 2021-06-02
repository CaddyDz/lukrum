<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just Send a test email to he developer';

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

        Mail::to([['email' => 'ahhmed@mail.ru', 'name' => 'Ivan Bibeg',]])->send(new TestMail());
        return 0;
    }
}
