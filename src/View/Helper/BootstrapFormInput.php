<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormConstant;
use Lemo\Form\BootstrapFormOptions;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\MultiCheckbox;
use Zend\Form\Element\Radio;
use Zend\Form\ElementInterface;

class BootstrapFormInput extends AbstractHelper
{
    /**
     * @var BootstrapFormCheck
     */
    protected $bootstrapFormCheck;

    /**
     * @var BootstrapFormInputGroup
     */
    protected $bootstrapFormInputGroup;

    /**
     * @var BootstrapFormInputElement
     */
    protected $bootstrapFormInputElement;

    /**
     * @var BootstrapFormInvalidFeedback
     */
    protected $bootstrapFormInvalidFeedback;

    /**
     * @var BootstrapFormOptions
     */
    protected $bootstrapFormOptions;

    /**
     * @var BootstrapFormText
     */
    protected $bootstrapFormText;

    /**
     * Konstruktor
     *
     * @param BootstrapFormCheck           $bootstrapFormCheck
     * @param BootstrapFormInputGroup      $bootstrapFormInputGroup
     * @param BootstrapFormInputElement    $bootstrapFormElement
     * @param BootstrapFormInvalidFeedback $bootstrapFormInvalidFeedback
     * @param BootstrapFormOptions         $bootstrapFormOptions
     * @param BootstrapFormText            $bootstrapFormText
     */
    public function __construct(
        BootstrapFormCheck $bootstrapFormCheck,
        BootstrapFormInputGroup $bootstrapFormInputGroup,
        BootstrapFormInputElement $bootstrapFormElement,
        BootstrapFormInvalidFeedback $bootstrapFormInvalidFeedback,
        BootstrapFormOptions $bootstrapFormOptions,
        BootstrapFormText $bootstrapFormText
    ) {
        $this->bootstrapFormCheck           = $bootstrapFormCheck;
        $this->bootstrapFormInputGroup      = $bootstrapFormInputGroup;
        $this->bootstrapFormInputElement    = $bootstrapFormElement;
        $this->bootstrapFormInvalidFeedback = $bootstrapFormInvalidFeedback;
        $this->bootstrapFormOptions         = $bootstrapFormOptions;
        $this->bootstrapFormText            = $bootstrapFormText;
    }

    /**
     * @param  ElementInterface $element
     * @return string
     */
    public function __invoke(?ElementInterface $element = null)
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
        // Element Checkbox
        if ($element instanceof Checkbox && !$element instanceof MultiCheckbox) {
            return implode(PHP_EOL,[
                $this->openTag(),
                $this->bootstrapFormCheck->render($element),
                $this->bootstrapFormText->render($element),
                $this->bootstrapFormInvalidFeedback->render($element),
                $this->closeTag()
            ]);
        }

        // Element MultiCheckbox a Radio
        if ($element instanceof MultiCheckbox || $element instanceof Radio) {
            return implode(PHP_EOL,[
                $this->openTag(),
                $this->bootstrapFormCheck->renderHiddenElement($element),
                $this->bootstrapFormCheck->renderValueOptions($element),
                $this->bootstrapFormText->render($element),
                $this->bootstrapFormInvalidFeedback->render($element),
                $this->closeTag()
            ]);
        }

        // Input group
        if (
            null !== $element->getOption(BootstrapFormConstant::OPTION_INPUTGROUP_PREPEND)
            || null !== $element->getOption(BootstrapFormConstant::OPTION_INPUTGROUP_APPEND)
        ) {
            return implode(PHP_EOL,[
                $this->openTag(),
                $this->bootstrapFormInputGroup->render($element),
                $this->bootstrapFormText->render($element),
                $this->bootstrapFormInvalidFeedback->render($element),
                $this->closeTag()
            ]);
        }

        return implode(PHP_EOL,[
            $this->openTag(),
            $this->bootstrapFormInputElement->render($element),
            $this->bootstrapFormText->render($element),
            $this->bootstrapFormInvalidFeedback->render($element),
            $this->closeTag()
        ]);
    }

    /**
     * @return string
     */
    public function openTag() : string
    {
        if (BootstrapFormConstant::LAYOUT_HORIZONTAL === $this->bootstrapFormOptions->getLayout()) {
            return sprintf(
                '<div class="%s">',
                $this->bootstrapFormOptions->getSizeClassElement()
            );
        }

        return '';
    }

    /**
     * @return string
     */
    public function closeTag() : string
    {
        if (BootstrapFormConstant::LAYOUT_HORIZONTAL === $this->bootstrapFormOptions->getLayout()) {
            return '</div>';
        }

        return '';
    }
}
