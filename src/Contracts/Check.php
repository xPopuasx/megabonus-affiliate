<?php

namespace Megabonus\Laravel\Affiliate\Contracts;

interface Check
{
    /**
     * @param string $link
     * @param bool $needSave
     * @return mixed
     */
    public function check(string $link, bool $needSave);
}
