<?php

namespace App\Jobs;

use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct(array $user)
    {
        $this->user = $user;
        $email = $user["email"];
        $name = $user["name"];
        // dd("<p>$email</p>");
        $this->data = [
            "email" => "arihant.jain@getgrahak.in",
            "body" => "<h1>Data:</h1>
                        <p>Email:  $email</p>
                        <p>Name: $name</p>",
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Http::withHeader("content-type", "application/json")->post("https://connect.pabbly.com/workflow/sendwebhookdata/IjU3NjYwNTZkMDYzMjA0M2M1MjY4NTUzZDUxMzQi_pc", $this->data);
    }
}

// template

