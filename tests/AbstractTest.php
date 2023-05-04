<?php

declare(strict_types=1);

namespace YdgTest;

use PHPUnit\Framework\TestCase;

abstract class AbstractTest extends TestCase
{
    public function getConfig(): array
    {
        return [
            'app_key' => 'your app_key',
            'app_secret' => 'your app_secret',
            'sign_secret' => 'your sign_secret',
            'access_token' => 'your access_token',
        ];
    }

    public function isSuccessResponse($response)
    {
        $this->assertArrayHasKey('result', $response);
        $this->assertEquals(1, $response['result']);
    }
}
