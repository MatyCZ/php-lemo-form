<?php

namespace Lemo\Form\View\Helper;

use Laminas\Form\Element\Collection;
use Laminas\Form\FormInterface;
use Laminas\Form\View\Helper\Form;
use Laminas\View\Helper\Doctype;

class BootstrapForm extends Form
{
    /**
     * @var BootstrapFormGroup
     */
    protected $bootstrapFormGroup;

    /**
     * @var BootstrapFormCollection
     */
    protected $bootstrapFormCollection;

    /**
     * Konstruktor
     *
     * @param BootstrapFormCollection $bootstrapFormGroupsCollection
     * @param BootstrapFormGroup      $bootstrapFormGroup
     */
    public function __construct(
        BootstrapFormCollection $bootstrapFormGroupsCollection,
        BootstrapFormGroup $bootstrapFormGroup
    ) {
        $this->bootstrapFormCollection = $bootstrapFormGroupsCollection;
        $this->bootstrapFormGroup      = $bootstrapFormGroup;
    }

    /**
     * @param  FormInterface|null $form
     * @param  array|null         $elementNames
     * @return string
     */
    public function __invoke(FormInterface $form = null, array $elementNames = [])
    {
        if (null == $form) {
            return $this;
        }

        return $this->render($form, $elementNames);
    }

    /**
     * @param  FormInterface $form
     * @param  array         $elementNames
     * @return string
     */
    public function render(FormInterface $form, array $elementNames = []) : string
    {
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        if (empty($elementNames)) {
            $elementNames = array_keys($form->getElements());
        }

        $content = '';
        foreach ($elementNames as $elementName) {
            if (!$form->has($elementName) ) {
                continue;
            }

            $element = $form->get($elementName);

            if ($element instanceof Collection) {
                $content .= $this->bootstrapFormCollection->render($element);
            } else {
                $content .= $this->bootstrapFormGroup->render($element);
            }
        }

        return $this->openTag($form) . $content . $this->closeTag();
    }

    /**
     * Generate an opening form tag
     *
     * @param  null|FormInterface $form
     * @return string
     */
    public function openTag(FormInterface $form = null): string
    {
        $doctype    = $this->getDoctype();
        $attributes = [];

        if (! (Doctype::HTML5 === $doctype || Doctype::XHTML5 === $doctype)) {
            $attributes = [
                'action' => '',
                'method' => 'get',
            ];
        }

        if ($form instanceof FormInterface) {
            $formAttributes = $form->getAttributes();
            if (! array_key_exists('id', $formAttributes) && array_key_exists('name', $formAttributes)) {
                $formAttributes['id'] = $formAttributes['name'];
            }
            $attributes = array_merge($attributes, $formAttributes);
        }

        if ($attributes) {
            return sprintf('<form %s>', $this->createAttributesString($attributes));
        }

        return '<form>';
    }

    /**
     * Generate a closing form tag
     *
     * @return string
     */
    public function closeTag(): string
    {
        return '</form>';
    }
}
