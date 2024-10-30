<?php
add_filter('nav_menu_link_attributes', 'vh_add_menu_item_classes', 10, 3);
function vh_add_menu_item_classes($atts, $item, $args)
{
    switch ($args->menu) {
        case 'menu-footer':
            $atts['class'] = 'block p-4 text-gray-900';

            if ($item->current === true) {
                $atts['class'] = 'block p-4 text-blue-700';
            }
            break;

        default:
            $atts['class'] = 'block py-2 pl-3 pr-4 text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 transition-colors';

            if ($item->current === true) {
                $atts['class'] = 'block py-2 pl-3 pr-4 text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:p-0';
            }
            break;
    }

    return $atts;
}

add_filter('block_categories_all', 'vh_add_block_categories');
function vh_add_block_categories($cats)
{
    $new = [
        'cats' => [
            'slug'  => 'vh-starter-theme',
            'title' => 'VH starter theme category'
        ]
    ];

    $position = 0;
    $cats = array_slice($cats, 0, $position, true) + $new + array_slice($cats, $position, null, true);
    $cats = array_values($cats);

    return $cats;
}

// Add support to SVG files for media uploads 
add_filter('upload_mimes', 'vh_add_svg_support_for_uploads');
function vh_add_svg_support_for_uploads($upload_mimes)
{
    if (! current_user_can('administrator')) {
        return $upload_mimes;
    }

    $upload_mimes['svg']  = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';

    return $upload_mimes;
}
