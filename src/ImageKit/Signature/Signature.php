<?php


namespace ImageKit\Signature;

define("DEFAULT_TIME_DIFF", 1800);


class Signature
{
  function getAuthenticationParameters($token, $expire, $defaultOptions)
  {
      $default_time_diff = 60*30;
      $defaultExpire = time()+$default_time_diff;


      $authParameters = array(
        "token" => isset($token) ? $token : "",
        "expire" => isset($expire) ? $expire : 0,
        "signature" => ""
      );

      $obj = (object) ($defaultOptions);

      if(empty($obj->privateKey) or empty($defaultExpire)){
          return $authParameters;
      }else{

          $tok = isset($token) && strlen($token) > 0 ? $token : $this->gen_uuid();
          $exp = isset($expire) && $expire > 0 ? $expire : $defaultExpire;
          $data = $tok.$exp;
          $signature =   hash_hmac('sha1', $data, $obj->privateKey );

          $authParameters['token']=$tok;
          $authParameters['expire']=$exp;
          $authParameters['signature']=$signature;

          return $authParameters;
      }
  }

    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

}
