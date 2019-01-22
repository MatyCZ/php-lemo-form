<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormInputGroupFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormInputGroup
    {
        return new BootstrapFormInputGroup(
            $container->get('ViewHelperManager')->get(BootstrapFormElement::class),
            $container->get('ViewHelperManager')->get(BootstrapFormInputGroupAppend::class),
            $container->get('ViewHelperManager')->get(BootstrapFormInputGroupPrepend::class)
        );
    }
}