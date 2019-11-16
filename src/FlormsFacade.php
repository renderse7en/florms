<?php

namespace Se7enet\Florms;

use Illuminate\Support\Facades\Facade;

class FlormsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'florms';
    }
}
