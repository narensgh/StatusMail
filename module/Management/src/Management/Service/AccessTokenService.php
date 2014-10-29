<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Management\Service;

/**
 * Description of AccessTokenService
 *
 * @author narendra.singh
 */

use Management\Model\Entity\AccessToken;
use Libs\AuthToken;

class AccessTokenService extends Common
{

    public function __construct ($em)
    {
        parent::__construct($em);
    }

    public function setAccessToken ($peopleInfo)
    {
        $accessToken = new AuthToken();
        $tokenHash = $accessToken->generateAuthToken($peopleInfo['password']);
        $accessToken = $this->_em->getRepository('Management\Model\Entity\AccessToken')->findOneByPeopleId(array ('peopleId' => $peopleInfo['peopleId']));
        if (!$accessToken) {
            $accessToken = new AccessToken();
            $accessToken->setPeopleId($peopleInfo['peopleId']);
        }
        $accessToken->setAuthToken($tokenHash);
        $accessToken->setExpired('no');
        $updateTime =  new \DateTime('now');
        $accessToken->setUpdateTime($updateTime);
        try{
            $this->_em->persist($accessToken);
            $this->_em->flush();
        } catch (\Exception $ex){
            throw $ex;
        }
    }

}
