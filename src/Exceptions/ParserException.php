<?php

declare(strict_types=1);

namespace Megabonus\Laravel\Affiliate\Exceptions;

use InvalidArgumentException;
use Throwable;

class ParserException extends InvalidArgumentException
{
    /**
     * @param  string  $message
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct(
        $message = 'Parser error',
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return ParserException
     */
    public static function checkParse(): ParserException
    {
        return new static('An error occurred during parsing');
    }
}
