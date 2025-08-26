<?php

namespace ImageKit\Core\Errors;

class BadRequestError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'ImageKit Bad Request Error';
}
