<?php

declare(strict_types=1);

namespace Megabonus\Laravel\Affiliate\Exceptions;

use InvalidArgumentException;
use Throwable;

class ConfigException extends InvalidArgumentException
{
    /**
     * @param  string  $message
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct(
        $message = 'Config error',
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return ConfigException
     */
    public static function apiKey(): ConfigException
    {
        return new static('undefined api key');
    }

    /**
     * @return ConfigException
     */
    public static function clientSecret(): ConfigException
    {
        return new static('undefined client secret');
    }

    /**
     * @return ConfigException
     */
    public static function trackingId(): ConfigException
    {
        return new static('undefined tracking Id');
    }
}
