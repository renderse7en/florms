<?php

namespace Se7enet\Florms\Elements\Wrappers;

use Se7enet\Florms\Elements\Div;
use Se7enet\Florms\Traits\WrapperCommon;
use Se7enet\Florms\FlormsFacade as Florms;
use Se7enet\Florms\Traits\HasParentControl;

class InputGroup extends Div
{
    /**
     * Traits
     */
    use HasParentControl,
        WrapperCommon;

    /**
     * The InputGroupAppend div.
     *
     * @var InputGroupAppend
     */
    public $append;

    /**
     * The InputGroupPrepend div.
     *
     * @var InputGroupPrepend
     */
    public $prepend;

    /**
     * Add an InputGroupAppend div.
     *
     * @param InputGroupAppend $append
     *
     * @return $this
     */
    public function append(InputGroupAppend $append)
    {
        $this->append = $append;
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
        $this->prepend = $prepend;
    }

    /**
     * Render the tag opener and the prepend div.
     *
     * @return string
     */
    public function renderOpen()
    {
        $html = parent::renderOpen();

        if ($this->prepend) {
            $html .= $this->prepend->render();
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

        if ($this->append) {
            $html .= $this->append->render();
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
        return Florms::getSkinValue('containers.inputGroup');
    }
}
