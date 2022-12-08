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
        $this->checkService->checkLink($link);

        if($this->checkService->checkLinkInTable($link)){
            return true;
        }

        $response = $this->client->request($link);

        return $this->parserService->checkParse($response);
    }
}