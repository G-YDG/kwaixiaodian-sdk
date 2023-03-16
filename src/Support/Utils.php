<?php

declare(strict_types=1);

namespace Ydg\KwaixiaodianSdk\Support;

use Psr\Http\Message\ResponseInterface;

class Utils
{
    public static function getMsecTime(): string
    {
        list($t1, $t2) = explode(' ', microtime());
        return sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    public static function arrayToJson(array $params): string
    {
        return json_encode($params, 320);
    }

    public static function jsonResponseToArray(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}