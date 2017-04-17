<?php

return [
    'view_helpers'       => [
        'invokables' => [
            'formControl'                  => \Lemo\Form\Form\View\Helper\FormControl::class,
            'formControlAddon'             => \Lemo\Form\Form\View\Helper\FormControlAddon::class,
            'formControlHelpBlock'         => \Lemo\Form\Form\View\Helper\FormControlHelpBlock::class,
            'formControlLabel'             => \Lemo\Form\Form\View\Helper\FormControlLabel::class,
            'formControls'                 => \Lemo\Form\Form\View\Helper\FormControls::class,
            'formGroupElement'             => \Lemo\Form\Form\View\Helper\FormGroupElement::class,
            'formGroupElements'            => \Lemo\Form\Form\View\Helper\FormGroupElements::class,
            'formGroups'                   => \Lemo\Form\Form\View\Helper\FormGroups::class,
            'formGroupsCollection'         => \Lemo\Form\Form\View\Helper\FormGroupsCollection::class,
            'formGroupsCollectionTemplate' => \Lemo\Form\Form\View\Helper\FormGroupsCollectionTemplate::class,
            'formGroupsFieldset'           => \Lemo\Form\Form\View\Helper\FormGroupsFieldset::class,
            'formRenderOptions'            => \Lemo\Form\Form\View\Helper\FormRenderOptions::class,
        ],
    ],
];
