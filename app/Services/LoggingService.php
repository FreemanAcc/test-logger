<?php

namespace App\Services;

use App\Logging\Factories\LoggerFactory;

class LoggingService
{
    protected LoggerFactory $loggerFactory;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->loggerFactory = $loggerFactory;
    }

    public function logToDefault(string $message): void
    {
        $logger = $this->loggerFactory->getLogger(config('logging.default'));
        $logger->send($message);
    }

    public function logToSpecific(string $type, string $message): void
    {
        $logger = $this->loggerFactory->getLogger($type);
        $logger->send($message);
    }

    public function logToAll(string $message): void
    {
        foreach ($this->loggerFactory->getAllLoggers() as $logger) {
            $logger->send($message);
        }
    }
}
