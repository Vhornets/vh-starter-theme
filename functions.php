<?php
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

require get_template_directory() . '/inc/acf-fields/acf-fields.php';
require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/hooks.php';

// Init blocks
foreach (glob(__DIR__ . '/blocks/build/*', GLOB_ONLYDIR) as $folder) {
    if (basename($folder) === 'images') continue;

    include "$folder/index.php";
}
