<?php

namespace Lemo\Form\View\Helper;

use Interop\Container\ContainerInterface;
use Lemo\Form\BootstrapFormOptions;
use Zend\Form\View\Helper\FormElementErrors;
use Zend\ServiceManager\Factory\FactoryInterface;

class BootstrapFormInvalidFeedbackFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : BootstrapFormInvalidFeedback
    {
        return new BootstrapFormInvalidFeedback(
            $container->get(BootstrapFormOptions::class),
            $container->get('ViewHelperManager')->get(FormElementErrors::class)
        );
    }
}