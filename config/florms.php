<?php

return [

    'skins' => [
        'default' => [
            'controls'   => [
                'button'   => [
                    'control'   => 'btn',
                    'label'     => null,
                    'container' => null,
                ],
                'checkbox' => [
                    'control'   => 'custom-control-input',
                    'label'     => 'custom-control-label',
                    'container' => 'custom-control custom-checkbox',
                ],
                'file'     => [
                    'control'   => 'custom-file-input',
                    'label'     => 'custom-file-label',
                    'container' => 'custom-file',
                ],
                'radio'    => [
                    'control'   => 'custom-control-input',
                    'label'     => 'custom-control-label',
                    'container' => 'custom-control custom-radio',
                ],
                'range'    => [
                    'control'   => 'custom-range',
                    'label'     => null,
                    'container' => null,
                ],
                'select'   => [
                    'control'   => 'custom-select',
                    'label'     => null,
                    'container' => null,
                ],
                'switch'   => [
                    'control'   => 'custom-control-input',
                    'label'     => 'custom-control-label',
                    'container' => 'custom-control custom-switch',
                ],
                'text'     => [
                    'control'   => 'form-control',
                    'label'     => null,
                    'container' => null,
                ],
            ],
            'containers' => [
                'form'              => null,
                'formGroup'         => 'form-group',
                'helpText'          => 'form-text text-muted',
                'invalid'           => 'is-invalid',
                'invalidFeedback'   => 'invalid-feedback',
                'invalidSplit'      => '<br>',
                'inputGroup'        => 'input-group',
                'inputGroupPrepend' => 'input-group-prepend',
                'inputGroupAppend'  => 'input-group-append',
                'inputGroupText'    => 'input-group-text',
                'valid'             => 'is-valid',
                'validFeedback'     => 'valid-feedback',
            ],
        ],
    ],

    'skin'  => 'default',

];
