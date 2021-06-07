<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Laminas\Form\View\Helper\FormElement;
use Laminas\ServiceManager\Factory\FactoryInterface;

class BootstrapFormElementFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormElement
    {
        return new BootstrapFormElement(
            $container->get('ViewHelperManager')->get(FormElement::class)
        );
    }
}