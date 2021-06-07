<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Lemo\Form\BootstrapFormOptions;
use Laminas\ServiceManager\Factory\FactoryInterface;

class BootstrapFormElementCheckFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormElementCheck
    {
        return new BootstrapFormElementCheck(
            $container->get('ViewHelperManager')->get(BootstrapFormElement::class),
            $container->get('ViewHelperManager')->get(BootstrapFormInvalidFeedback::class),
            $container->get('ViewHelperManager')->get(BootstrapFormLabel::class),
            $container->get(BootstrapFormOptions::class),
            $container->get('ViewHelperManager')->get(BootstrapFormText::class)
        );
    }
}