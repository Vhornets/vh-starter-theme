<?php
add_action('init', 'register_block_vh_some_block');
function register_block_vh_some_block()
{
    register_block_type(__DIR__);
}
