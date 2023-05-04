<?php

declare(strict_types=1);

namespace Ydg\KwaixiaodianSdk\Api\User;

use GuzzleHttp\Exception\GuzzleException;
use Ydg\KwaixiaodianSdk\KwaixiaodianApi;

class User extends KwaixiaodianApi
{
    /**
     * 获取用户公开信息.
     * @see https://open.kwaixiaodian.com/docs/api?apiName=open.user.info.get&categoryId=46&version=1
     * @throws GuzzleException
     */
    public function openUserInfoGet(): array
    {
        return $this->get('open.user.info.get');
    }
}
