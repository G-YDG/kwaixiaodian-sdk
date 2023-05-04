<?php

declare(strict_types=1);

namespace YdgTest\Api;

use Ydg\KwaixiaodianSdk\Kwaixiaodian;
use YdgTest\AbstractTest;

/**
 * @internal
 * @coversNothing
 */
class DistributionTest extends AbstractTest
{
    public function testOpenDistributionCpsKwaimoneyPidList()
    {
        $app = new Kwaixiaodian($this->getConfig());
        $response = $app->distribution->openDistributionCpsKwaimoneyPidList([
            'page' => 1,
            'pageSize' => 10,
        ]);
        $this->isSuccessResponse($response);
    }

    public function testOpenDistributionCpsKwaimoneySelectionItemList()
    {
        $app = new Kwaixiaodian($this->getConfig());
        $response = $app->distribution->openDistributionCpsKwaimoneySelectionItemList([
            'pageIndex' => 1,
            'pageSize' => 10,
            'planType' => 1,
        ]);
        $this->isSuccessResponse($response);
    }

    public function testOpenDistributionCpsKwaimoneyLinkCreate()
    {
        $app = new Kwaixiaodian($this->getConfig());

        $pidListResult = $app->distribution->openDistributionCpsKwaimoneyPidList([
            'page' => 1,
            'pageSize' => 1,
        ]);
        $this->isSuccessResponse($pidListResult);
        $pid = $pidListResult['data']['cpsPidData'][0];

        $itemListResult = $app->distribution->openDistributionCpsKwaimoneySelectionItemList([
            'pageIndex' => 1,
            'pageSize' => 1,
            'planType' => 1,
        ]);
        $this->isSuccessResponse($itemListResult);
        $item = $itemListResult['data']['itemList'][0];

        $response = $app->distribution->openDistributionCpsKwaimoneyLinkCreate([
            'linkType' => 101,
            'linkCarrierId' => $item['goodsId'],
            'comments' => 'sdk_test',
            'cpsPid' => $pid['cpsPid'],
        ]);
        $this->isSuccessResponse($response);
    }
}
