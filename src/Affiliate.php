<?php

declare(strict_types=1);

use Megabonus\Contracts\Check;

class Affiliate implements Check
{
    public function __construct(){

    }

    /**
     * {@inheritdoc}
     */
    public function check(string $link)
    {
        dd($link);
    }
}