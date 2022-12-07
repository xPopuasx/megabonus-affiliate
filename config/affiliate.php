<?php

return [
    /*
     * set access hosts
     * @example 13087123b91c0876095841-057160897603409=-123
     */
    'tao_bao_token' => '',
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
        'column_name' => ''
    ],
    /*
     * indicate the table in which the shops-exclusions are indicated
     * @example ali_exception_shop
     */
    'has_shop_exceptions_table' => [
        'table' => '',
        'column_name' => ''
    ]
];
