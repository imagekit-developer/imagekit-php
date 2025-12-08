<?php

namespace Imagekit\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Imagekit Internal Server Exception';
}
