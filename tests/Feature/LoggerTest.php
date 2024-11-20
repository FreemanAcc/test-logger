<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoggerTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_logger()
    {
        $response = $this->post('/log', ['message' => 'Test default logger']);
        $response->assertStatus(200);

        $this->assertTrue(file_exists(storage_path('logs/app.log')));
        $this->assertStringContainsString('Test default logger', file_get_contents(storage_path('logs/app.log')));
    }

    public function test_database_logger()
    {
        $response = $this->post('/log/db', ['message' => 'Test database logger']);
        $response->assertStatus(200);

        $this->assertDatabaseHas('logs', ['message' => 'Test database logger']);
    }

    public function test_email_logger()
    {
        $response = $this->post('/log/email', ['message' => 'Test email logger']);
        $response->assertStatus(200);
    }
}
