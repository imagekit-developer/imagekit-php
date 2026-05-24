<?php

namespace ImageKit\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ImageKit Authentication Exception';
}
