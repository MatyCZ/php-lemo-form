<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormConstant;
use Lemo\Form\BootstrapFormOptions;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\MultiCheckbox;
use Laminas\Form\Element\Radio;
use Laminas\Form\ElementInterface;

class BootstrapFormInput extends AbstractHelper
{
    /**
     * @var BootstrapFormElement
     */
    protected $bootstrapFormElement;

    /**
     * @var BootstrapFormElementCheck
     */
    protected $bootstrapFormElementCheck;

    /**
     * @var BootstrapFormElementRadio
     */
    protected $bootstrapFormElementRadio;

    /**
     * @var BootstrapFormInputGroup
     */
    protected $bootstrapFormInputGroup;

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
     * @param BootstrapFormElement         $bootstrapFormElement
     * @param BootstrapFormElementCheck    $bootstrapFormElementCheck
     * @param BootstrapFormElementRadio    $bootstrapFormElementRadio
     * @param BootstrapFormInputGroup      $bootstrapFormInputGroup
     * @param BootstrapFormInvalidFeedback $bootstrapFormInvalidFeedback
     * @param BootstrapFormOptions         $bootstrapFormOptions
     * @param BootstrapFormText            $bootstrapFormText
     */
    public function __construct(
        BootstrapFormElement $bootstrapFormElement,
        BootstrapFormElementCheck $bootstrapFormElementCheck,
        BootstrapFormElementRadio $bootstrapFormElementRadio,
        BootstrapFormInputGroup $bootstrapFormInputGroup,
        BootstrapFormInvalidFeedback $bootstrapFormInvalidFeedback,
        BootstrapFormOptions $bootstrapFormOptions,
        BootstrapFormText $bootstrapFormText
    ) {
        $this->bootstrapFormElement         = $bootstrapFormElement;
        $this->bootstrapFormElementCheck    = $bootstrapFormElementCheck;
        $this->bootstrapFormElementRadio    = $bootstrapFormElementRadio;
        $this->bootstrapFormInputGroup      = $bootstrapFormInputGroup;
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
                $this->bootstrapFormElementCheck->render($element),
                $this->bootstrapFormText->render($element),
                $this->bootstrapFormInvalidFeedback->render($element),
                $this->closeTag()
            ]);
        }

        // Element Radio
        if ($element instanceof Radio) {
            return implode(PHP_EOL,[
                $this->openTag(),
                $this->bootstrapFormElementRadio->renderHiddenElement($element),
                $this->bootstrapFormElementRadio->renderElements($element),
                $this->bootstrapFormText->render($element),
                $this->bootstrapFormInvalidFeedback->render($element),
                $this->closeTag()
            ]);
        }

        // Element MultiCheckbox
        if ($element instanceof MultiCheckbox) {
            return implode(PHP_EOL,[
                $this->openTag(),
                $this->bootstrapFormElementCheck->renderHiddenElement($element),
                $this->bootstrapFormElementCheck->renderElements($element),
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
            $this->bootstrapFormElement->render($element),
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
