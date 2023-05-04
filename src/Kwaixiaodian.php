<?php

declare(strict_types=1);

namespace Ydg\KwaixiaodianSdk;

use Ydg\FoudationSdk\ServiceContainer;

/**
 * @property Api\Distribution\Distribution $distribution
 * @property Api\User\User $user
 */
class Kwaixiaodian extends ServiceContainer
{
    protected $providers = [
        Api\Distribution\ServiceProvider::class,
        Api\User\ServiceProvider::class,
    ];
}
