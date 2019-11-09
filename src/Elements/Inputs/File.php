<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;

class File extends Input
{
    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'file']));
    }

    /**
     * Get the type of control, for purposes of inheriting skin settings.
     *
     * @return string
     */
    public function getControlType()
    {
        return 'file';
    }

    /**
     * Specifies a filter for what file types the user can pick from the file
     * input dialog box (only for type="file")
     *
     * @param string $accept
     *
     * @return $this
     */
    public function accept($accept = '')
    {
        return $this->_attribute('accept', $accept);
    }
}
