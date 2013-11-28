<?php
/**
 * @created 28.11.13 - 10:08
 * @author stefanriedel
 */

namespace Srit83\Extsentry\Models\Eloquent;


use Illuminate\Database\Eloquent\Builder;

class User extends \Cartalyst\Sentry\Users\Eloquent\User{
    public static function scopeSignature(Builder $oQuery, $sSignature) {
        return $oQuery->where(\DB::raw('SHA2(CONCAT(email, api_key), 256)'), '=', $sSignature);
    }
} 