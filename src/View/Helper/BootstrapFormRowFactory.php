<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormRowFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormRow
    {
        return new BootstrapFormRow(
            $container->get('ViewHelperManager')->get(BootstrapFormGroup::class),
            $container->get('ViewHelperManager')->get(BootstrapFormLabel::class)
        );
    }
}