<?php

namespace Se7enet\Florms\Traits;

trait HasGlobalAttributes
{
    /**
     * The accesskey attribute specifies a shortcut key to activate/focus an
     * element.
     *
     * @param string $char
     *
     * @return $this
     */
    public function accessKey($char = '')
    {
        return $this->_attribute('accesskey', strtolower($char));
    }

    /**
     * The class attribute specifies one or more classnames for an element.
     *
     * @param string $class
     *
     * @return $this
     */
    function class($class = '')
    {
        return $this->_attribute('class', $class);
    }

    /**
     * Add another classname onto the element.
     *
     * @param string $class
     *
     * @return $this
     */
    public function addClass($class = '')
    {
        return $this->appendAttribute('class', $class);
    }

    /**
     * Does the element already have the requested class?
     *
     * @param string $class
     *
     * @return boolean
     */
    public function hasClass($class)
    {
        // If the class attribute isn't defined at all, it definitely doesn't
        // have the class we're asking about.
        if (!$this->hasAttribute('class')) {
            return false;
        }

        return in_array($class, explode(' ', $this->getAttribute('class')));
    }

    /**
     * The contenteditable attribute specifies whether the content of an element
     * is editable or not.
     *
     * @param mixed $editable   Booleanish value or 'auto', defaults to 'auto'.
     *
     * @return void
     */
    public function contentEditable($editable = 'auto')
    {
        return $this->_attribute('contenteditable', $this->boolean($editable));
    }

    /**
     * The data-* attributes is used to store custom data private to the page or
     * application.
     *
     * @param string $key       The name of the data key to be added. Do not
     *                          include 'data-' here, it will be added
     *                          automatically. For example, to set the
     *                          'data-abcd' attribute, you would call
     *                          $element->data('abcd', 'value');
     * @param string $value     The value of the data key.
     *
     * @return $this
     */
    public function data($key, $value = '')
    {
        return $this->_attribute('data-' . $key, $value);
    }

    /**
     * The dir attribute specifies the text direction of the element's content.
     *
     * @param string $dir   Allowed values are 'rtl', 'ltr', and 'auto'.
     *                      Defaults to 'auto'.
     *
     * @return void
     */
    public function dir($dir = 'auto')
    {
        return $this->_attribute('dir', strtolower($dir));
    }

    /**
     * The draggable attribute specifies whether an element is draggable or not.
     *
     * @param mixed $draggable  Booleanish value or 'auto', defaults to 'auto'.
     *
     * @return $this
     */
    public function draggable($draggable = 'auto')
    {
        return $this->_attribute('draggable', $this->boolean($draggable));
    }

    /**
     * The dropzone attribute specifies whether the dragged data is copied,
     * moved, or linked, when it is dropped on an element.
     *
     * @param string $dropzone  Allowed values are 'copy', 'move', and 'link'.
     *
     * @return $this
     */
    public function dropzone($dropzone)
    {
        return $this->_attribute('dropzone', strtolower($dropzone));
    }

    /**
     * The hidden attribute is a boolean attribute. When present, it specifies
     * that an element is not yet, or is no longer, relevant.
     *
     * @param boolean $hidden   Defaults to true when calling this method with
     *                          no arguments.
     *
     * @return $this
     */
    public function hidden($hidden = true)
    {
        return $this->_attribute('hidden', !!$hidden);
    }

    /**
     * The id attribute specifies a unique id for an HTML element (the value
     * must be unique within the HTML document).
     *
     * Rules:
     * - Must contain at least one character.
     * - Must not contain any space characters.
     *
     * @param string $id
     *
     * @return $this
     */
    public function id($id = '')
    {
        return $this->_attribute('id', $id);
    }

    /**
     * The lang attribute specifies the language of the element's content.
     *
     * @link https://www.w3schools.com/tags/ref_language_codes.asp
     *
     * @param string $lang  The language code for the element's content.
     *
     * @return void
     */
    public function lang($lang = '')
    {
        return $this->_attribute('lang', strtolower($lang));
    }

    /**
     * The spellcheck attribute specifies whether the element is to have its
     * spelling and grammar checked or not.
     *
     * @param mixed $spellcheck Booleanish value, defaults to 'true' when this
     *                          method is called with no arguments.
     *
     * @return $this
     */
    public function spellcheck($spellcheck = 'true')
    {
        return $this->_attribute('spellcheck', $this->boolean($spellcheck));
    }

    /**
     * The style attribute specifies an inline style for an element.
     *
     * @param string $style
     *
     * @return $this
     */
    public function style($style = '')
    {
        return $this->_attribute('style', $style);
    }

    /**
     * Add more style definitions on the element.
     *
     * @param string $style
     *
     * @return $this
     */
    public function addStyle($style = '')
    {
        return $this->appendAttribute('style', $style);
    }

    /**
     * The tabindex attribute specifies the tab order of an element (when the
     * "tab" button is used for navigating).
     *
     * @param integer $tabIndex
     *
     * @return $this
     */
    public function tabIndex($tabIndex = 0)
    {
        return $this->_attribute('tabindex', $tabIndex);
    }

    /**
     * The title attribute specifies extra information about an element.
     *
     * @param string $title
     *
     * @return $this
     */
    public function title($title = '')
    {
        return $this->_attribute('title', $title);
    }

    /**
     * The translate attribute specifies whether the content of an element
     * should be translated or not.
     *
     * @param string $translate Allowed values are 'yes' and 'no'. Defaults to
     *                          'yes' when this method is called with no
     *                          arguments.
     *
     * @return $this
     */
    public function translate($translate = 'yes')
    {
        return $this->_attribute('translate', strtolower($translate));
    }
}
