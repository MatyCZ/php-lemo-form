<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Lemo\Form\BootstrapFormOptions as Options;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormOptionsFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormOptions
    {
        return new BootstrapFormOptions(
            $container->get(Options::class)
        );
    }
}