<?php
/**
 * @created 28.11.13 - 10:08
 * @author stefanriedel
 */

namespace Srit83\Extsentry\Models\Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use LaravelBook\Ardent\Ardent;

class Login extends Ardent {

    protected $guarded = array();

    public static $rules = array();

    protected static $_sUserModel = 'Srit83\Extsentry\Models\Eloquent\User';

    public function user() {
        $this->belongsTo(static::$_sUserModel);
    }

    public static function setUserModel($sUserModel) {
        static::$_sUserModel = $sUserModel;
    }

    public function beforeCreate() {
        $this->login_at = new Carbon;
        $this->ip = \Request::getClientIp();
        $this->session_id = \Session::getId();
        return true;
    }

    public static function scopeLastLoginWithIpAndSession(Builder $oQuery, $sIp, $sSessionId) {
        return $oQuery->where('ip', '=', $sIp)->where('session_id', '=', $sSessionId);
    }

    public function logout() {
        $this->logout_at = new Carbon;
        return $this->save();
    }

} 