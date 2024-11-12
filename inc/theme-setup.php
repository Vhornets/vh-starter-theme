<?php
add_action('wp_enqueue_scripts', 'vh_theme_assets');
function vh_theme_assets()
{
    wp_enqueue_style('fonts-sen', 'https://fonts.googleapis.com/css2?family=Sen:wght@400..800&display=swap', [], null, 'all');
    wp_enqueue_style('vh-styles', get_template_directory_uri() . '/dist/css/styles.css', [], wp_get_theme()->get('Version'));
    wp_enqueue_script('vh-scripts', get_template_directory_uri() . '/dist/js/main.js', [], wp_get_theme()->get('Version'), true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('after_setup_theme', 'vh_after_setup_theme');
function vh_after_setup_theme()
{
    register_nav_menus(
        [
            'menu-primary' => __('Main menu', 'vh-starter-theme'),
            'menu-footer' => __('Footer menu', 'vh-starter-theme'),
        ]
    );

    load_theme_textdomain('vh-starter-theme', get_template_directory() . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('customize-selective-refresh-widgets');
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
    add_theme_support('editor-styles');

    add_editor_style('dist/css/editor.css');

    remove_theme_support('block-templates');
}
