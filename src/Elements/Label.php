<?php

namespace Se7enet\Florms\Elements;

use Se7enet\Florms\FlormsFacade as Florms;
use Se7enet\Florms\Traits\HasParentControl;

class Label extends Element
{
    /**
     * Traits
     */
    use HasParentControl;

    /**
     * Get the HTML tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return 'label';
    }

    /**
     * Set some default options and attributes prior to rendering the final
     * HTML.
     *
     * @return void
     */
    public function setDefaults()
    {
        $this->setDefaultFor();
        $this->setDefaultClass();
    }

    /**
     * Set the default 'for' attribute.
     *
     * @return void
     */
    public function setDefaultFor()
    {
        if (!$this->needsDefaultFor()) {
            return;
        }

        $for = $this->getDefaultFor();

        $this->for($for);
    }

    /**
     * Do we need to populate the default 'for' attribute?
     *
     * @return boolean
     */
    public function needsDefaultFor()
    {
        return !$this->hasAttribute('for');
    }

    /**
     * Get the ID of the parent control, to be used for the default 'for' value.
     *
     * @return string
     */
    public function getDefaultFor()
    {
        $control = $this->getControl();

        return $control->getAttribute('id');
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

    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        $control = $this->getControl();

        return Florms::getSkinValue('controls.' . $control->getControlType() . '.label');
    }

    /**
     * Specifies which form element a label is bound to
     *
     * @param string $for
     *
     * @return $this
     */
    public function for($for = '')
    {
        return $this->_attribute('for', $for);
    }

    /**
     * Specifies the form the <label> element belongs to
     *
     * @param string $formId
     *
     * @return $this
     */
    public function form($formId = '')
    {
        return $this->_attribute('form', $formId);
    }
}
