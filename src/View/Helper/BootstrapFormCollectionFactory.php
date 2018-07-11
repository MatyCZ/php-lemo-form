<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormCollectionFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormCollection
    {
        return new BootstrapFormCollection(
            $container->get('ViewHelperManager')->get(BootstrapFormGroup::class),
            $container->get('ViewHelperManager')->get(BootstrapFormRow::class)
        );
    }
}