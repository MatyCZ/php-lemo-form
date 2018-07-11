<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Lemo\Form\BootstrapFormOptions;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormCheckFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormCheck
    {
        return new BootstrapFormCheck(
            $container->get('ViewHelperManager')->get(BootstrapFormInputElement::class),
            $container->get('ViewHelperManager')->get(BootstrapFormInvalidFeedback::class),
            $container->get('ViewHelperManager')->get(BootstrapFormLabel::class),
            $container->get(BootstrapFormOptions::class),
            $container->get('ViewHelperManager')->get(BootstrapFormText::class)
        );
    }
}