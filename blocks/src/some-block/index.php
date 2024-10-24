<?php
function register_block_vh_some_block()
{
    register_block_type(
        __DIR__,
        // [
        //     'render_callback' => 'render_block_core_post_title',
        // ]
    );
}
add_action('init', 'register_block_vh_some_block');
