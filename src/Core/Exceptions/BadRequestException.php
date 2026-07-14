<?php

namespace ImageKit\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ImageKit Bad Request Exception';
}
