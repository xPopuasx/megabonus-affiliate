<?php

namespace Magebonus\Laravel\Affiliate\Repositories;

class TaoBaoClientRepository
{
    private $appSignature;

    private $fields;

    private $productIds;

    private $targetCurrency;

    private $targetLanguage;

    private $trackingId;

    private $apiParas = [];

    /**
     * @param $appSignature
     * @return void
     */
    public function setAppSignature($appSignature)
    {
        $this->appSignature = $appSignature;
        $this->apiParas["app_signature"] = $appSignature;
    }

    /**
     * @return void
     */
    public function getAppSignature()
    {
        return $this->appSignature;
    }

    /**
     * @param $fields
     * @return void
     */
    public function setFields($fields): void
    {
        $this->fields = $fields;
        $this->apiParas["fields"] = $fields;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param $productIds
     * @return void
     */
    public function setProductIds($productIds): void
    {
        $this->productIds = $productIds;
        $this->apiParas["product_ids"] = $productIds;
    }

    /**
     * @return mixed
     */
    public function getProductIds()
    {
        return $this->productIds;
    }

    /**
     * @param $targetCurrency
     * @return void
     */
    public function setTargetCurrency($targetCurrency): void
    {
        $this->targetCurrency = $targetCurrency;
        $this->apiParas["target_currency"] = $targetCurrency;
    }

    /**
     * @return mixed
     */
    public function getTargetCurrency()
    {
        return $this->targetCurrency;
    }

    /**
     * @param $targetLanguage
     * @return void
     */
    public function setTargetLanguage($targetLanguage): void
    {
        $this->targetLanguage = $targetLanguage;
        $this->apiParas["target_language"] = $targetLanguage;
    }

    /**
     * @return mixed
     */
    public function getTargetLanguage()
    {
        return $this->targetLanguage;
    }

    /**
     * @param $trackingId
     * @return void
     */
    public function setTrackingId($trackingId): void
    {
        $this->trackingId = $trackingId;
        $this->apiParas["tracking_id"] = $trackingId;
    }

    /**
     * @return mixed
     */
    public function getTrackingId()
    {
        return $this->trackingId;
    }

    /**
     * @return string
     */
    public function getApiMethodName(): string
    {
        return "aliexpress.affiliate.productdetail.get";
    }

    /**
     * @return array
     */
    public function getApiParas(): array
    {
        return $this->apiParas;
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function putOtherTextParam($key, $value) {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}