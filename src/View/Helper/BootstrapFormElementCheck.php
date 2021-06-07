<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormConstant;
use Lemo\Form\BootstrapFormOptions;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\MultiCheckbox;
use Laminas\Form\ElementInterface;

class BootstrapFormElementCheck extends AbstractElementHelper
{
    /**
     * @var BootstrapFormElement
     */
    protected $bootstrapFormElement;

    /**
     * @var BootstrapFormInvalidFeedback
     */
    protected $bootstrapFormInvalidFeedback;

    /**
     * @var BootstrapFormLabel
     */
    protected $bootstrapFormLabel;

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
     * @param BootstrapFormInvalidFeedback $bootstrapFormInvalidFeedback
     * @param BootstrapFormLabel           $bootstrapFormLabel
     * @param BootstrapFormOptions         $bootstrapFormOptions
     * @param BootstrapFormText            $bootstrapFormText
     */
    public function __construct(
        BootstrapFormElement $bootstrapFormElement,
        BootstrapFormInvalidFeedback $bootstrapFormInvalidFeedback,
        BootstrapFormLabel $bootstrapFormLabel,
        BootstrapFormOptions $bootstrapFormOptions,
        BootstrapFormText $bootstrapFormText
    ) {
        $this->bootstrapFormElement = $bootstrapFormElement;
        $this->bootstrapFormInvalidFeedback = $bootstrapFormInvalidFeedback;
        $this->bootstrapFormLabel = $bootstrapFormLabel;
        $this->bootstrapFormOptions = $bootstrapFormOptions;
        $this->bootstrapFormText = $bootstrapFormText;
    }

    /**
     * @param  ElementInterface $element
     * @return string|self
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
        $pieces = [];
        $pieces[] = $this->openTag();
        $pieces[] = $this->bootstrapFormElement->render($element);
        if (BootstrapFormConstant::LAYOUT_VERTICAL === $this->bootstrapFormOptions->getLayout()) {
            $pieces[] = $this->bootstrapFormLabel->render($element);
        }
        $pieces[] = $this->closeTag();

        return implode(PHP_EOL,$pieces);
    }

    /**
     * @return string
     */
    public function openTag() : string
    {
        return '<div class="form-check">';
    }

    /**
     * Vygeneruje konecny tag
     *
     * @return string
     */
    public function closeTag() : string
    {
        return '</div>';
    }

    /**
     * @param  MultiCheckbox $element
     * @return string
     */
    public function renderHiddenElement(MultiCheckbox $element) : string
    {
        $closingBracket = $this->getInlineClosingBracket();

        $hiddenAttributes = [
            'disabled' => $element->hasAttribute('disabled') ? $element->getAttribute('disabled') : false,
            'name'     => $element->getName(),
            'value'    => $element->getUncheckedValue(),
        ];

        return sprintf(
            '<input type="hidden" %s%s',
            $this->createAttributesString($hiddenAttributes),
            $closingBracket
        );
    }

    /**
     * @param  MultiCheckbox $element
     * @return string
     */
    public function renderElements(MultiCheckbox $element) : string
    {
        $attributes = $element->getAttributes();

        $options         = $element->getValueOptions();
        $optionsSelected = (array) $element->getValue();

        $name = $element->getName();
        $id = $this->convertNameToId($element);

        // Option class if element is not valid
        $optionElementClass = null;
        if (!empty($element->getMessages())) {
            $optionElementClass = 'is-invalid';
        }

        $pieces = [];
        foreach ($options as $key => $optionSpec) {
            $inputAttributes = $attributes;

            $selected = (
                isset($inputAttributes['selected'])
                && $inputAttributes['type'] != 'radio'
                && $inputAttributes['selected']
            );
            $disabled = (
                isset($inputAttributes['disabled'])
                && $inputAttributes['disabled']
            );

            if (is_scalar($optionSpec)) {
                $optionSpec = [
                    'label' => $optionSpec,
                    'value' => $key
                ];
            }
            $value = isset($optionSpec['value']) ? $optionSpec['value'] : null;
            $label = isset($optionSpec['label']) ? $optionSpec['label'] : null;
            if (isset($optionSpec['selected'])) {
                $selected = $optionSpec['selected'];
            }
            if (isset($optionSpec['disabled'])) {
                $disabled = $optionSpec['disabled'];
            }

            if (in_array($value, $optionsSelected)) {
                $selected = true;
            }

            $optionElement = new Checkbox();
            $optionElement->setAttribute('id', $id . ($value ? '-' . $value : ''));
            $optionElement->setAttribute('class', $optionElementClass);
            $optionElement->setAttribute('checked', $selected);
            $optionElement->setAttribute('disabled', $disabled);
            $optionElement->setCheckedValue($value);
            $optionElement->setLabel($label);
            $optionElement->setName($name . '[]');
            $optionElement->setUseHiddenElement(false);

            $pieces[] = implode(PHP_EOL,[
                $this->openTag(),
                $this->bootstrapFormElement->render($optionElement),
                $this->bootstrapFormLabel->render($optionElement, true),
                $this->closeTag()
            ]);
        }

        return implode(PHP_EOL, $pieces);
    }
}
