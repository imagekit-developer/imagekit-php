<?php

namespace ImageKit\Core\Errors;

class AuthenticationError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'ImageKit Authentication Error';
}
