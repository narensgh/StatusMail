<?php

return array(
    "mailer" => array(
        "smtpDebug" => 0,
        "debugoutput" => "html",
        "host" => "ssl://smtp.gmail.com",
        "smtpSecure" => "ssl",
        "port"=> 465,
        "smtpAuth" => true,
        "username" => "narendra.singh@synergytechservices.com",
        "password" => "",
        "fromEmail" => "notify@gmail.com",
        "fromName" => "notify",
        "replyToEmail" => "noreply@gmail.com",
        "replyToName" => "noreply",
    ),
    'session' => array(
        'cache_expire' => 100,
        'cookie_domain' => 'taskmanager',
        'cookie_lifetime' => 100,
        'cookie_path' => '/',
        'cookie_secure' => TRUE,
        'gc_maxlifetime' => 10,
        'name' => 'taskmanager',
        'remember_me_seconds' => 100,
        'use_cookies' => TRUE,
    )
);
