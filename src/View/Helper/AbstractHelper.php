<?php

namespace Lemo\Form\View\Helper;

use Laminas\Form\ElementInterface;
use Laminas\Form\View\Helper\AbstractHelper as LaminasAbstractHelper;

abstract class AbstractHelper extends LaminasAbstractHelper
{
    /**
     * @param  ElementInterface $element
     * @return string
     */
    protected function convertNameToId(ElementInterface $element) : string
    {
        $id = $element->getAttribute('id');

        if (empty($id)) {
            $id = $this->getId($element);
        }

        return trim(strtr($id, ['[' => '-', ']' => '']), '-');
    }
}