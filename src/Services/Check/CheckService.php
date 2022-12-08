<?php

namespace Megabonus\Laravel\Affiliate\Services\Check;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
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

        if(!isset($parseLink['host']) || !isset($parseLink['scheme']) || !isset($parseLink['path'])){
            throw LinkException::url();
        }

        if(!in_array($parseLink['host'], config('affiliate.access_hosts'))){
            throw LinkException::host();
        }
    }

    /**
     * @param string $link
     * @return array
     */
    public function getModel(string $link): array
    {
        return DB::table(config('affiliate.has_affiliate_links_table.table'))
            ->where(config('affiliate.has_affiliate_links_table.column_name'), $this->buildLink($link))
            ->where(config('affiliate.has_affiliate_links_table.is_affiliate_column_name'), 1)
            ->first()->toArray();
    }

    /**
     * @param string $link
     * @return false|mixed
     */
    public function getItemId(string $link)
    {
        preg_match_all('/\d+/', $link, $matches);

        return end($matches[0]);
    }

    private function buildLink(string $link): string
    {
        $parseLink = parse_url($link);

        return $parseLink['scheme'].'://'.$parseLink['host'].$parseLink['path'];
    }
}