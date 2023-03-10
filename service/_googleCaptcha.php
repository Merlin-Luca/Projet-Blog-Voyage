<?php
    function verifyReCaptcha($recaptchaCode)
    {
        $postdata = http_build_query(["secret" => "6LfQpWckAAAAAMR_YJikgZ-ueLPnVQax9l0TJg62", "response" => $recaptchaCode]);
        $opts = [
            'http' =>
            [
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            ]
        ];
        $context  = stream_context_create($opts);
        $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $check = json_decode($result);
        return $check->success;
    }
?>