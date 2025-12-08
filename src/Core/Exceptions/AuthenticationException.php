<?php

namespace Imagekit\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Imagekit Authentication Exception';
}
