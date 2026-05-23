<?php

namespace ImageKit\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ImageKit Rate Limit Exception';
}
