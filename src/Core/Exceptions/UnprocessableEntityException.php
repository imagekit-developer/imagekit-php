<?php

namespace ImageKit\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ImageKit Unprocessable Entity Exception';
}
