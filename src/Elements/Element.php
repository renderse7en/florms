<?php

namespace Se7enet\Florms\Elements;

use Illuminate\Support\Arr;
use Se7enet\Florms\Traits\HasDragEvents;
use Se7enet\Florms\Traits\HasMouseEvents;
use Se7enet\Florms\Traits\HasKeyboardEvents;
use Se7enet\Florms\Traits\HasClipboardEvents;
use Se7enet\Florms\Traits\HasGlobalAttributes;

abstract class Element
{
    /**
     * Include the traits.
     */
    use HasDragEvents,
        HasMouseEvents,
        HasKeyboardEvents,
        HasClipboardEvents,
        HasGlobalAttributes;

    /**
     * The attributes of the HTML tag. These will be rendered into the tag
     * output.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The options for this Florm element object. These will not be rendered
     * into the tag output.
     *
     * @var array
     */
    protected $options = [];

    /**
     * Minimized attributes do not specify a value, just a key.
     *
     * @var array
     */
    protected $minimizedAttributes = [
        'hidden',
        'novalidate',
        'autofocus',
        'checked',
        'disabled',
        'readonly',
        'required',
        'selected',
    ];

    /**
     * The contents of the tag. Comes between the opening and closing tags.
     *
     * @var string
     */
    protected $content;

    /**
     * Construct the HTML element.
     *
     * @param array  $attributes
     */
    public function __construct($attributes = [])
    {
        $this->attributes($attributes);
    }

    /**
     * Define the magic method to get the Element as a string.
     *
     * @return string
     */
    public function __toString()
    {
        try {
            $render = $this->render();
        } catch (\Exception $e) {
            dd($e);
        }
        return $render;
    }

    /**
     * Set whatever default values are necessary.
     *
     * @return void
     */
    protected function setDefaults()
    {
        //
    }

    /**
     * Set the content inside this element.
     *
     * @param mixed $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Add the attribute key/value to the complete array of attributes.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    protected function _attribute($key, $value)
    {
        $this->attributes[strtolower($key)] = $value;

        return $this;
    }

    /**
     * Set multiple HTML tag attributes at once.
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function attributes($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->attribute($key, $value);
        }

        return $this;
    }

    /**
     * Add the attribute key/value by attempting to call the appropriate method,
     * which, if one exists, probably has better or more correct behavior than
     * just blindly adding to the attributes list. If a method cannot be found
     * for the attribute name, this will add it to the list anyway.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function attribute($key, $value)
    {
        // PHP methods don't have special characters, so we only want the
        // alphanumeric characters from the key when searching for the method.
        $method = preg_replace('/[^A-Za-z0-9]/', '', $key);

        // If the method absolutely exists, just call it.
        if (method_exists($this, $method)) {
            return $this->{$method}($value);
        }

        // Try to passthrough, as well.
        if (method_exists($this, 'canPassThrough') && $this->canPassThrough($method, [$value])) {
            return $this->passThrough($method, [$value]);
        }

        // If all else fails, just set the attribute directly.
        return $this->_attribute($key, $value);
    }

    /**
     * Append more text onto the end of an already-defined attribute. This will
     * automatically add a single space to the end of the existing attribute
     * value, and then append the new value after that.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function appendAttribute($key, $value)
    {
        $key   = strtolower($key);
        $orig  = Arr::get($this->attributes, $key);
        $value = trim($orig . ' ' . $value);

        return $this->attribute($key, $value);
    }

    /**
     * Prepend more text onto the beginning of an already defined function. This
     * will automatically add a single space to the beginning of the existing
     * attribute value, and then prepend the new value before that.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function prependAttribute($key, $value)
    {
        $key   = strtolower($key);
        $orig  = Arr::get($this->attributes, $key);
        $value = trim($value . ' ' . $orig);

        return $this->attribute($key, $value);
    }

    /**
     * Render a single attribute onto the HTML tag.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    public function renderAttribute($key, $value)
    {
        if (in_array($key, $this->minimizedAttributes)) {
            return $this->renderMinimizedAttribute($key, $value);
        }

        return $key . '="' . e($value) . '" ';
    }

    /**
     * Render a minimized attribute onto the HTML tag.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    public function renderMinimizedAttribute($key, $value)
    {
        if (!in_array($key, $this->minimizedAttributes)) {
            return $this->renderAttribute($key, $value);
        }

        if (!$value) {
            return '';
        }

        return $key . ' ';
    }

    /**
     * Render all the attributes onto the HTML tag.
     *
     * @return string
     */
    public function renderAllAttributes()
    {
        $html = '';

        foreach ($this->attributes as $key => $value) {
            $html .= $this->renderAttribute($key, $value);
        }

        return trim($html);
    }

    /**
     * Does the requested attribute exist?
     *
     * @param string $key
     *
     * @return boolean
     */
    public function hasAttribute($key)
    {
        return isset($this->attributes[$key]);
    }

    /**
     * Get the value of a specific attribute. If the attribute is not defined,
     * this will return null.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getAttribute($key, $default = null)
    {
        if ($this->hasAttribute($key)) {
            return $this->attributes[$key];
        }

        return $default;
    }

    /**
     * Render the tag.
     *
     * @return void
     */
    public function render()
    {
        return $this->renderOpen() .
            $this->renderContent() .
            $this->renderClose();
    }

    /**
     * Open the tag, including all of its attributes. Any necessary default
     * values - such as values, error messages, etc. - will be generated and
     * populated here, if they have not already been specified.
     *
     * @return string
     */
    public function renderOpen()
    {
        $this->setDefaults();

        return $this->renderOpenTag();
    }

    /**
     * Render the tag opener, including all of its attributes.
     *
     * @return string
     */
    public function renderOpenTag()
    {
        return '<' . trim($this->getTagName() . ' ' . $this->renderAllAttributes()) . '>';
    }

    /**
     * Render the internal contents of the element.
     *
     * @return string
     */
    public function renderContent()
    {
        return $this->content;
    }

    /**
     * Close the tag, and possibly do other things.
     *
     * @return string
     */
    public function renderClose()
    {
        return $this->renderCloseTag();
    }

    /**
     * Close the tag.
     *
     * @return string
     */
    public function renderCloseTag()
    {
        return '</' . $this->getTagName() . '>';
    }

    /**
     * Convert booleanish values to 'true' or 'false' strings for use in HTML
     * attribute values.
     *
     * @param mixed $value  Anything that would normally evaluate as truthy,
     *                      plus the (case insensitive) strings 'Y' and 'Yes',
     *                      returns 'true'. Anything that would normally
     *                      evaluate as falsey, plus the strings 'N' and 'No',
     *                      returns 'false'. All other values are returned
     *                      verbatim.
     *
     * @return string
     */
    public function boolean($value)
    {
        // Return the falsey stuff.
        if (in_array(strtolower($value), ['', '0', 'false', 'n', 'no'])) {
            return 'false';
        }

        // Return the truthy stuff.
        if (in_array(strtolower($value), ['1', 'true', 'y', 'yes'])) {
            return 'true';
        }

        // Otherwise return the value as-is.
        return $value;
    }
}
