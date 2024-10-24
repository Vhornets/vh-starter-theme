<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

add_action('wp_loaded', 'vh_setup_options_page');
function vh_setup_options_page()
{
    acf_add_options_page([
        'page_title'    => 'Theme settings',
        'menu_title'    => 'Theme settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ]);

    $settings = new FieldsBuilder('settings');
    $settings
        ->addTab('General')
        ->addImage('logo')
        ->addTab('Links')
        ->addRepeater('socials', ['min' => 1, 'layout' => 'table', 'collapsed' => 'link'])
        ->addImage('icon')
        ->addText('link')
        ->endRepeater()
        ->setLocation('options_page', '==', 'theme-settings');

    acf_add_local_field_group($settings->build());
}
