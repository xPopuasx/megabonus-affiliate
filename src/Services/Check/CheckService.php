<?php

namespace Megabonus\Laravel\Affiliate\Services\Check;

use Megabonus\Laravel\Affiliate\Extensions\LinkException;

class CheckService
{
    /**
     * @param string $link
     * @return void
     */
    public function checkLink(string $link): void
    {
        $parseLink = parse_url($link);

        if(!isset($parseLink['host'])){
            throw LinkException::url();
        }

        if(!in_array($parseLink, config('affiliate.access_hosts'))){
            throw LinkException::host();
        }
    }
}