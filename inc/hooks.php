<?php
add_filter('nav_menu_link_attributes', 'vh_add_menu_item_classes', 10, 3);
function vh_add_menu_item_classes($atts, $item, $args)
{
    $atts['class'] = 'block py-2 pl-3 pr-4 text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 transition-colors';

    if ($item->current === true) {
        $atts['class'] = 'block py-2 pl-3 pr-4 text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:p-0';
    }

    return $atts;
}
