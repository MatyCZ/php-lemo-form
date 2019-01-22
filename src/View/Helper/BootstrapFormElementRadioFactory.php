<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Lemo\Form\BootstrapFormOptions;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormElementRadioFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormElementRadio
    {
        return new BootstrapFormElementRadio(
            $container->get('ViewHelperManager')->get(BootstrapFormElement::class),
            $container->get('ViewHelperManager')->get(BootstrapFormInvalidFeedback::class),
            $container->get('ViewHelperManager')->get(BootstrapFormLabel::class),
            $container->get(BootstrapFormOptions::class),
            $container->get('ViewHelperManager')->get(BootstrapFormText::class)
        );
    }
}