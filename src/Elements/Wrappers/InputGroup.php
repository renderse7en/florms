<?php

namespace Se7enet\Florms\Elements\Wrappers;

use Se7enet\Florms\Elements\Div;
use Se7enet\Florms\Traits\WrapperCommon;
use Se7enet\Florms\FlormsFacade as Florm;
use Se7enet\Florms\Traits\HasParentControl;

class InputGroup extends Div
{
    /**
     * Traits
     */
    use HasParentControl,
        WrapperCommon;

    /**
     * Add an InputGroupAppend div.
     *
     * @param InputGroupAppend $append
     *
     * @return $this
     */
    public function append(InputGroupAppend $append)
    {
        $this->_option('append', $append);
    }

    /**
     * Add an InputGroupPrepend div.
     *
     * @param InputGroupPrepend $prepend
     *
     * @return $this
     */
    public function prepend(InputGroupPrepend $prepend)
    {
        $this->_option('prepend', $prepend);
    }

    /**
     * Render the tag opener and the prepend div.
     *
     * @return string
     */
    public function renderOpen()
    {
        $html = parent::renderOpen();

        if ($prepend = $this->getOption('prepend')) {
            $html .= $prepend->render();
        }

        return $html;
    }

    /**
     * Render the append div and the tag closer.
     *
     * @return string
     */
    public function renderClose()
    {
        $html = '';

        if ($append = $this->getOption('append')) {
            $html .= $append->render();
        }

        $html .= parent::renderClose();

        return $html;
    }

    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return Florm::getSkinValue('containers.inputGroup');
    }
}
