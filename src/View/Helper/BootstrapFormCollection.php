<?php

namespace Lemo\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Element\Collection;
use Zend\Form\FieldsetInterface;

class BootstrapFormCollection extends AbstractHelper
{
    /**
     * @var BootstrapFormGroup
     */
    protected $bootstrapFormGroup;

    /**
     * @var BootstrapFormRow
     */
    protected $bootstrapFormRow;

    /**
     * Konstruktor
     *
     * @param BootstrapFormGroup $bootstrapFormGroup
     * @param BootstrapFormRow   $bootstrapFormRow
     */
    public function __construct(
        BootstrapFormGroup $bootstrapFormGroup,
        BootstrapFormRow $bootstrapFormRow
    ) {
        $this->bootstrapFormGroup = $bootstrapFormGroup;
        $this->bootstrapFormRow   = $bootstrapFormRow;
    }

    /**
     * @param  Collection|null $collection
     * @param  bool            $inline
     * @return string|self
     */
    public function __invoke(Collection $collection = null, bool $inline = false)
    {
        if (!$collection) {
            return $this;
        }

        return $this->render($collection, $inline);
    }

    /**
     * Render a collection by iterating through all fieldsets and elements
     *
     * @param  Collection $collection
     * @param  bool       $inline
     * @return string
     */
    public function render(Collection $collection, bool $inline = false) : string
    {
        // Render elements
        $markup = '';
        foreach ($collection->getIterator() as $name => $elementOrFieldset) {
            if ($elementOrFieldset instanceof FieldsetInterface) {
                if (true === $inline) {
                    $markup .= $this->bootstrapFormRow->render($elementOrFieldset);
                } else {
                    foreach ($elementOrFieldset as $elementName => $element) {
                        $markup .= $this->bootstrapFormGroup->render($element);
                    }
                }
            } elseif ($elementOrFieldset instanceof ElementInterface) {
                $markup .= $this->bootstrapFormGroup->render($elementOrFieldset);
            }
        }

        // Render template
        if ($collection->shouldCreateTemplate()) {
            $markup .= $this->renderTemplate($collection);
        }

        return $markup;
    }

    /**
     * Only render a template
     *
     * @param  Collection $collection
     * @param  bool       $inline
     * @param  bool       $returnOnlyTemplateContent
     * @return string
     */
    public function renderTemplate(Collection $collection, $inline = false, bool $returnOnlyTemplateContent = false) : string
    {
        $templateElement = $collection->getTemplateElement();

        $markup = '';
        if ($templateElement instanceof FieldsetInterface) {
            if (true === $inline) {
                $markup .= $this->bootstrapFormRow->render($templateElement);
            } else {
                foreach ($templateElement as $elementName => $element) {
                    $markup .= $this->bootstrapFormGroup->render($element);
                }
            }
        } elseif ($templateElement instanceof ElementInterface) {
            $markup .= $this->bootstrapFormGroup->render($templateElement);
        }

        if (true === $returnOnlyTemplateContent) {
            return $markup;
        }

        $id = $this->convertNameToId($collection);

        $attributes = [
            'id'            => 'form-template-' . $id,
            'data-template' => $markup,
        ];

        $attributes = $this->prepareAttributes($attributes);

        return sprintf(
            '<span %s></span>',
            $this->createAttributesString($attributes)
        );
    }
}
