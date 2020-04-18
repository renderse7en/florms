<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;
use Se7enet\Florms\Traits\InputTypeSubmitImage;

class Image extends Input
{
    /**
     * Include the traits.
     */
    use InputTypeSubmitImage;

    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'image']));
    }

    /**
     * Specifies an alternate text for images (only for type="image")
     *
     * @param string $alt
     *
     * @return $this
     */
    public function alt($alt = '')
    {
        return $this->_attribute('alt', $alt);
    }

    /**
     * Specifies the height of an <input> element (only for type="image")
     *
     * @param integer $height   In pixels.
     *
     * @return $this
     */
    public function height($height = 0)
    {
        return $this->_attribute('height', intval($height));
    }

    /**
     * Specifies the URL of the image to use as a submit button (only for
     * type="image")
     *
     * @param string $src
     *
     * @return $this
     */
    public function src($src = '')
    {
        return $this->_attribute('src', $src);
    }

    /**
     * Specifies the width of an <input> element (only for type="image")
     *
     * @param integer $width    In pixels.
     *
     * @return $this
     */
    public function width($width = 0)
    {
        return $this->_attribute('width', intval($width));
    }
}
