<?php
/**
 * @created 28.11.13 - 10:08
 * @author stefanriedel
 */

namespace Srit83\Extsentry\Models\Eloquent;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class User extends \Cartalyst\Sentry\Users\Eloquent\User {

    CONST HASH_PREFIX = '$2y$10$';

    protected static $_sLoginModel = 'Srit83\Extsentry\Models\Eloquent\Login';

    public static function scopeSignature(Builder $oQuery, $sSignature) {
        return $oQuery->where('signature', '=', static::HASH_PREFIX.$sSignature);
    }

    public static function setLoginModel($sLoginModel) {
        static::$_sLoginModel = $sLoginModel;
    }

    public function logins() {
        return $this->hasMany(static::$_sLoginModel);
    }

    public function recordLogin()
    {
        $oLogin = new Login();
        $this->logins()->save($oLogin);
        return parent::recordLogin();
    }

    public function recordLogout() {
        if($oLogin = Login::lastLoginWithIpAndSession(\Request::getClientIp(), \Session::getId())->first()) {
            $oLogin->logout();
        }
        return true;
    }

    public function getApiKey()
    {
        if(empty($this->api_key)) {
            $this->api_key = $this->getRandomString(22);
            $this->save();
        }
        return $this->api_key;
    }

    public function getSignature() {

        if(empty($this->signature)) {
            $this->signature = \Hash::make($this->getApiKey().$this->id.$this->email);
            $this->signature = substr($this->signature, 7);
            $this->save();
        }
        return $this->signature;

        //return hash_hmac('sha256', $this->email.$this->id.$this->getApiKey(),'');
    }


} 