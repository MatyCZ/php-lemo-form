<?php

namespace Lemo\Form;

use Zend\Form\ElementInterface;
use Zend\Form\FieldsetInterface;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterProviderInterface;

class BootstrapForm extends Form
{
    /**
     * @inheritdoc
     */
    public function prepare() : self
    {
        // Set Form attributes
        $this->setAttribute('novalidate', true);

        parent::prepare();

        // Execute specific Form functions
        $this->appendAttributeRequired($this, $this->getInputFilter());

        return $this;
    }

    /**
     * @param  FieldsetInterface    $formOrFieldset
     * @param  InputFilterInterface $inputFilter
     * @return self
     */
    protected function appendAttributeRequired(
        FieldsetInterface $formOrFieldset,
        InputFilterInterface $inputFilter = null
    ) : self {
        /**
         * @var FieldsetInterface $fieldset
         */
        foreach ($formOrFieldset->getFieldsets() as $fieldsetName => $fieldset) {

            // Exists InputFilter for fieldset?
            $fieldsetInputFilter = null;
            if (
                $inputFilter instanceof InputFilterInterface
                && $inputFilter->has($fieldsetName)
                && $inputFilter->get($fieldsetName) instanceof InputFilterInterface
            ) {
                $fieldsetInputFilter = $inputFilter->get($fieldsetName);
            }

            $this->appendAttributeRequired($fieldset, $fieldsetInputFilter);
        }

        /**
         * @var ElementInterface $element
         */
        foreach ($formOrFieldset->getElements() as $elementName => $element) {
            if ($inputFilter instanceof InputFilterInterface) {
                if ($inputFilter->has($elementName) && $inputFilter->get($elementName)->isRequired()) {
                    $element->setOption(BootstrapFormConstant::OPTION_REQUIRED, true);
                }
            } elseif ($formOrFieldset instanceOf InputFilterProviderInterface) {
                $spec = $formOrFieldset->getInputFilterSpecification();

                if (!empty($spec[$elementName]['required'])) {
                    $element->setOption(BootstrapFormConstant::OPTION_REQUIRED, true);
                }
            }
        }

        return $this;
    }
}