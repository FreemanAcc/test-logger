<?php

namespace App\Logging\Factories;

use App\Logging\Interfaces\LoggerInterface;
use App\Logging\Loggers\EmailLogger;
use App\Logging\Loggers\FileLogger;
use App\Logging\Loggers\DatabaseLogger;

class LoggerFactory
{
    protected array $loggers;

    public function __construct()
    {
        $this->loggers = [
            'email' => new EmailLogger(),
            'file' => new FileLogger(),
            'db' => new DatabaseLogger(),
        ];
    }

    public function getLogger(string $type): LoggerInterface
    {
        if (!isset($this->loggers[$type])) {
            throw new \InvalidArgumentException("Logger type '{$type}' not found. Available types: " . implode(', ', array_keys($this->loggers)));
        }

        return $this->loggers[$type];
    }

    public function getAllLoggers(): array
    {
        return $this->loggers;
    }
}
