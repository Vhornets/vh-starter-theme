<?php
add_action('acf/init', 'vh_init_fields');
function vh_init_fields()
{
    if (!class_exists('ACF')) return;

    foreach (glob(__DIR__ . "/*.php") as $filename) {
        if ($filename === __FILE__) continue;

        include $filename;
    }
}
