<?php


namespace ImageKit\Signature;

use ImageKit\Configuration\Configuration;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Utils\Response;

/**
 *
 */
class Signature
{
    /**
     * @param $token
     * @param $expire
     * @param Configuration $configuration
     * @return object { token: string, expire: int, signature: string}
     */
    public static function getAuthenticationParameters($token, $expire, Configuration $configuration)
    {
        $default_time_diff = 60 * 30;
        $defaultExpire = time() + $default_time_diff;

        $authParameters = [
            'token' => isset($token) ? $token : '',
            'expire' => isset($expire) ? $expire : 0,
            'signature' => ''
        ];

        $obj = (object)($configuration);

        if (!empty($obj->privateKey) and !empty($defaultExpire)) {

            $tok = isset($token) && strlen($token) > 0 ? $token : GuzzleHttpWrapper::gen_uuid();
            $exp = isset($expire) && $expire > 0 ? $expire : $defaultExpire;
            $data = $tok . $exp;
            $signature = hash_hmac('sha1', $data, $obj->privateKey);

            $authParameters['token'] = $tok;
            $authParameters['expire'] = $exp;
            $authParameters['signature'] = $signature;

        }

        return (object)$authParameters;

    }

}
