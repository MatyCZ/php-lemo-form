<?php

return [
    'view_helpers'       => [
        'invokables' => [
            'formControl'                  => \LemoForm\Form\View\Helper\FormControl::class,
            'formControlAddon'             => \LemoForm\Form\View\Helper\FormControlAddon::class,
            'formControlHelpBlock'         => \LemoForm\Form\View\Helper\FormControlHelpBlock::class,
            'formControlLabel'             => \LemoForm\Form\View\Helper\FormControlLabel::class,
            'formControls'                 => \LemoForm\Form\View\Helper\FormControls::class,
            'formGroupElement'             => \LemoForm\Form\View\Helper\FormGroupElement::class,
            'formGroupElements'            => \LemoForm\Form\View\Helper\FormGroupElements::class,
            'formGroups'                   => \LemoForm\Form\View\Helper\FormGroups::class,
            'formGroupsCollection'         => \LemoForm\Form\View\Helper\FormGroupsCollection::class,
            'formGroupsCollectionTemplate' => \LemoForm\Form\View\Helper\FormGroupsCollectionTemplate::class,
            'formGroupsFieldset'           => \LemoForm\Form\View\Helper\FormGroupsFieldset::class,
            'formRenderOptions'            => \LemoForm\Form\View\Helper\FormRenderOptions::class,
        ],
    ],
];
