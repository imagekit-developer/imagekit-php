<?php

namespace ImageKit\Resource;

use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

interface HttpRequest
{
    public function get();
    public function post();
    public function setUri($uri);
    public function setDatas(array $datas);
    public function setHeaders(array $headers);
}

class GuzzleHttpWrapper implements HttpRequest
{
    protected $client;
    protected $datas = [];
    protected $headers = [];
    protected $uri;
    protected $serviceId;

    const DEFAULT_ERROR_CODE = 500;

    public function __construct($client)
    {
        $this->client     = $client;
        $this->serviceId  = $this->gen_uuid();
    }

    public function setDatas(array $datas)
    {
        $this->datas = array_filter($datas, function ($var) {
            if ($var === "" || $var === null || is_array($var) && count($var) === 0) {
                return false;
            }

            return true;
        });
    }

    public function getDatas()
    {
        return $this->datas;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    public function get()
    {
        try {
            $response = $this->client->request('GET', $this->getUri(), $this->getOptions('query'));
            return $response;
        } catch (RequestException $e) {
            return $this->handleRequestException($e);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete()
    {
        try {
            $response = $this->client->request('DELETE', $this->getUri(), $this->getOptions('query'));
            return $response;
        } catch (RequestException $e) {
            return $this->handleRequestException($e);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function postMultipart()
    {
        try {
            $options = [
                'headers' => $this->headers,
                'multipart' => self::getMultipartData($this->datas)
            ];

            return $this->client->request('POST', $this->getUri(), $options);
        } catch (RequestException $e) {
            return $this->handleRequestException($e);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function post()
    {
        try {
            $options = [
                'headers' => $this->headers,
                'form_params' => $this->datas
            ];

            return $this->client->request('POST', $this->getUri(), $options);
        } catch (RequestException $e) {
            return $this->handleRequestException($e);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function rawPost()
    {
        try {
            $options = [
                'body' => json_encode($this->datas),
                'headers' => ['Content-Type' => 'application/json']
            ];

            return $this->client->request('POST', $this->getUri(), $options);
        } catch (RequestException $e) {
            return $this->handleRequestException($e);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function patch()
    {
        try {
            $options = [
                'headers' => $this->headers,
                'json' => $this->datas
            ];
            return $this->client->request('PATCH', $this->getUri(), $options);
        } catch (RequestException $e) {
            return $this->handleRequestException($e);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    protected function checkUri()
    {
        if (is_null($this->getUri())) {
            throw new UriNotSetException('Uri should be set.', self::DEFAULT_ERROR_CODE);
        }
    }

    protected function getUri()
    {
        return $this->uri;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    protected function getOptions($dataType)
    {
        $params =
            [
                $dataType => $this->datas,
                'headers' => $this->headers,
            ];
        return $params;
    }

    protected function handleRequestException(RequestException $e)
    {
        $status = $e->getCode();
        $headers = [];
        $body = "";
        if ($e->hasResponse()) {
            $body = (string) $e->getResponse()->getBody();
        }

        $response = new Response($status, $headers, $body);
        return $response;
    }

    protected function handleException(Exception $e)
    {
        $status = $e->getCode();
        $headers = [];
        $body = $e->getMessage();

        $response = new Response($status, $headers, $body);
        return $response;
    }

    function gen_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    public static function getMultipartData($data, $files = false)
    {
        $multipartData = [];

        foreach ($data as $key => $value) {
            if (is_bool($value)) {
                $data[$key] = json_encode($value);
            }
        }

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $multipartData[] = ['name' => $key, 'contents' => $value];
                continue;
            }

            foreach ($value as $multiKey => $multiValue) {
                $multiName = $key . '[' . $multiKey . ']' . (is_array($multiValue) ? '[' . key($multiValue) . ']' : '') . '';
                $multipartData[] = ['name' => $multiName, 'contents' => (is_array($multiValue) ? reset($multiValue) : $multiValue)];
            }
        }

        return $multipartData;
    }
}
