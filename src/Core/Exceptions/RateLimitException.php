<?php

namespace Imagekit\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Imagekit Rate Limit Exception';
}
