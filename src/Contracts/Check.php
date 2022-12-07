<?php

namespace Megabonus\Laravel\Affiliate\Contracts;

interface Check
{
    /**
     * @param string $link
     * @return mixed
     */
    public function check(string $link);
}
