<?php

namespace Se7enet\Florms\Elements\Inputs;

use Illuminate\Support\Arr;
use Se7enet\Florms\Elements\Textarea as InputTextarea;

class Textarea extends InputTextarea
{
    /**
     * Specifies the visible width of a text area
     *
     * @param integer $cols
     *
     * @return $this
     */
    public function cols($cols = 0)
    {
        return $this->attribute('cols', intval($cols));
    }

    /**
     * Specifies that the text direction will be submitted. Per HTML spec, the
     * value of this attribute is always "[inputname].dir". This method takes
     * no arguments, and should only be called after the field name has been
     * set.
     *
     * @return $this
     */
    public function dirname()
    {
        $name = Arr::get($this->attributes, 'name');

        return $this->_attribute('dirname', $name . '.dir');
    }

    /**
     * Specifies the maximum number of characters allowed in an <input> element
     *
     * @param integer $maxLength
     *
     * @return $this
     */
    public function maxLength($maxLength = 0)
    {
        return $this->_attribute('maxlength', intval($maxLength));
    }

    /**
     * Specifies a short hint that describes the expected value of an <input>
     * element
     *
     * @param string $placeholder
     *
     * @return $this
     */
    public function placeholder($placeholder = '')
    {
        return $this->_attribute('placeholder', $placeholder);
    }

    /**
     * Specifies that an input field is read-only
     *
     * @param boolean $readonly Defaults to true when this method is called with
     *                          no arguments.
     *
     * @return $this
     */
    public function readonly($readonly = true)
    {
        return $this->_attribute('readonly', !!$readonly);
    }

    /**
     * Specifies that a text area is required/must be filled out
     *
     * @param integer $rows
     *
     * @return $this
     */
    public function rows($rows = 0)
    {
        return $this->_attribute('rows', intval($rows));
    }

    /**
     * Textareas don't have a "value" attribute, the content goes inside the
     * element, but for consistency's sake, we'll redirect any usage of the
     * value() method to the content() method.
     *
     * @param string $value
     *
     * @return $this
     */
    public function value($value)
    {
        return $this->content($value);
    }

    /**
     * Specifies how the text in a text area is to be wrapped when submitted in a form
     *
     * @param string $wrap  Allowed values are 'hard' and 'soft', defaults to
     *                      'soft' when this method is called with no arguments.
     *
     * @return void
     */
    public function wrap($wrap = 'soft')
    {
        return $this->_attribute('wrap', $wrap);
    }
}
