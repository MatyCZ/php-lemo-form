<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormConstant;
use Zend\Form\ElementInterface;

class BootstrapFormInputGroupAppend extends AbstractHelper
{
    /**
     * @param  ElementInterface $element
     * @return string|self
     */
    public function __invoke(ElementInterface $element = null)
    {
        if (null === $element) {
            return $this;
        }

        return $this->render($element);
    }

    /**
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element) : string
    {
        if (null === $element->getOption(BootstrapFormConstant::OPTION_INPUTGROUP_APPEND)) {
            return '';
        }

        $content = $element->getOption(BootstrapFormConstant::OPTION_INPUTGROUP_APPEND);
        $contentAppend = '';
        $contentPrepend = '';

        // Text content
        if (false === strpos($content, 'btn')) {
            $contentPrepend = '<span class="input-group-text">';
            $contentAppend = '</span>';
        }

        return $this->openTag() . $contentPrepend . $content . $contentAppend . $this->closeTag();
    }

    /**
     * @return string
     */
    public function openTag() : string
    {
        return '<div class="input-group-append">';
    }

    /**
     * @return string
     */
    public function closeTag() : string
    {
        return '</div>';
    }
}
