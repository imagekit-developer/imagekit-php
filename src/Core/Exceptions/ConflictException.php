<?php

namespace Imagekit\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Imagekit Conflict Exception';
}
