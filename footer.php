<footer class="bg-white">
    <div class="mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-gray-500 sm:text-center">© <?php echo date('Y'); ?>
            <a href="<?php echo get_bloginfo('url'); ?>" class="hover:underline">
                <?php echo get_bloginfo('site_name'); ?>™
            </a>.

            All Rights Reserved.
        </span>

        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium sm:mt-0 md:space-x-8">
            <?php wp_nav_menu([
                'menu' => 'menu-footer',
                'theme_location' => 'menu-footer',
                'container' => false,
                'items_wrap' => '%3$s',
            ]); ?>
        </ul>
    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>