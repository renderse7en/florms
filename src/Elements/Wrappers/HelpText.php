<?php

namespace Se7enet\Florms\Elements\Wrappers;

use Se7enet\Florms\Elements\Small;
use Se7enet\Florms\Traits\WrapperCommon;
use Se7enet\Florms\FlormsFacade as Florms;
use Se7enet\Florms\Traits\HasParentControl;

class HelpText extends Small
{
    /**
     * Traits
     */
    use HasParentControl,
        WrapperCommon;

    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return Florms::getSkinValue('containers.help');
    }
}
