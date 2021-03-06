<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class BootstrapFormFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapForm
    {
        return new BootstrapForm(
            $container->get('ViewHelperManager')->get(BootstrapFormCollection::class),
            $container->get('ViewHelperManager')->get(BootstrapFormGroup::class)
        );
    }
}