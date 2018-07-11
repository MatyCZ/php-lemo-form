<?php

namespace Lemo\Form\View\Helper;

use DateTime;
use IntlDateFormatter;
use Locale;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Radio;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement;

class BootstrapFormInputElement extends AbstractHelper
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
    public function render(ElementInterface $element)
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

        $element->setAttribute('id', $this->convertNameToId($element));

        // Element
        return $this->formElement->render($element) . PHP_EOL;
    }

    /**
     * @param  ElementInterface $element
     * @return string
     */
    private function addClassesToInput(ElementInterface $element) : string
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
