<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormConstant;
use Zend\Form\ElementInterface;

class BootstrapFormInputGroup extends AbstractHelper
{
    /**
     * @var BootstrapFormElement
     */
    protected $bootstrapFormInputElement;

    /**
     * @var BootstrapFormInputGroupAppend
     */
    protected $bootstrapFormInputGroupAppend;

    /**
     * @var BootstrapFormInputGroupPrepend
     */
    protected $bootstrapFormInputGroupPrepend;

    /**
     * Konstruktor
     *
     * @param BootstrapFormElement           $bootstrapFormInputElement
     * @param BootstrapFormInputGroupAppend  $bootstrapFormInputGroupAppend
     * @param BootstrapFormInputGroupPrepend $bootstrapFormInputGroupPrepend
     */
    public function __construct(
        BootstrapFormElement  $bootstrapFormInputElement,
        BootstrapFormInputGroupAppend $bootstrapFormInputGroupAppend,
        BootstrapFormInputGroupPrepend $bootstrapFormInputGroupPrepend
    ) {
        $this->bootstrapFormInputElement      = $bootstrapFormInputElement;
        $this->bootstrapFormInputGroupAppend  = $bootstrapFormInputGroupAppend;
        $this->bootstrapFormInputGroupPrepend = $bootstrapFormInputGroupPrepend;
    }

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
        $pieces = [];
        $pieces[] = $this->openTag();
        if (null !== $element->getOption(BootstrapFormConstant::OPTION_INPUTGROUP_PREPEND)) {
            $pieces[] = $this->bootstrapFormInputGroupPrepend->render($element);
        }
        $pieces[] = $this->bootstrapFormInputElement->render($element);
        if (null !== $element->getOption(BootstrapFormConstant::OPTION_INPUTGROUP_APPEND)) {
            $pieces[] = $this->bootstrapFormInputGroupAppend->render($element);
        }
        $pieces[] = $this->closeTag();

        return implode(PHP_EOL, $pieces);
    }

    /**
     * @return string
     */
    public function openTag() : string
    {
        return '<div class="input-group">';
    }

    /**
     * @return string
     */
    public function closeTag() : string
    {
        return '</div>';
    }
}
