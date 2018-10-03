<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormConstant;
use Lemo\Form\BootstrapFormOptions;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Radio;
use Zend\Form\ElementInterface;

class BootstrapFormLabel extends AbstractHelper
{
    /**
     * @var BootstrapFormOptions
     */
    protected $bootstrapFormOptions;

    /**
     * @var array
     */
    protected $validTagAttributes = [
        'for'  => true,
        'form' => true,
    ];

    /**
     * Konstruktor
     *
     * @param BootstrapFormOptions $bootstrapFormOptions
     */
    public function __construct(
        BootstrapFormOptions $bootstrapFormOptions
    ) {
        $this->bootstrapFormOptions = $bootstrapFormOptions;
    }

    /**
     * @param  ElementInterface|null $element
     * @return string|self
     */
    public function __invoke(?ElementInterface $element = null)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element);
    }

    /**
     * @param  ElementInterface $element
     * @param  bool             $isValueLabel
     * @return string
     */
    public function render(ElementInterface $element, bool $isValueLabel = false) : string
    {
        $label = $element->getLabel();
        $labelRender = $element->getOption(BootstrapFormConstant::OPTION_LABEL_RENDER);
        $labelRequired = $element->getOption(BootstrapFormConstant::OPTION_REQUIRED);

        if (empty($label) || false === $labelRender) {
            return '';
        }

        if (null !== ($translator = $this->getTranslator())) {
            $label = $translator->translate(
                $label, $this->getTranslatorTextDomain()
            );
        }

        // Element je povinny, pridame hvezdicku
        if (true === $labelRequired) {
            $label .= ' <em class="required">*</em>';
        }

        return $this->openTag($element, $isValueLabel) . $label . $this->closeTag();
    }

    /**
     * @param  ElementInterface $element
     * @param  bool             $isValueLabel
     * @return string
     */
    public function openTag(ElementInterface $element, bool $isValueLabel = false) : string
    {
        $id = $this->convertNameToId($element);

        /** @var Radio|Checkbox $element */
        $labelAttributes = $element->getLabelAttributes();
        $attributes = ['for' => $id];

        if (!empty($labelAttributes)) {
            $attributes = array_merge($labelAttributes, $attributes);
        }

        if (
            BootstrapFormConstant::LAYOUT_HORIZONTAL === $this->bootstrapFormOptions->getLayout()
            && false === $isValueLabel
        ) {
            if ($element instanceof Checkbox) {
                $class = $this->bootstrapFormOptions->getSizeClassLabel();
            } else {
                $class = $this->bootstrapFormOptions->getSizeClassLabel() . ' col-form-label';
            }

            if (BootstrapFormConstant::LABEL_ALIGN_LEFT !== $this->bootstrapFormOptions->getLabelAlign()) {
                $class .= ' text-' . $this->bootstrapFormOptions->getLabelAlign();
            }

        } elseif ($element instanceof Checkbox || $element instanceof Radio) {
            $class = 'form-check-label';
        } else {
            $class = null;
        }

        // Pridame tridu pro element Checkbox a Radio
        if (null !== $class) {
            if (array_key_exists('class', $attributes)) {
                if (array_key_exists('class', $attributes)) {
                    if (false === strpos($attributes['class'], $class)) {
                        $attributes['class'] = trim($attributes['class'] . ' ' . $class);
                    }
                } else {
                    $attributes['class'] = $class;
                }
            } else {
                $attributes['class'] = $class;
            }
        }

        return sprintf(
            '<label %s>',
            $this->createAttributesString($attributes)
        );
    }

    /**
     * @return string
     */
    public function closeTag() : string
    {
        return '</label>';
    }
}
