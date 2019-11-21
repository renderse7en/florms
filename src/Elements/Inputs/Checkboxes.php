<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;
use Se7enet\Florms\FlormsFacade as Florms;

class Checkboxes extends Input
{
    /**
     * Key/value paired array of each checkbox in this group.
     *
     * @var array
     */
    public $options = [];

    /**
     * Default parameters/options that will be passed into each individual
     * checkbox.
     *
     * @var array
     */
    public $controlDefaults = [];

    /**
     * Populate the list of available options. This should be an array where
     * each key is the "value" attribute of the checkbox, and each value is the
     * label text for the checkbox.
     *
     * You can optionally provide an array of default parameters/options that
     * will be passed into each individual checkbox. Note that the "name" and
     * "id" options will be automatically inherited from the values already
     * passed into this group; and the "value" and "label" options will come
     * from the $options array; and finally, "formGroup" will be disabled,
     * since the overall checkbox group should get the form group but the
     * individual checkboxes themselves should not. If you provide any of these
     * values in the $defaults array, your values will take precedence over what
     * would have been automatically populated.
     *
     * @param array $options
     * @param array $defaults
     *
     * @return $this
     */
    public function options($options = [], $defaults = [])
    {
        $this->options = $options;
        $this->controlDefaults = $defaults;

        return $this;
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
     * Render all checkboxes in the group.
     *
     * @return string
     */
    public function renderContent()
    {
        $html  = '';
        $count = 0;

        foreach ($this->options as $value => $label) {
            $count++;
            $html .= $this->renderOption($value, $label, $count);
        }

        return $html;
    }

    /**
     * Render an individual checkbox into this group.
     *
     * @param string  $value
     * @param string  $label
     * @param integer $count
     *
     * @return string
     */
    public function renderOption($value, $label, $count = 0)
    {
        $id       = $this->getAttribute('id');
        $name     = $this->getAttribute('name');
        $defaults = $this->controlDefaults ?? [];

        $options = array_merge([
            'id'        => sprintf('%s-%s', $id, $count),
            'name'      => $name,
            'value'     => $value,
            'label'     => $label,
            'formGroup' => false,
        ], $defaults);

        $element = $this->getOptionElement($options);

        return $element->render();
    }

    /**
     * Get the element to be used in this checkbox/radio/whatever group.
     *
     * @param array $options
     *
     * @return Checkbox
     */
    public function getOptionElement($options = [])
    {
        return Florms::checkbox($options);
    }
}
