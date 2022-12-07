<?php

declare(strict_types=1);

namespace Megabonus\Laravel\Affiliate;


use Megabonus\Laravel\Affiliate\Contracts\Check;

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