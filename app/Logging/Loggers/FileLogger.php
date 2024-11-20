<?php

namespace App\Logging\Loggers;

use App\Logging\Interfaces\LoggerInterface;
use Illuminate\Support\Facades\Storage;

class FileLogger implements LoggerInterface
{
    private string $type = 'file';

    public function send(string $message): void
    {
        // Получение пути из конфигурации
        $filePath = config('logging.file.path');

        if (!$filePath) {
            throw new \InvalidArgumentException('File path for logging is not configured.');
        }

        // Проверка и создание директории, если необходимо
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Запись сообщения в файл
        file_put_contents($filePath, now() . ' - ' . $message . PHP_EOL, FILE_APPEND);
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
