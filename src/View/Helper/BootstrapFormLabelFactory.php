<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Lemo\Form\BootstrapFormOptions;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormLabelFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormLabel
    {
        return new BootstrapFormLabel(
            $container->get(BootstrapFormOptions::class)
        );
    }
}