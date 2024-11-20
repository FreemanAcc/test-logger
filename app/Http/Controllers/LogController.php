<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoggingService;

class LogController extends Controller
{
    protected LoggingService $loggingService;

    public function __construct(LoggingService $loggingService)
    {
        $this->loggingService = $loggingService;
    }

    public function log(Request $request)
    {
        $message = $request->input('message', 'Default log message');
        $this->loggingService->logToDefault($message);

        return response()->json(['status' => 'success', 'message' => 'Logged to default logger']);
    }

    public function logTo(Request $request, string $type)
    {
        $message = $request->input('message', 'Default log message');
        $this->loggingService->logToSpecific($type, $message);

        return response()->json(['status' => 'success', 'message' => "Logged to {$type} logger"]);
    }

    public function logToAll(Request $request)
    {
        $message = $request->input('message', 'Default log message');
        $this->loggingService->logToAll($message);

        return response()->json(['status' => 'success', 'message' => 'Logged to all loggers']);
    }
}
