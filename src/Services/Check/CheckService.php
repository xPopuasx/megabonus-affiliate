<?php

namespace Megabonus\Laravel\Affiliate\Services\Check;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Megabonus\Laravel\Affiliate\Exceptions\ConfigException;
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
     * @return \stdClass|null
     */
    public function getModel(string $link): ? \stdClass
    {
        return DB::table(config('affiliate.has_affiliate_links_table.table'))
            ->where(config('affiliate.has_affiliate_links_table.columns.url'), $this->buildLink($link))
            ->where(config('affiliate.has_affiliate_links_table.columns.affiliate'), 1)
            ->first();
    }

    /**
     * @param array $data
     * @param string $url
     * @return void
     */
    public function insertSaveRow(array $data, string $url): void
    {
        DB::table(config('affiliate.has_affiliate_links_table.table'))->updateOrInsert(
            [
                config('affiliate.has_affiliate_links_table.columns.url') => $url,
            ],
            [
                config('affiliate.has_affiliate_links_table.columns.url') => $url,
                config('affiliate.has_affiliate_links_table.columns.affiliate') => $data['affiliate'],
                config('affiliate.has_affiliate_links_table.columns.commission_rate') => $data['commission_rate'],
                config('affiliate.has_affiliate_links_table.columns.relevant_market_commission_rate') => $data['relevant_market_commission_rate'],
                config('affiliate.has_affiliate_links_table.columns.shop_id') => $data['shop_id'],
                config('affiliate.has_affiliate_links_table.columns.created_at') => $data['created_at'],
                config('affiliate.has_affiliate_links_table.columns.updated_at') => $data['updated_at'],
            ]
        );
    }

    public function checkConfig(): void
    {
        if(strlen(config('affiliate.has_affiliate_links_table.table')) == 0){
            throw ConfigException::HasAffiliateLinksTableColumns();
        }

        if(strlen(config('affiliate.has_affiliate_links_table.columns.url')) == 0){
            throw ConfigException::HasAffiliateLinksTableColumns();
        }

        if(strlen(config('affiliate.has_affiliate_links_table.columns.affiliate')) == 0){
            throw ConfigException::HasAffiliateLinksTableColumns();
        }

        if(strlen(config('affiliate.has_affiliate_links_table.columns.commission_rate')) == 0){
            throw ConfigException::HasAffiliateLinksTableColumns();
        }

        if(strlen(config('affiliate.has_affiliate_links_table.columns.relevant_market_commission_rate')) == 0){
            throw ConfigException::HasAffiliateLinksTableColumns();
        }

        if(strlen(config('affiliate.has_affiliate_links_table.columns.shop_id')) == 0){
            throw ConfigException::HasAffiliateLinksTableColumns();
        }

        if(strlen(config('affiliate.has_affiliate_links_table.columns.created_at')) == 0){
            throw ConfigException::HasAffiliateLinksTableColumns();
        }

        if(strlen(config('affiliate.has_affiliate_links_table.columns.updated_at')) == 0){
            throw ConfigException::HasAffiliateLinksTableColumns();
        }
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