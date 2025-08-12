<?php

namespace ImageKit\Errors;

class RateLimitError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'ImageKit Rate Limit Error';
}
