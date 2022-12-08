<?php

return [
    /*
     * set api key
     * @example 4124153152
     */
    'api_key' => env('ALI_API_KEY', ''),
    /*
     * set secret key
     * @example asd14ra24rt43at3t34t23524wq24das4
     */
    'secret_key' => env('ALI_SECRET_KEY', ''),
    /*
     * set tracking id
     * @example you register company
     */
    'tracking_id' => env('ALI_TRACKING_ID', ''),
    /*
     * set access hosts
     * @example ['aliexpress.com','sl.aliexpress.ru',]
     */
    'access_hosts' => [
        'aliexpress.com',
        'sl.aliexpress.ru',
        'www.aliexpress.us'
    ],
    /*
     * indicate the table in which there are already received affiliate links
     * @example ali_check_affiliate
     */
    'has_affiliate_links_table' => [
        'table' => '',
        'columns' => [
            'title',
            'commission_rate',
            'relevant_market_commission_rate',
            'price',
            'currency',
            'img',
            'shop_id',
            'created_at',
            'updated_at'
        ]
    ],
    /*
     * indicate the table in which the shops-exclusions are indicated
     * @example ali_exception_shop
     */
    'has_shop_exceptions_table' => [
        'table' => '',
        'column_name' => ''
    ],
    /*
     * @example ali_exception_shop
     */
    'expire_in_days' => 10
];
