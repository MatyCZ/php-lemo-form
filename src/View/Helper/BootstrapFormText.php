<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormConstant;
use Laminas\Form\ElementInterface;

class BootstrapFormText extends AbstractHelper
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
        if (null === $element->getOption(BootstrapFormConstant::OPTION_TEXT)) {
            return '';
        }

        $text = $element->getOption(BootstrapFormConstant::OPTION_TEXT);

        if (null !== ($translator = $this->getTranslator())) {
            $text = $translator->translate(
                $text, $this->getTranslatorTextDomain()
            );
        }

        return $this->openTag() . $text . $this->closeTag();
    }

    /**
     * @return string
     */
    public function openTag() : string
    {
        return '<small class="form-text text-muted">';
    }

    /**
     * @return string
     */
    public function closeTag() : string
    {
        return '</small>';
    }
}
