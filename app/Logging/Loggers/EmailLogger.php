<?php

namespace App\Logging\Loggers;

use App\Logging\Interfaces\LoggerInterface;
use Illuminate\Support\Facades\Mail;

class EmailLogger implements LoggerInterface
{
    private string $type = 'email';

    public function send(string $message): void
    {
        $recipient = config('logging.email.to');
        Mail::raw($message, function ($mail) use ($recipient) {
            $mail->to($recipient)->subject('Log Message');
        });
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        if ($this->type === $loggerType) {
            $this->send($message);
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
