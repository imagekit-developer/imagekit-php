<?php

namespace ImageKit\Core\Errors;

class UnprocessableEntityError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'ImageKit Unprocessable Entity Error';
}
