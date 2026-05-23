<?php

namespace ImageKit\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ImageKit Not Found Exception';
}
