<?php namespace Bulforce\ExtDirect\Facades;

use Illuminate\Support\Facades\Facade;

class ExtDirect extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'ext-direct'; }

}