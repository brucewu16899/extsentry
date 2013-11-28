<?php
/**
 * @created 27.11.13 - 14:38
 * @author stefanriedel
 */

namespace Srit83\Extsentry\Facades;
use Illuminate\Support\Facades\Facade;

class Extsentry extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'extsentry';
    }
} 