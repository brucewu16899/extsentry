<?php
/**
 * @created 27.11.13 - 14:32
 * @author stefanriedel
 */

namespace Srit83\Extsentry;
use Cartalyst\Sentry\Sentry;

class Extsentry extends Sentry{

    /**
     *
     * an authenticate method for webservices
     *
     *
     * @param $sSignature
     * @param bool $blRemember
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function authenticateOverSignature($sSignature, $blRemember = false) {
        if($oUser = $this->userProvider->findBySignature($sSignature)) {
            $this->login($oUser, $blRemember);
            return $this->user;
        }
    }

    public function logout()
    {
        $this->getUser()->recordLogout();
        parent::logout();
    }

    public function register(array $aCredentials, $blActivate = false)
    {
        $oUser = parent::register($aCredentials, $blActivate);
        $oUser->getApiKey();
        $oUser->getSignature();
        return $oUser;
    }


} 