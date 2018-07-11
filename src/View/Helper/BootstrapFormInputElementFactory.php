<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\Form\View\Helper\FormElement;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormInputElementFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormInputElement
    {
        return new BootstrapFormInputElement(
            $container->get('ViewHelperManager')->get(FormElement::class)
        );
    }
}