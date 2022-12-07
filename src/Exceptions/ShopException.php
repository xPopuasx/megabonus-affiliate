<?php

declare(strict_types=1);

namespace Megabonus\Laravel\Affiliate\Exceptions;

use InvalidArgumentException;
use Throwable;

class ShopException extends InvalidArgumentException
{
    /**
     * @param  string  $message
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct(
        $message = 'Invalid Shop',
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return ShopException
     */
    public static function exception(): ShopException
    {
        return new static('This shop is Exception');
    }
}
