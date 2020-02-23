<?php

namespace App\Console\Commands;

use App\Service\Account\AccountService;
use Illuminate\Console\Command;

class BackupCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private $accountService;

    /**
     * Create a new command instance.
     *
     * @param AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService =$accountService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Amqp::consume(config('rabbitmqquere.queue_dayly.queue_name'), function ($message, $resolver) {
            $this->accountService->backup(\GuzzleHttp\json_decode($message->body));
            $resolver->acknowledge($message);
        }, [
            'vhost' => config('rabbitmqquere.queue_dayly.vhost'),
            'exchange' => config('rabbitmqquere.queue_dayly.exchange'),
            'persistent' => true
        ]);
    }
}
