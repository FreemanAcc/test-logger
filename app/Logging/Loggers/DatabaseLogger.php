<?php

namespace App\Logging\Loggers;

namespace App\Logging\Loggers;

use App\Logging\Interfaces\LoggerInterface;
use Illuminate\Support\Facades\DB;

class DatabaseLogger implements LoggerInterface
{
    private string $type = 'db';

    public function send(string $message): void
    {
        $table = config('logging.database.table');
        DB::table($table)->insert(['message' => $message, 'created_at' => now()]);
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
