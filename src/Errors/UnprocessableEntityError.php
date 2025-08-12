<?php

namespace ImageKit\Errors;

class UnprocessableEntityError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'ImageKit Unprocessable Entity Error';
}
