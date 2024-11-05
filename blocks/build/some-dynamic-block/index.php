<?php
function block_vh_some_dynamic_block_render_callback($block_attributes, $content, $block)
{
    $currentPostTitle = get_the_title();

    return sprintf(
        '<h1 class="wp-block-wp-block-vh-starter-theme-some-dynamic-block">%1$s</h1>',
        $currentPostTitle
    );
}

add_action('init', 'register_block_vh_some_dynamic_block');
function register_block_vh_some_dynamic_block()
{
    register_block_type(
        __DIR__,
        [
            'render_callback' => 'block_vh_some_dynamic_block_render_callback',
        ]
    );
}
