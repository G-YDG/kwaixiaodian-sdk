<?php

declare(strict_types=1);

use GuzzleHttp\Exception\GuzzleException;
use Ydg\KwaixiaodianSdk\Kwaixiaodian;
use YdgTest\AbstractTest;

class UserTest extends AbstractTest
{
    /**
     * @return void
     * @throws GuzzleException
     */
    public function testInfoGet()
    {
        $app = new Kwaixiaodian($this->getConfig());
        $response = $app->user->openUserInfoGet();
        $this->isSuccessResponse($response);
    }
}