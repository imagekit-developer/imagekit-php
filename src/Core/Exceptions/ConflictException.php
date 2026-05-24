<?php

namespace ImageKit\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ImageKit Conflict Exception';
}
