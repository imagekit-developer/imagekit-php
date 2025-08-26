<?php

namespace ImageKit\Core\Errors;

class ConflictError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'ImageKit Conflict Error';
}
