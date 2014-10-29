<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Libs;

/**
 * Description of AccessToken
 *
 * @author narendra.singh
 */
class AuthToken
{

    public function generateAuthToken ($password)
    {
        $timestamp = strtotime(date('Y-m-d H:i:s'));
        $token = $timestamp.$password;
        $hash = md5($token);
        return $hash;
    }

}
