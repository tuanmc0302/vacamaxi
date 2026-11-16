<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Kiểu dữ liệu cho đặc tính sản phẩm (Product Attributes)
    |--------------------------------------------------------------------------
    |
    | Định nghĩa các kiểu dữ liệu cho thông số/đặc tính của sản phẩm.
    | - text: Hiển thị văn bản bình thường
    | - color: Hiển thị bộ chọn màu (color picker) ở admin và nốt tròn ở client
    |
    */
    'attribute_types' => [
        'text' => [
            'label' => 'Văn bản (Text)',
            'default' => '',
        ],
        'color' => [
            'label' => 'Màu sắc (Color)',
            'default' => '#ffffff',
        ],
    ],
];
