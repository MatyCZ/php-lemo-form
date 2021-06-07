<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Lemo\Form\BootstrapFormOptions;
use Laminas\ServiceManager\Factory\FactoryInterface;

class BootstrapFormGroupFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormGroup
    {
        return new BootstrapFormGroup(
            $container->get('ViewHelperManager')->get(BootstrapFormInput::class),
            $container->get('ViewHelperManager')->get(BootstrapFormLabel::class),
            $container->get(BootstrapFormOptions::class)
        );
    }
}