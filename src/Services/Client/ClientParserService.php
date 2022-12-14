<?php

namespace Megabonus\Laravel\Affiliate\Services\Client;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Megabonus\Laravel\Affiliate\Exceptions\ParserException;

class ClientParserService
{
    private $productData = [];

    /**
     * @param array $response
     * @return bool
     */
    public function checkParse(array $response): bool
    {
        try {
            if (!isset($response['resp_result'])) {
                return false;
            }

            $shop_id = (isset($response['resp_result']['result']['products']))
                ? $response['resp_result']['result']['products']['product']['shop_id']
                : 0;

            if (isset($response['resp_result']['result']['current_record_count']) && ($response['resp_result']['result']['current_record_count'] == "1")) {
                $product = $response['resp_result']['result']['products']['product'];

                $this->productData['title'] = $product['product_title'];
                $this->productData['commission_rate'] = (float)(str_replace('%', '', ($product['commission_rate'] ?? '0')));
                $this->productData['relevant_market_commission_rate'] = (float)(str_replace('%', '', $product['relevant_market_commission_rate'] ?? '0'));
                $this->productData['price'] = (float)$product['target_original_price'];
                $this->productData['currency'] = $product['target_original_price_currency'];
                $this->productData['img'] = $product['product_main_image_url'];
                $this->productData['shop_id'] = $shop_id;

                if ($this->productData['commission_rate'] == 100 && $this->productData['relevant_market_commission_rate'] == 100) {
                    $this->productData['affiliate'] = 0;

                    return false;
                }

                $this->productData['affiliate'] = 1;

                return true;
            }

            $this->productData['affiliate'] = (int)($response['resp_result']['resp_code'] == '200' && (!isset($response['resp_result']['result']['current_record_count'])));

            return (bool)$this->productData['affiliate'];

        } catch (Exception $exception) {
            throw ParserException::checkParse();
        }
    }

    /**
     * @return array
     */
    public function getProductData():array
    {
        return $this->productData;
    }
}