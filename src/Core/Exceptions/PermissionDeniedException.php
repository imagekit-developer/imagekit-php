<?php

namespace Imagekit\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Imagekit Permission Denied Exception';
}
