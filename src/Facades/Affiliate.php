<?php

declare(strict_types=1);

namespace Megabonus\Facades;

use Illuminate\Support\Facades\Facade;

class Affiliate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Affiliate::class;
    }
}
