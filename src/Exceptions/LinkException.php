<?php

declare(strict_types=1);

namespace Megabonus\Extensions;

use InvalidArgumentException;
use Throwable;

class LinkException extends InvalidArgumentException
{
    /**
     * @param  string  $message
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct(
        $message = 'Invalid link',
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return LinkException
     */
    public static function url(): LinkException
    {
        return new static(' invalid url');
    }

    /**
     * @return LinkException
     */
    public static function host(): LinkException
    {
        return new static('Link contains invalid host');
    }
}
