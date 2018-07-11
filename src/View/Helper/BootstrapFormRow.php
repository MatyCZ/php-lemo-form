<?php

namespace Lemo\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\FieldsetInterface;

class BootstrapFormRow extends AbstractHelper
{
    /**
     * @var BootstrapFormGroup
     */
    protected $bootstrapFormGroup;

    /**
     * @var BootstrapFormLabel
     */
    protected $bootstrapFormLabel;

    /**
     * Konstruktor
     *
     * @param BootstrapFormGroup $bootstrapFormGroup
     * @param BootstrapFormLabel $bootstrapFormLabel
     */
    public function __construct(
        BootstrapFormGroup $bootstrapFormGroup,
        BootstrapFormLabel $bootstrapFormLabel
    ) {
        $this->bootstrapFormGroup = $bootstrapFormGroup;
        $this->bootstrapFormLabel = $bootstrapFormLabel;
    }

    /**
     * @param  FieldsetInterface|null $fieldset
     * @param  array|null             $elementNames
     * @return string|self
     */
    public function __invoke(?FieldsetInterface $fieldset = null, ?array $elementNames = null)
    {
        if (null === $fieldset) {
            return $this;
        }

        return $this->render($fieldset, $elementNames);
    }

    /**
     * @param  FieldsetInterface $fieldset
     * @param  array|null        $elementNames
     * @return string
     */
    public function render(FieldsetInterface $fieldset, ?array $elementNames = null) : string
    {
        if (null === $elementNames) {
            $elementNames = array_keys($fieldset->getElements());
        }

        $pieces = [];
        $pieces[] = $this->openTag($fieldset);
        $pieces[] = '<div class="w-100">';
        $pieces[] = $this->bootstrapFormLabel->render($fieldset);
        $pieces[] = '</div>';
        foreach ($elementNames as $elementName) {
            if (!$fieldset->has($elementName)) {
                continue;
            }

            $element = $fieldset->get($elementName);

            $pieces[] = $this->bootstrapFormGroup->render($element);
        }
        $pieces[] = $this->closeTag();

        return implode(PHP_EOL,$pieces);
    }

    /**
     * @param  ElementInterface $element
     * @return string
     */
    public function openTag(ElementInterface $element) : string
    {
        $classHide = $element->getOption('hidden') ? ' d-none' : '';

        return sprintf(
            '<div class="form-row%s" id="form-row-%s">',
            $classHide,
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
