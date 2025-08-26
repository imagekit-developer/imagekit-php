<?php

namespace ImageKit\Core\Errors;

class PermissionDeniedError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'ImageKit Permission Denied Error';
}
