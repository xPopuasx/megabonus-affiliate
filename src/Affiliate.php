<?php

declare(strict_types=1);

namespace Megabonus\Laravel\Affiliate;

use Megabonus\Laravel\Affiliate\Clients\TaoBaoClient;
use Megabonus\Laravel\Affiliate\Contracts\Check;
use Megabonus\Laravel\Affiliate\Services\Check\CheckService;
use Megabonus\Laravel\Affiliate\Services\Client\ClientParserService;

class Affiliate implements Check
{
    private $checkService;

    private $client;

    private $parserService;

    public function __construct(CheckService $checkService, TaoBaoClient $taoBaoClient, ClientParserService $clientParserService){
        $this->checkService = $checkService;
        $this->client = $taoBaoClient;
        $this->parserService = $clientParserService;
    }

    /**
     * {@inheritdoc}
     */
    public function check(string $link, bool $needSave): bool
    {
        $this->checkService->checkConfig();

        $this->checkService->checkLink($link);

        $model = $this->checkService->getModel($link);

        if($model instanceof \stdClass){
            if(strtotime($model->{config('affiliate.has_affiliate_links_table.columns.updated_at')}) >
                strtotime("-". config('affiliate.expire_in_days'). " day")){
                return true;
            }
        }

        $id = $this->checkService->getItemId($link);

        $response = $this->client->request($id);

        $affiliate = $this->parserService->checkParse(json_decode(json_encode($response), true));

        if($needSave){
            $this->checkService->insertSaveRow($this->parserService->getProductData(), $link);
        }

        return $affiliate;
    }

    /**
     * @param array $links
     * @param bool $needSave
     * @return mixed|void
     */
    public function checkArray(array $links, bool $needSave): bool
    {
        return false;
    }
}