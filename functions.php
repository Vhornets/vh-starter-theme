<?php
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

function vh_theme_assets()
{
    wp_enqueue_style('vh-styles', get_template_directory_uri() . '/dist/css/styles.css', [], wp_get_theme()->get('Version'));
    wp_enqueue_script('vh-scripts', get_template_directory_uri() . '/dist/js/main.js', [], wp_get_theme()->get('Version'), true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'vh_theme_assets');

function vh_after_setup_theme()
{
    register_nav_menus(
        [
            'menu-primary' => __('Primary', 'vh'),
        ]
    );

    load_theme_textdomain('vh', get_template_directory() . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support(
        'html5',
        [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ]
    );
    add_theme_support('wp-block-styles');

    add_theme_support('editor-styles');
    add_editor_style(get_template_directory_uri() . '/dist/css/editor.css');

    remove_theme_support('block-templates');
}
add_action('after_setup_theme', 'vh_after_setup_theme');


require get_template_directory() . '/inc/acf-fields/acf-fields.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/hooks.php';

// Init blocks
foreach (glob(__DIR__ . '/blocks/build/*', GLOB_ONLYDIR) as $folder) {
    include "$folder/index.php";
}
