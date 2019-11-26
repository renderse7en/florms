<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;
use Se7enet\Florms\Elements\Element;

class Inputs extends Input
{
    /**
     * Array of child elements in this group of inputs.
     *
     * @var Element[]
     */
    public $children;

    /**
     * Multi-field groups do not need an ID.
     *
     * @return void
     */
    public function needsDefaultId()
    {
        return false;
    }

    /**
     * Multi-field groups do not need a value.
     *
     * @return void
     */
    public function needsDefaultValue()
    {
        return false;
    }

    /**
     * Open the element and all of the various wrapper pieces that should come
     * before it. For
     *
     * @return string
     */
    public function renderOpen()
    {
        $input = parent::renderOpen();

        $html = '';

        if ($this->formGroup) {
            $html .= $this->formGroup->renderOpen();
        }

        if ($this->label && $this->labelBeforeElement()) {
            $html .= $this->label->render();
        }

        return $html;
    }

    /**
     * Close the element and all of the various wrapper pieces that should come
     * after it.
     *
     * @return string
     */
    public function renderClose()
    {
        $html = '';

        if ($this->label && $this->labelAfterElement()) {
            $html .= $this->label->render();
        }

        if ($this->formGroup) {
            $html .= $this->formGroup->renderClose();
        }

        return $html;
    }

    /**
     * Render all child elements in the group of inputs.
     *
     * @return string
     */
    public function renderContent()
    {
        $html  = '';
        $count = 0;

        foreach ($this->children as $child) {
            $count++;
            $html .= $child->render() . PHP_EOL;
        }

        return $html;
    }
}
