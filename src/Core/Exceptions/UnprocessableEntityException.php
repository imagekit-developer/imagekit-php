<?php

namespace Imagekit\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Imagekit Unprocessable Entity Exception';
}
