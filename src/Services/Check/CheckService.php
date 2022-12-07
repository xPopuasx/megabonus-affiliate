<?php

namespace Megabonus\Laravel\Affiliate\Services\Check;

use Illuminate\Support\Facades\DB;
use Megabonus\Laravel\Affiliate\Exceptions\LinkException;
use Megabonus\Laravel\Affiliate\Exceptions\ShopException;

class CheckService
{
    /**
     * @param string $link
     * @return void
     *
     * @throws LinkException
     */
    public function checkLink(string $link): void
    {
        $parseLink = parse_url($link);

        if(!isset($parseLink['host'])){
            throw LinkException::url();
        }

        if(!in_array($parseLink['host'], config('affiliate.access_hosts'))){
            throw LinkException::host();
        }
    }

    /**
     * @param string $link
     * @return void
     */
    public function checkLinkInTable(string $link): bool
    {
        return DB::table(config('affiliate.has_affiliate_links_table.table'))
            ->where(config('affiliate.has_affiliate_links_table.column'), $link)->exists();
    }
}