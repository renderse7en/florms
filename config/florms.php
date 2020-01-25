<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CSRF Protection
    |--------------------------------------------------------------------------
    |
    | Whether to enable CSRF protection by default for all forms. Normally you
    | should leave this to true, but you may disable it if necessary - for 
    | any other location as required by the application or its packages.
    | example, if all/most of your forms are submitted using AJAX where the
    | token is sent as part of the AJAX headers.
    |
    */

    'csrf' => true,

    /*
    |--------------------------------------------------------------------------
    | Inherit Old Session Input
    |--------------------------------------------------------------------------
    |
    | Whether to enable retrieving and populating the value using old input
    | flashed to the session - for example, after a redirect from a failed
    | form validation.
    |
    */

    'session' => true,

    /*
    |--------------------------------------------------------------------------
    | Auto Labels
    |--------------------------------------------------------------------------
    |
    | Whether to generate labels based on field names for all forms. This
    | is defaulted to true, but can be disabled if, for example, your field 
    | names don't conform to an easily transformable format.
    |
    */

    'labels' => true,

    /*
    |--------------------------------------------------------------------------
    | Default Skin
    |--------------------------------------------------------------------------
    |
    | The default skin, which will be used on all forms unless otherwise
    | specified.
    |
    */

    'skin'  => 'default',

    /*
    |--------------------------------------------------------------------------
    | Skin Settings
    |--------------------------------------------------------------------------
    |
    | The complete list of all available skins and their individual settings.
    |
    */

    'skins' => [

        // Settings for the 'default' skin.
        'default' => [

            // Settings for the various types of input control elements
            'controls'   => [

                /*
                |--------------------------------------------------------------
                | Control Default Classes
                |--------------------------------------------------------------
                |
                | Each major type of control below contains 3 specific options
                | for setting the default classes for each of the major pieces
                | of a given field.
                | 
                |  - The "control" value specifies the default class for the
                |    form control itself, e.g., "form-control" on most text
                |    fields.
                | 
                |  - The "label" value specifies the default class for the label
                |    that will usually be rendered immediately before or after
                |    the control.
                | 
                |  - The "container" value specifies the default class for the
                |    <div> block that will be rendered around the form control
                |    in certain cases, such as some of Bootstrap's custom
                |    controls. 
                |
                */

                // Settings for button-based inputs
                'button'   => [
                    'control'   => 'btn',
                    'label'     => null,
                    'container' => null,
                ],

                // Settings for checkbox controls
                'checkbox' => [
                    'control'   => 'custom-control-input',
                    'label'     => 'custom-control-label',
                    'container' => 'custom-control custom-checkbox',
                ],

                // Settings for file controls
                'file'     => [
                    'control'   => 'custom-file-input',
                    'label'     => 'custom-file-label',
                    'container' => 'custom-file',
                ],

                // Settings for radio controls
                'radio'    => [
                    'control'   => 'custom-control-input',
                    'label'     => 'custom-control-label',
                    'container' => 'custom-control custom-radio',
                ],

                // Settings for range controls
                'range'    => [
                    'control'   => 'custom-range',
                    'label'     => null,
                    'container' => null,
                ],

                // Settings for select dropdowns
                'select'   => [
                    'control'   => 'custom-select',
                    'label'     => null,
                    'container' => null,
                ],

                // Settings for switch/toggle controls
                'switch'   => [
                    'control'   => 'custom-control-input',
                    'label'     => 'custom-control-label',
                    'container' => 'custom-control custom-switch',
                ],
                
                // Settings for text-based controls
                'text'     => [
                    'control'   => 'form-control',
                    'label'     => null,
                    'container' => null,
                ],
            ],

            /*
            |------------------------------------------------------------------
            | Container/Extra Default Classes
            |------------------------------------------------------------------
            |
            | Default classes and other options for various container blocks 
            | that can wrap around most input controls in Bootstrap-based 
            | forms. The classes here by default are required for Bootstrap 4,
            | but you can change or add to them, if necessary.
            |
            */
            
            'containers' => [

                // Default class for the <form> element
                'form'              => null,

                // Default class for the <div class="form-group"> element.
                'formGroup'         => 'form-group',

                // Default class for the <small class="form-text"> element.
                'helpText'          => 'form-text text-muted',

                // Default class applied to form controls that fail validation.
                'invalid'           => 'is-invalid',

                // Default class applied to the error messages div appearing
                // within the form-group for controls that fail validation.
                'invalidFeedback'   => 'invalid-feedback',

                // String inserted between each individual error message within
                // the invalid feedback block.
                'invalidSplit'      => '<br>',

                // Default class for the <div class="input-group"> element.
                'inputGroup'        => 'input-group',

                // Default class for the addon div that appears before the field
                // in an input-group.
                'inputGroupPrepend' => 'input-group-prepend',

                // Default class for the addon div that appears after the field
                // in an input-group. 
                'inputGroupAppend'  => 'input-group-append',

                // Default class for text appearing inside the prepend/append
                // div in an input-group.
                'inputGroupText'    => 'input-group-text',
            ],
        ],
    ],
];
