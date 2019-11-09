<?php

namespace Se7enet\Florms\Traits;

trait HasDragEvents
{
    /**
     * Script to be run when an element is dragged
     *
     * @param string $script
     *
     * @return $this
     */
    public function onDrag($script)
    {
        return $this->_attribute('ondrag', $script);
    }

    /**
     * Script to be run at the end of a drag operation
     *
     * @param string $script
     *
     * @return $this
     */
    public function onDragEnd($script)
    {
        return $this->_attribute('ondragend', $script);
    }

    /**
     * Script to be run when an element has been dragged to a valid drop target
     *
     * @param string $script
     *
     * @return $this
     */
    public function onDragEnter($script)
    {
        return $this->_attribute('ondragenter', $script);
    }

    /**
     * Script to be run when an element leaves a valid drop target
     *
     * @param string $script
     *
     * @return $this
     */
    public function onDragLeave($script)
    {
        return $this->_attribute('ondragleave', $script);
    }

    /**
     * Script to be run when an element is being dragged over a valid drop
     * target
     *
     * @param string $script
     *
     * @return $this
     */
    public function onDragOver($script)
    {
        return $this->_attribute('ondragover', $script);
    }

    /**
     * Script to be run at the start of a drag operation
     *
     * @param string $script
     *
     * @return $this
     */
    public function onDragStart($script)
    {
        return $this->_attribute('ondragstart', $script);
    }

    /**
     * Script to be run when dragged element is being dropped
     *
     * @param string $script
     *
     * @return $this
     */
    public function onDrop($script)
    {
        return $this->_attribute('ondrop', $script);
    }

    /**
     * Script to be run when an element's scrollbar is being scrolled
     *
     * @param string $script
     *
     * @return $this
     */
    public function onScroll($script)
    {
        return $this->_attribute('onscroll', $script);
    }
}
