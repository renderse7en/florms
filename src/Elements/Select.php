<?php

namespace Se7enet\Florms\Elements;

use Se7enet\Florms\Traits\HasFormEvents;
use Se7enet\Florms\Traits\InputDefaults;
use Se7enet\Florms\FlormsFacade as Florms;
use Se7enet\Florms\Traits\InputCommonOptions;
use Se7enet\Florms\Traits\InputCommonAttributes;

class Select extends Element
{
    /**
     * Include the traits.
     */
    use HasFormEvents,
        InputCommonAttributes,
        InputCommonOptions,
        InputDefaults;

        /**
     * Array of all possible options for the <select> element.
     *
     * @var array
     */
    public $options = [];

    /**
     * The value of the option to be preselected.
     *
     * @var mixed
     */
    public $value;

    /**
     * Get the HTML tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return 'select';
    }

    /**
     * Get the type of control, for purposes of inheriting skin settings.
     *
     * @return string
     */
    public function getControlType()
    {
        return 'select';
    }

    /**
     * Render each <option> and/or <optgroup> inside this <select> box.
     *
     * @return string
     */
    public function renderContent()
    {
        $html = '';

        foreach ($this->options as $key => $value) {

            // If the value is also an array (or similar), it indicates that
            // this should be an <optgroup>.
            if (is_iterable($value)) {

                $options = '';

                foreach ($value as $groupKey => $groupValue) {
                    $options .= $this->renderOption($groupKey, $groupValue);
                }

                $html .= $this->renderOptGroup($key, $options);
            }

            // Otherwise just render the individual option.
            else {
                $html .= $this->renderOption($key, $value);
            }
        }

        return $html;
    }

    /**
     * Render an <optgroup> into this <select>.
     *
     * @param string $label
     * @param string $content
     *
     * @return string
     */
    public function renderOptGroup($label, $content)
    {
        $optgroup = Florms::optgroup()->control($this)->label($label)->content($content);

        return $optgroup->render();
    }

    /**
     * Render an <option> into this <select> or <optgroup>.
     *
     * @param string $value
     * @param string $content
     *
     * @return string
     */
    public function renderOption($value, $content)
    {
        $option = Florms::option()->control($this)->value($value)->content($content);

        return $option->render();
    }
}
