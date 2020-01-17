<?php
    // callback function
    function respond($isError, $response) {
        if($isError) {
            return (object) array(
                "err" => $response,
                "success" => null
            );
        } else {
            return (object) array(
                "err" => null,
                "success" => $response
            );
        }
    }
