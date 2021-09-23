<?php

namespace ImageKit\Resource;

/**
 *
 */
interface HttpRequest
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @return mixed
     */
    public function post();

    /**
     * @param $uri
     * @return mixed
     */
    /**
     * @param $uri
     * @return mixed
     */
    public function setUri($uri);

    /**
     * @param array $datas
     * @return mixed
     */
    public function setDatas(array $datas);

    /**
     * @param array $headers
     * @return mixed
     */
    public function setHeaders(array $headers);
}
