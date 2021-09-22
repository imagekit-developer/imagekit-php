<?php

namespace ImageKit\Configuration;


/**
 *
 */
class Configuration
{
    /**
     * @var string the public key
     */
    public $publicKey = null;

    /**
     * @var string the private key
     */
    public $privateKey = null;

    /**
     * @var string the URL endpoint
     */
    public $urlEndpoint = null;

    /**
     * @var string transformation position. Default will be 'path'.
     */
    public $transformationPosition = null;
}
