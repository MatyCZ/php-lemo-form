<?php

namespace Lemo\Form;

return [

    'service_manager' => [
        'invokables' => [
            BootstrapFormOptions::class => BootstrapFormOptions::class,
        ],
    ],

    'view_helpers' => [
        'aliases' => [
            'bootstrapForm' => View\Helper\BootstrapForm::class,
            'bootstrapFormElement' => View\Helper\BootstrapFormElement::class,
            'bootstrapFormElementCheck' => View\Helper\BootstrapFormElementCheck::class,
            'bootstrapFormElementRadio' => View\Helper\BootstrapFormElementRadio::class,
            'bootstrapFormCollection' => View\Helper\BootstrapFormCollection::class,
            'bootstrapFormInput' => View\Helper\BootstrapFormInput::class,
            'bootstrapFormInputGroup' => View\Helper\BootstrapFormInputGroup::class,
            'bootstrapFormGroup' => View\Helper\BootstrapFormGroup::class,
            'bootstrapFormGroups' => View\Helper\BootstrapFormGroups::class,
            'bootstrapFormInvalidFeedback' => View\Helper\BootstrapFormInvalidFeedback::class,
            'bootstrapFormLabel' => View\Helper\BootstrapFormLabel::class,
            'bootstrapFormOptions' => View\Helper\BootstrapFormOptions::class,
            'bootstrapFormRow' => View\Helper\BootstrapFormRow::class,
        ],
        'invokables' => [
            'bootstrapFormInputGroupAppend' => View\Helper\BootstrapFormInputGroupAppend::class,
            'bootstrapFormInputGroupPrepend' => View\Helper\BootstrapFormInputGroupPrepend::class,
            'bootstrapFormText' => View\Helper\BootstrapFormText::class,
        ],
        'factories' => [
            View\Helper\BootstrapForm::class => View\Helper\BootstrapFormFactory::class,
            View\Helper\BootstrapFormElement::class => View\Helper\BootstrapFormElementFactory::class,
            View\Helper\BootstrapFormElementCheck::class => View\Helper\BootstrapFormElementCheckFactory::class,
            View\Helper\BootstrapFormElementRadio::class => View\Helper\BootstrapFormElementRadioFactory::class,
            View\Helper\BootstrapFormCollection::class => View\Helper\BootstrapFormCollectionFactory::class,
            View\Helper\BootstrapFormInput::class => View\Helper\BootstrapFormInputFactory::class,
            View\Helper\BootstrapFormInputGroup::class => View\Helper\BootstrapFormInputGroupFactory::class,
            View\Helper\BootstrapFormGroup::class => View\Helper\BootstrapFormGroupFactory::class,
            View\Helper\BootstrapFormGroups::class => View\Helper\BootstrapFormGroupsFactory::class,
            View\Helper\BootstrapFormInvalidFeedback::class => View\Helper\BootstrapFormInvalidFeedbackFactory::class,
            View\Helper\BootstrapFormLabel::class => View\Helper\BootstrapFormLabelFactory::class,
            View\Helper\BootstrapFormOptions::class => View\Helper\BootstrapFormOptionsFactory::class,
            View\Helper\BootstrapFormRow::class => View\Helper\BootstrapFormRowFactory::class,
        ],
    ],
];
