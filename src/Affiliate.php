<?php

declare(strict_types=1);

namespace Megabonus\Laravel\Affiliate;

use Megabonus\Laravel\Affiliate\Contracts\Check;
use Megabonus\Laravel\Affiliate\Services\Check\CheckService;

class Affiliate implements Check
{
    private $checkService;

    public function __construct(CheckService $checkService){
        $this->checkService = $checkService;
    }
    /**
     * {@inheritdoc}
     */
    public function check(string $link)
    {
        $this->checkService->checkLink($link);
    }
}