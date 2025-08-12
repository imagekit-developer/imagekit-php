<?php

namespace ImageKit\Errors;

class ConflictError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'ImageKit Conflict Error';
}
