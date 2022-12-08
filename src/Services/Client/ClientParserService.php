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
     * @param bool $needSave
     * @param Model|null $model
     * @return bool
     */
    public function checkParse(array $response, bool $needSave, ?Model $model): bool
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
                $this->productData['updated_at'] = date('Y-m-d H:i:s');
                $this->productData['created_at'] = date('Y-m-d H:i:s');

                if($needSave){
                    $this->saveRow($model);
                }

                if ($this->productData['commission_rate'] == 100 && $this->productData['relevant_market_commission_rate'] == 100) {
                    return false;
                }

                return true;
            }

            return ($response['resp_result']['resp_code'] == '200' && (!isset($response['resp_result']['result']['current_record_count'])));

        } catch (Exception $exception) {
            throw ParserException::checkParse();
        }
    }


    private function saveRow(?Model $model): void
    {
        if($model instanceof Model){
            $model->update($this->productData);

            return;
        }

        DB::table(config('affiliate.has_affiliate_links_table.table'))
            ->insert($this->productData);

    }
}