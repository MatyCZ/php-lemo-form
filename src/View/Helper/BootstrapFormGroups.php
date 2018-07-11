<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFieldsetRow;
use Zend\Form\Element\Collection;
use Zend\Form\ElementInterface;
use Zend\Form\FieldsetInterface;

class BootstrapFormGroups extends AbstractHelper
{
    /**
     * @var BootstrapFormCollection
     */
    protected $bootstrapFormCollection;

    /**
     * @var BootstrapFormGroup
     */
    protected $bootstrapFormGroup;

    /**
     * @var $bootstrapFormRow
     */
    protected $bootstrapFormRow;

    /**
     * Konstruktor
     *
     * @param BootstrapFormCollection $bootstrapFormCollection
     * @param BootstrapFormGroup      $bootstrapFormGroup
     * @param BootstrapFormRow        $bootstrapFormRow
     */
    public function __construct(
        BootstrapFormCollection $bootstrapFormCollection,
        BootstrapFormGroup $bootstrapFormGroup,
        BootstrapFormRow $bootstrapFormRow
    ) {
        $this->bootstrapFormCollection = $bootstrapFormCollection;
        $this->bootstrapFormGroup      = $bootstrapFormGroup;
        $this->bootstrapFormRow        = $bootstrapFormRow;
    }

    /**
     * @param  FieldsetInterface|null $formOrFieldset
     * @param  array|null             $elementNames
     * @return string|self
     */
    public function __invoke(?FieldsetInterface $formOrFieldset = null, ?array $elementNames = null)
    {
        if (null === $formOrFieldset) {
            return $this;
        }

        return $this->render($formOrFieldset, $elementNames);
    }

    /**
     * @param  FieldsetInterface $formOrFieldset
     * @param  array|null        $elementNames
     * @return string
     */
    public function render(FieldsetInterface $formOrFieldset, ?array $elementNames = null) : string
    {
        $content = '';

        foreach ($formOrFieldset->getIterator() as $name => $elementOrFieldset) {
            if (
                null !== $elementNames
                && !in_array($name, $elementNames)
            ) {
                continue;
            }

            if ($elementOrFieldset instanceof Collection) {
                $content .= $this->bootstrapFormCollection->render($elementOrFieldset);
            } elseif ($elementOrFieldset instanceof BootstrapFieldsetRow) {
                $content .= $this->bootstrapFormRow->render($elementOrFieldset);
            } else {
                $content .= $this->bootstrapFormGroup->render($elementOrFieldset);
            }
        }

        return $content;
    }
}
