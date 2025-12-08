<?php

namespace Imagekit\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Imagekit Not Found Exception';
}
