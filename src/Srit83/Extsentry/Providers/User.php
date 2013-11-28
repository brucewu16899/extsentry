<?php
/**
 * @created 27.11.13 - 16:23
 * @author stefanriedel
 */

namespace Srit83\Extsentry\Providers;


class User extends \Cartalyst\Sentry\Users\Eloquent\Provider {

    protected $model = 'Srit83\Extsentry\Models\Eloquent\User';

    public function findBySignature($sSignature) {
        $oModel = $this->createModel();
        $oUser = $oModel->signature($sSignature)->first();
        return $oUser;
    }

} 