<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormGroupsFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormGroups
    {
        return new BootstrapFormGroups(
            $container->get('ViewHelperManager')->get(BootstrapFormCollection::class),
            $container->get('ViewHelperManager')->get(BootstrapFormGroup::class),
            $container->get('ViewHelperManager')->get(BootstrapFormRow::class)
        );
    }
}