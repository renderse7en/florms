<?php

namespace Se7enet\Florms\Elements;

use Se7enet\Florms\Elements\Legend;
use Se7enet\Florms\FlormsFacade as Florms;

class Fieldset extends Element
{
    /**
     * The legend for this fieldset.
     *
     * @var Legend
     */
    public $legend;

    /**
     * Get the HTML tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return 'fieldset';
    }

    /**
     * Specifies that an <input> element should be disabled
     *
     * @param boolean $disabled Defaults to true when this method is called
     *                          with no arguments.
     *
     * @return $this
     */
    public function disabled($disabled = true)
    {
        return $this->_attribute('disabled', !!$disabled);
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

    /**
     * Add a <legend> to this <fieldset>
     *
     * @param string $legend
     *
     * @return $this
     */
    public function legend($legend)
    {
        $this->legend = Florms::legend()->content($legend);

        return $this;
    }

    /**
     * Specifies the name of an <input> element
     *
     * @param string $name
     *
     * @return $this
     */
    public function name($name = '')
    {
        return $this->_attribute('name', $name);
    }
}
