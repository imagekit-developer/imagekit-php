<?php

namespace ImageKit\Errors;

class InternalServerError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'ImageKit Internal Server Error';
}
