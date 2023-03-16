<?php

declare(strict_types=1);

namespace Ydg\KwaixiaodianSdk\Oauth;

use GuzzleHttp\Exception\GuzzleException;
use Ydg\KwaixiaodianSdk\KwaixiaodianApi;
use Ydg\KwaixiaodianSdk\Support\Utils;

class Oauth extends KwaixiaodianApi
{
    /**
     * @param $code
     * @param string $grant_type
     * @return array
     * @throws GuzzleException
     */
    public function accessToken($code, string $grant_type = 'code'): array
    {
        $config = $this->getConfig();
        $response = $this->getHttpClient()->request('GET', $this->getBaseUri() . 'oauth2/access_token', [
            'query' => [
                'app_id' => $config['app_key'],
                'app_secret' => $config['app_secret'],
                'grant_type' => $grant_type,
                'code' => $code,
            ],
        ]);
        return Utils::jsonResponseToArray($response);
    }

    /**
     * @param $refresh_token
     * @return array
     * @throws GuzzleException
     */
    public function refreshToken($refresh_token): array
    {
        $config = $this->getConfig();
        $response = $this->getHttpClient()->request('GET', $this->getBaseUri() . 'oauth2/refresh_token', [
            'query' => [
                'app_id' => $config['app_key'],
                'app_secret' => $config['app_secret'],
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
            ],
        ]);
        return Utils::jsonResponseToArray($response);
    }
}