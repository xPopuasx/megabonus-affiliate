<?php

namespace Megabonus\Laravel\Affiliate;

interface Check
{
    /**
     * @param string $link
     * @return mixed
     */
    public function check(string $link);

}
