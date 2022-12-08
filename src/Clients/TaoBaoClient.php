<?php

namespace Megabonus\Laravel\Affiliate\Clients;

use Megabonus\Laravel\Affiliate\Repositories\TaoBaoClientRepository;
use ResultSet;

class TaoBaoClient
{
    private $apiKey;

    private $clientSecret;

    private $trackingId;

    private $taoBaoClientRepository;

    private $client;

    public function __construct(TaoBaoClientRepository $taoBaoClientRepository){
        $this->apiKey = config('affiliate.api_key');
        $this->clientSecret = config('affiliate.secret_key');
        $this->trackingId = config('affiliate.tracking_id');
        $this->client = new \TopClient();
        $this->taoBaoClientRepository = $taoBaoClientRepository;
    }

    /**
     * @param string $productIds
     * @param string $fields
     * @return  array|mixed|object|ResultSet|SimpleXMLElement
     */
    public function request(string $productIds, string $fields = "commission_rate,sale_price")
    {
        $this->taoBaoClientRepository->setFields($fields);
        $this->taoBaoClientRepository->setTargetCurrency("RUB");
        $this->taoBaoClientRepository->setTargetLanguage("RU");
        $this->taoBaoClientRepository->setAppSignature($this->trackingId);
        $this->taoBaoClientRepository->setProductIds($productIds);
        $this->taoBaoClientRepository->setTrackingId(12);

        $this->client->appkey = $this->apiKey;
        $this->client->secretKey = $this->clientSecret;

        return $this->client->execute($this->taoBaoClientRepository);
    }
}