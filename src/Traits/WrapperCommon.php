<?php

namespace Se7enet\Florms\Traits;

trait WrapperCommon
{
    /**
     * Set some default options and attributes prior to rendering the final
     * HTML.
     *
     * @return void
     */
    public function setDefaults()
    {
        $this->setDefaultClass();
    }

    /**
     * Prepend the default class name onto the element.
     *
     * @return void
     */
    public function setDefaultClass()
    {
        $class = $this->getDefaultClass();

        if (!empty($class)) {
            $this->prependAttribute('class', $class);
        }
    }
}
