<?php

namespace Lemo\Form\View\Helper;

use DateTime;
use IntlDateFormatter;
use Locale;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement;

class BootstrapFormElement extends AbstractElementHelper
{
    /**
     * @var FormElement
     */
    protected $formElement;

    /**
     * Konstruktor
     *
     * @param FormElement $formElement
     */
    public function __construct(FormElement $formElement)
    {
        $this->formElement = $formElement;
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
     * Render
     *
     * @param ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element): string
    {
        $element->setAttribute('id', $this->convertNameToId($element));
        $element->setAttribute('class' , $this->addClassesToInput($element));

        // Renderovani datumu dle locale
        if ($element->getValue() instanceof DateTime) {
            $formatter = new IntlDateFormatter(
                Locale::getDefault(),
                IntlDateFormatter::MEDIUM,
                IntlDateFormatter::NONE,
                $element->getValue()->getTimezone()->getName(),
                IntlDateFormatter::GREGORIAN
            );

            $element->setValue(str_replace(' ', '', $formatter->format($element->getValue())));
        }

        // Element
        if ($element instanceof Radio) {
            $html = $this->renderRadio($element);
        } else {

            if (
                ($element instanceof Text || $element instanceof Textarea)
                && $element->getValue()
            ) {
                $element->setValue(
                    html_entity_decode(
                        $element->getValue(),
                        ENT_COMPAT,
                        'UTF-8'
                    )
                );
            }

            $html = $this->formElement->render($element);
        }

        return $html . PHP_EOL;
    }

    /**
     * @param  Radio $element
     * @return string
     */
    public function renderRadio(Radio $element): string
    {
        $attributes = $element->getAttributes();
        $attributes['value'] = $element->getValue();

        return sprintf(
            '<input %s%s',
            $this->createAttributesString($attributes),
            $this->getInlineClosingBracket()
        );
    }

    /**
     * @param  ElementInterface $element
     * @return string
     */
    private function addClassesToInput(ElementInterface $element): string
    {
        $class = $element->getAttribute('class');

        if ($element instanceof Checkbox || $element instanceof Radio) {
            $classInput = 'form-check-input';
        } else {
            $classInput = 'form-control';
        }

        // Pridame .form-control
        if (empty($class) || false === strpos($class, $classInput)) {
            $class = trim($class . ' ' . $classInput);
        }

        // Pridame .is-invalid
        if (!empty($element->getMessages())) {
            $class = trim($class . ' is-invalid');
        }

        return $class;
    }
}
