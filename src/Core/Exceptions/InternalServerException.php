<?php

namespace ImageKit\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ImageKit Internal Server Exception';
}
