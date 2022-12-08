<?php

declare(strict_types=1);

namespace Megabonus\Laravel\Affiliate\Facades;

use Illuminate\Support\Facades\Facade;
use Megabonus\Laravel\Affiliate\Affiliate as FakeAffiliate;

/**
 * @method static string check(string $url, bool $needSave)
 * @method static string checkArray(array $urls, bool $needSave)
 */
class Affiliate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return FakeAffiliate::class;
    }
}
