<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormConstant;
use Lemo\Form\BootstrapFormOptions;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\MultiCheckbox;
use Laminas\Form\Element\Radio;
use Laminas\Form\ElementInterface;

class BootstrapFormGroup extends AbstractHelper
{
    /**
     * @var BootstrapFormOptions
     */
    protected $bootstrapFormOptions;

    /**
     * @var BootstrapFormInput
     */
    protected $bootstrapFormInput;

    /**
     * @var BootstrapFormLabel
     */
    protected $bootstrapFormLabel;

    /**
     * Konstruktor
     *
     * @param BootstrapFormInput           $bootstrapFormInput
     * @param BootstrapFormLabel           $bootstrapFormLabel
     * @param BootstrapFormOptions         $bootstrapFormOptions
     */
    public function __construct(
        BootstrapFormInput $bootstrapFormInput,
        BootstrapFormLabel $bootstrapFormLabel,
        BootstrapFormOptions $bootstrapFormOptions
    ) {
        $this->bootstrapFormInput           = $bootstrapFormInput;
        $this->bootstrapFormLabel           = $bootstrapFormLabel;
        $this->bootstrapFormOptions         = $bootstrapFormOptions;
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
            $pieces = [];
            $pieces[] = $this->openTag($element);
            if (BootstrapFormConstant::LAYOUT_HORIZONTAL === $this->bootstrapFormOptions->getLayout()) {
                $pieces[] = $this->bootstrapFormLabel->render($element);
            }
            $pieces[] = $this->bootstrapFormInput->render($element);
            $pieces[] = $this->closeTag();

            return implode(PHP_EOL,$pieces);
        }

        // Element MultiCheckbox a Radio
        if ($element instanceof MultiCheckbox || $element instanceof Radio) {
            return implode(PHP_EOL,[
                $this->openTag($element),
                $this->bootstrapFormLabel->render($element),
                $this->bootstrapFormInput->render($element),
                $this->closeTag()
            ]);
        }

        return implode(PHP_EOL,[
            $this->openTag($element),
            $this->bootstrapFormLabel->render($element),
            $this->bootstrapFormInput->render($element),
            $this->closeTag()
        ]);
    }

    /**
     * @param  ElementInterface $element
     * @return string
     */
    public function openTag(ElementInterface $element) : string
    {
        $classHide = '';
        if ($element instanceof Hidden || $element->getOption('hidden')) {
            $classHide = ' d-none';
        }

        // Class for horizontal layout
        $classFormLayout = '';
        if (BootstrapFormConstant::LAYOUT_HORIZONTAL === $this->bootstrapFormOptions->getLayout()) {
            $classFormLayout = ' row';
        }

        // Class extra
        $classKey = BootstrapFormConstant::OPTION_GROUP_CLASS;
        $classBootstrap = $element->getOption($classKey) ? ' ' . $element->getOption($classKey) : '';

        return sprintf(
            '<div class="form-group%s%s%s" id="form-group-%s">',
            $classHide,
            $classBootstrap,
            $classFormLayout,
            $this->convertNameToId($element)
        );
    }

    /**
     * @return string
     */
    public function closeTag() : string
    {
        return '</div>';
    }
}
