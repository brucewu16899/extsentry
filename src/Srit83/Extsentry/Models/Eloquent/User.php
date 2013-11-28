<?php
/**
 * @created 28.11.13 - 10:08
 * @author stefanriedel
 */

namespace Srit83\Extsentry\Models\Eloquent;


use Illuminate\Database\Eloquent\Builder;

class User extends \Cartalyst\Sentry\Users\Eloquent\User {

    protected static $_sLoginModel = 'Srit83\Extsentry\Models\Eloquent\Login';

    public static function scopeSignature(Builder $oQuery, $sSignature) {
        return $oQuery->where(\DB::raw('SHA2(CONCAT(email, api_key), 256)'), '=', $sSignature);
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


} 