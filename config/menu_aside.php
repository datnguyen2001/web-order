<?php

return [
    'admin' => [
        [
            'name' => 'dashboard',
            'title' => 'Dashboard',
            'icon' => 'bi bi-grid',
            'route' => 'admin.index',
            'submenu' => [],
            'number' => 1
        ],
        [
            'name' => 'banner',
            'title' => 'Banner hình ảnh',
            'icon' => 'bi bi-grid',
            'route' => 'admin.banner.index',
            'submenu' => [],
            'number' => 2
        ],
        [
            'name' => 'e-commerce-platform',
            'title' => 'Danh sách sàn TMDT',
            'icon' => 'bi bi-grid',
            'route' => 'admin.e-commerce-platform.index',
            'submenu' => [],
            'number' => 2
        ],
        [
            'name' => 'setting',
            'title' => 'Cài đặt',
            'icon' => 'bi bi-grid',
            'route' => 'admin.setting.index',
            'submenu' => [],
            'number' => 2
        ],
        [
            'name' => 'post',
            'title' => 'Quản lý bài viết',
            'icon' => 'bi bi-grid',
            'route' => 'admin.post.index',
            'submenu' => [],
            'number' => 2
        ],
        [
            'name' => 'wallet',
            'title' => 'Nạp tiền',
            'icon' => 'bi bi-grid',
            'route' => 'admin.wallet.index',
            'submenu' => [],
            'number' => 2
        ],
        [
            'name' => 'order',
            'title' => 'Quản lý đơn hàng',
            'icon' => 'bi bi-grid',
            'route' => 'admin.order.index',
            'parameters' => ['status' => 'all'],
            'submenu' => [],
            'number' => 2
        ],
        [
            'name' => 'order_tracking',
            'title' => 'Theo dõi đơn hàng',
            'icon' => 'bi bi-grid',
            'route' => 'admin.tracking.home.index',
            'submenu' => [],
            'number' => 2
        ],
]
];
