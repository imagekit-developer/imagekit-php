<?php


namespace ImageKit\Resource;


class UriNotSetException extends \Exception
{

    /**
     * UriNotSetException constructor.
     * @param string $string
     * @param int $DEFAULT_ERROR_CODE
     */
    public function __construct(string $string, int $DEFAULT_ERROR_CODE)
    {
    }
}
