<?php get_header(); ?>

<div class="max-w-screen-xl mx-auto p-4">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h1 class="text-5xl font-bold my-4"><?php the_title(); ?></h1>

            <?php the_content(); ?>
    <?php endwhile;
    endif; ?>

</div>

<?php get_footer(); ?>