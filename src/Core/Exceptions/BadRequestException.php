<?php

namespace Imagekit\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Imagekit Bad Request Exception';
}
