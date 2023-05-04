<?php

declare(strict_types=1);

namespace Ydg\KwaixiaodianSdk\Api\Distribution;

use GuzzleHttp\Exception\GuzzleException;
use Ydg\KwaixiaodianSdk\KwaixiaodianApi;

/**
 * @method openDistributionCpsKwaimoneyPidCreate(array $params) // 创建快赚客推广位
 * @method openDistributionCpsKwaimoneyPidUpdate(array $params) // 更新快赚客推广位
 * @method openDistributionCpsKwaimoneyPidList(array $params) // 查询快赚客推广位
 * @method openDistributionCpsKwaimoneyLinkCreate(array $params) // 创建快赚客推广链接
 * @method openDistributionCpsKwaimoneySelectionItemList(array $params) // 获取站外分销商品列表
 * @method openDistributionCpsKwaimoneySelectionItemDetail(array $params) // 获取站外分销商品详情
 * @method openDistributionCpsKwaimoneyOrderList(array $params) // 查询快赚客分销订单
 * @method openDistributionCpsKwaimoneyNewPromotionEffectDetail(array $params) // 查询快赚客拉新推广效果数据明细
 */
class Distribution extends KwaixiaodianApi
{
    /**
     * 站外分销快赚客订单详情查询.
     * @see  https://open.kwaixiaodian.com/docs/api?apiName=open.distribution.cps.kwaimoney.order.detail&categoryId=46&version=1
     * @param array|int|string $oid
     * @throws GuzzleException
     */
    public function openDistributionCpsKwaimoneyOrderDetail($oid): array
    {
        $oid = is_array($oid) ? $oid : [$oid];
        return $this->get('open.distribution.cps.kwaimoney.order.detail', [
            'oid' => $oid,
        ]);
    }
}
