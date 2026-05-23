<?php

namespace ImageKit\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ImageKit Permission Denied Exception';
}
