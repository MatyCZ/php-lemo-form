<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Lemo\Form\BootstrapFormOptions;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormInputFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormInput
    {
        return new BootstrapFormInput(
            $container->get('ViewHelperManager')->get(BootstrapFormCheck::class),
            $container->get('ViewHelperManager')->get(BootstrapFormInputGroup::class),
            $container->get('ViewHelperManager')->get(BootstrapFormInputElement::class),
            $container->get('ViewHelperManager')->get(BootstrapFormInvalidFeedback::class),
            $container->get(BootstrapFormOptions::class),
            $container->get('ViewHelperManager')->get(BootstrapFormText::class)
        );
    }
}