<?php

namespace Megabonus\Laravel\Affiliate\Contracts;

interface Client
{
    /**
     * @param string $link
     * @return mixed
     */
    public function request(string $link);
}
