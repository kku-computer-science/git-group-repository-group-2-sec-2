<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    'password' => [
        'old_password_incorrect' => 'The current password is incorrect',
        'enter_current_password' => 'Please enter your current password',
        'enter_new_password' => 'Please enter your new password',
        'reEnter_password' => 'Please re-enter your new password',
        'enter_new_password' => 'Please enter your new password',
        'oldpass_min' => 'Old password must have atleast 8 characters',
        'oldpass_max' => 'Old password must not be greater than 30 characters',
        'newpass_min' => 'New password must have atleast 8 characters',
        'newpass_max' => 'New password must not be greater than 30 characters',
        'cnewpass_required' => 'Please confirm your new password',
        'newpass_same' => 'New password and Confirm new password must match',
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],


//cpresearchV2/resources/views/departments/create.blade.php
'required' => 'The :attribute field is required.',
    'custom' => [
        'department_name_th' => [
            'required' => 'The department name (TH) field is required.',
        ],
        'department_name_en' => [
            'required' => 'The department name (EN) field is required.',
        ],
        'ac_name' => [
            'required' => 'The book name field is required.',
        ],
        'ac_year' => [
            'required' => 'The book year field is required.',
        ],
        'group_name_th' => [
            'required' => 'The group name (TH) field is required.',
        ],
        'group_name_en' => [
            'required' => 'The group name (EN) field is required.',
        ],
        'head' => [
            'required' => 'The head field is required.',
        ],
        //cpresearchV2/resources/views/users/create.blade.php

        'fname_en' => [
            'required' => 'The first name (EN) field is required.',
        ],
        'lname_en' => [
            'required' => 'The last name (EN) field is required.',
        ],
        'fname_th' => [
            'required' => 'The first name (TH) field is required.',
        ],
        'lname_th' => [
            'required' => 'The last name (TH) field is required.',
        ],
        'email' => [
            'required' => 'The email field is required.',
            'unique' => 'The email has already been taken.',
        ],
        'password' => [
            'required' => 'The password field is required.',
        ],
        'roles' => [
            'required' => 'The roles field is required.',
        ],
        'field' => [
            'required' => 'The :attribute field is required.',
        ],
        //cpresearchV2/app/Http/Controllers/ResearchGroupController.php
        'group_name_th' => ['required' => 'The research group name (TH) field is required.'],
        'group_name_en' => ['required' => 'The research group name (EN) field is required.'],
        'group_desc_th' => ['required' => 'The research group description (TH) field is required.'],
        'group_desc_en' => ['required' => 'The research group description (EN) field is required.'],
        'group_detail_th' => ['required' => 'The research group detail (TH) field is required.'],
        'group_detail_en' => ['required' => 'The research group detail (EN) field is required.'],
        'head' => ['required' => 'The research group leader field is required.'],
        'group_image' => [
            'mimes' => 'The image must be a file of type: png, jpg, jpeg.',
            'max' => 'The image may not be greater than 2MB.',
        ],
    ],
    'email' => [
        'required' => 'The email field is required.',
        'unique' => 'The email has already been taken.',
    ],

    //cpresearchV2/app/Http/Controllers/ResearchGroupController.php
    
];
