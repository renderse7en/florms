<?php

namespace Se7enet\Florms\Elements;

use Illuminate\Support\Arr;
use Se7enet\Florms\Traits\HasFormEvents;
use Se7enet\Florms\Traits\InputDefaults;
use Se7enet\Florms\Traits\InputCommonOptions;
use Se7enet\Florms\Traits\InputCommonAttributes;

class Input extends Element
{
    /**
     * Include the traits.
     */
    use HasFormEvents,
        InputCommonAttributes,
        InputCommonOptions,
        InputDefaults;

    /**
     * Get the HTML tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return 'input';
    }

    /**
     * Get the type of control, for purposes of inheriting skin settings.
     *
     * @return string
     */
    public function getControlType()
    {
        return 'text';
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
     * Defines that form elements should not be validated when submitted
     *
     * @param boolean $novalidate   Defaults to true when this method is called
     *                              with no arguments.
     *
     * @return $this
     */
    public function formNoValidate($novalidate = true)
    {
        return $this->_attribute('formnovalidate', !!$novalidate);
    }

    /**
     * Refers to a <datalist> element that contains pre-defined options for
     * an <input> element
     *
     * @param string $listId
     *
     * @return $this
     */
    public function list($listId = '')
    {
        return $this->_attribute('list', $listId);
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
     * Specifies that a user can enter more than one value in an <input>
     * element
     *
     * @param boolean $multiple
     *
     * @return $this
     */
    public function multiple($multiple = true)
    {
        return $this->_attribute('multiple', !!$multiple);
    }

    /**
     * Specifies a regular expression that an <input> element's value is checked
     * against
     *
     * @param string $regexp
     *
     * @return $this
     */
    public function pattern($regexp = '')
    {
        return $this->_attribute('pattern', $regexp);
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
     * Specifies the width, in characters, of an <input> element
     *
     * @param integer $size
     *
     * @return $this
     */
    public function size($size = 0)
    {
        return $this->_attribute('size', intval($size));
    }

    /**
     * Specifies the type <input> element to display
     *
     * @param string $type  Allowed values are:
     *                      - 'button'
     *                      - 'checkbox'
     *                      - 'color'
     *                      - 'date'
     *                      - 'datetime-local'
     *                      - 'email'
     *                      - 'file'
     *                      - 'hidden'
     *                      - 'image'
     *                      - 'month'
     *                      - 'number'
     *                      - 'password'
     *                      - 'radio'
     *                      - 'range'
     *                      - 'reset'
     *                      - 'search'
     *                      - 'submit'
     *                      - 'tel'
     *                      - 'text'
     *                      - 'time'
     *                      - 'url'
     *                      - 'week'
     *
     * @return $this
     */
    public function type($type = 'text')
    {
        return $this->_attribute('type', $type);
    }

    /**
     * Specifies the value of an <input> element
     *
     * @param string $value
     *
     * @return $this
     */
    public function value($value = '')
    {
        return $this->_attribute('value', $value);
    }
}
