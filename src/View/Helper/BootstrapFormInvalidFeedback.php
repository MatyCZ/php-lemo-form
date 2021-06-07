<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormOptions;
use Laminas\Form\ElementInterface;
use Laminas\Form\View\Helper\FormElementErrors;

class BootstrapFormInvalidFeedback extends AbstractHelper
{
    /**
     * @var BootstrapFormOptions
     */
    protected $bootstrapFormOptions;

    /**
     * @var FormElementErrors
     */
    protected $formElementErrors;

    /**
     * Konstruktor
     *
     * @param BootstrapFormOptions $bootstrapFormOptions
     * @param FormElementErrors    $formElementErrors
     */
    public function __construct(
        BootstrapFormOptions $bootstrapFormOptions,
        FormElementErrors $formElementErrors
    ) {
        $this->bootstrapFormOptions = $bootstrapFormOptions;
        $this->formElementErrors    = $formElementErrors;
    }

    /**
     * @param  ElementInterface $element
     * @return string|self
     */
    public function __invoke(ElementInterface $element = null)
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
        if (
            !$this->bootstrapFormOptions->getRenderErrors()
            || empty($element->getMessages())
        ) {
            return '';
        }

        $this->formElementErrors->setMessageOpenFormat('<ul class="list-unstyled">%s');

        return implode(PHP_EOL, [
            '<div class="invalid-feedback">',
            '   ' . $this->formElementErrors->render($element),
            '</div>'
        ]);
    }
}
