<?php

declare(strict_types=1);

namespace Ydg\KwaixiaodianSdk;

use GuzzleHttp\Exception\GuzzleException;
use Ydg\FoudationSdk\FoundationApi;
use Ydg\FoudationSdk\Traits\HasAttributes;
use Ydg\KwaixiaodianSdk\Support\Utils;

class KwaixiaodianApi extends FoundationApi
{
    use HasAttributes;

    protected $baseUri = 'https://openapi.kwaixiaodian.com/';

    /**
     * @param string $baseUri
     */
    public function setBaseUri(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @throws GuzzleException
     */
    public function get($method, $param = []): array
    {
        return $this->request($method, $param, 'GET');
    }

    /**
     * @param string $method
     * @param array $param
     * @param string $request_method
     * @return array
     * @throws GuzzleException
     */
    public function request(string $method, array $param, string $request_method): array
    {
        $config = $this->getConfig();

        $params = [
            'method' => $method,
            'appkey' => $config['app_key'],
            'access_token' => $config['access_token'],
            'version' => $config['version'],
            'signMethod' => $config['sign_method'],
            'timestamp' => Utils::getMsecTime(),
            'param' => Utils::arrayToJson($param),
        ];

        $params['sign'] = $this->makeSign($params, $config['sign_secret']);

        if ($request_method == 'POST') {
            $response = $this->getHttpClient()->get($this->getUri($method), $params);
        } else {
            $response = $this->getHttpClient()->post($this->getUri($method), $params);
        }

        return Utils::jsonResponseToArray($response);
    }

    public function getConfig(): array
    {
        return array_merge(['version' => 1, 'sign_method' => 'MD5'], $this->toArray());
    }

    /**
     * @param array $params
     * @param string $signSecret
     * @return string
     */
    public function makeSign(array $params, string $signSecret): string
    {
        ksort($params);
        $paramsStr = '';
        array_walk($params, function ($item, $key) use (&$paramsStr) {
            if ('@' != substr((string)$item, 0, 1)) {
                $paramsStr .= sprintf('%s%s%s%s', $key, '=', $item, '&');
            }
        });
        return md5(sprintf('%s%s%s%s', $paramsStr, 'signSecret', '=', $signSecret));
    }

    /**
     * @param string $method
     * @return string
     */
    public function getUri(string $method): string
    {
        return $this->getBaseUri() . str_replace('.', '/', $method);
    }

    /**
     * @throws GuzzleException
     */
    public function post($method, $param): array
    {
        return $this->request($method, $param, 'POST');
    }

    /**
     * @throws GuzzleException
     */
    public function __call($name, $arguments)
    {
        // 根据方法名转化为method
        $method = strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '.$1', $name));

        $methods = explode('.', $method);
        $action = array_pop($methods);

        $requestMethod = in_array($action, ['list', 'detail']) ? 'GET' : 'POST';

        return $this->request($method, $arguments[0] ?? [], $requestMethod);
    }

    public function getHttpClientDefaultOptions(): array
    {
        return [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json;charset=UTF-8',
            ],
            'verify' => false
        ];
    }
}