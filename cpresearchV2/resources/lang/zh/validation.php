<?php

return [
    'accepted' => ':attribute 必须被接受。',
    'active_url' => ':attribute 不是一个有效的 URL。',
    'after' => ':attribute 必须是 :date 之后的日期。',
    'after_or_equal' => ':attribute 必须是 :date 之后或相等的日期。',
    'alpha' => ':attribute 只能包含字母。',
    'alpha_dash' => ':attribute 只能包含字母、数字、短横线和下划线。',
    'alpha_num' => ':attribute 只能包含字母和数字。',
    'array' => ':attribute 必须是数组。',
    'before' => ':attribute 必须是 :date 之前的日期。',
    'before_or_equal' => ':attribute 必须是 :date 之前或相等的日期。',
    'between' => [
        'numeric' => ':attribute 必须在 :min 和 :max 之间。',
        'file' => ':attribute 必须在 :min 和 :max KB 之间。',
        'string' => ':attribute 必须在 :min 和 :max 个字符之间。',
        'array' => ':attribute 必须有 :min 到 :max 项。',
    ],
    'boolean' => ':attribute 字段必须是 true 或 false。',
    'confirmed' => ':attribute 确认不匹配。',
    'date' => ':attribute 不是有效的日期。',
    'date_equals' => ':attribute 必须是等于 :date 的日期。',
    'email' => ':attribute 必须是有效的电子邮件地址。',
    'exists' => '所选的 :attribute 无效。',
    'integer' => ':attribute 必须是整数。',
    'max' => [
        'numeric' => ':attribute 不能大于 :max。',
        'file' => ':attribute 不能超过 :max KB。',
        'string' => ':attribute 不能超过 :max 个字符。',
        'array' => ':attribute 不能超过 :max 项。',
    ],
    'min' => [
        'numeric' => ':attribute 必须至少为 :min。',
        'file' => ':attribute 必须至少 :min KB。',
        'string' => ':attribute 必须至少 :min 个字符。',
        'array' => ':attribute 必须至少有 :min 项。',
    ],
    'required' => ':attribute 字段是必填的。',
    'unique' => ':attribute 已经被使用。',

    'custom' => [
        'attribute-name' => [
            'rule-name' => '自定义消息',
        ],
    ],

    'attributes' => [],
];
