<?php
function vh_posted_on()
{
	$time_string = '<time datetime="%1$s">%2$s</time>';
	if (get_the_time('U') !== get_the_modified_time('U')) {
		$time_string = '<time datetime="%1$s">%2$s</time><time datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr(get_the_date(DATE_W3C)),
		esc_html(get_the_date()),
		esc_attr(get_the_modified_date(DATE_W3C)),
		esc_html(get_the_modified_date())
	);

	printf(
		'<a href="%1$s" rel="bookmark">%2$s</a>',
		esc_url(get_permalink()),
		$time_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
}

function vh_comment_count()
{
	if (!post_password_required() && (comments_open() || get_comments_number())) {
		/* translators: %s: Name of current post. Only visible to screen readers. */
		comments_popup_link(sprintf(__('Leave a comment<span class="sr-only"> on %s</span>', 'test'), get_the_title()));
	}
}

function vh_post_thumbnail()
{
	if (is_singular()) :
?>

		<figure>
			<?php the_post_thumbnail(); ?>
		</figure><!-- .post-thumbnail -->

	<?php
	else :
	?>

		<figure>
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail(); ?>
			</a>
		</figure>

	<?php
	endif; // End is_singular().
}

function vh_get_thumbnail_src($size = 'medium', $post_id = null)
{
	$post_id = ($post_id == null ? get_the_ID() : $post_id);

	$thumb_id = get_post_thumbnail_id($post_id);
	$src = wp_get_attachment_image_src($thumb_id, $size);

	return isset($src[0]) ? $src[0] : '';
}

function vh_pagination()
{
	global $wp_query, $wp_rewrite;

	$max = $wp_query->max_num_pages;

	if (!$current = get_query_var('paged')) $current = 1;

	$a = array(
		'type'      => 'array',
		'base'      => str_replace(999999999, '%#%', get_pagenum_link(999999999)),
		'total'     => $max,
		'current'   => $current,
		'mid_size'  => 3,
		'end_size'  => 1,
		'prev_text' => '',
		'next_text' => ''
	);

	$pages = paginate_links($a);
	?>

	<?php if (is_array($pages)) : ?>
		<ul class="c-pagination">
			<?php foreach ($pages as $page) : ?>
				<li><?php echo $page; ?></li>
			<?php endforeach; ?>
		</ul>
<?php
	endif;
}

function render_template_part($slug, $name = null, $args = array(), $echo = true)
{
	global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

	// If template name is omitted, shift parameters
	if (is_array($name)) {
		$echo = $args;
		$args = $name;
		$name = null;
	}

	do_action("get_template_part_{$slug}", $slug, $name);

	do_action("render_template_part_{$slug}", $slug, $name, $args, $echo);

	$args = apply_filters("render_template_part_{$slug}_args", $args, $slug, $name, $echo);

	$templates = array();
	$name = (string) $name;
	if ('' !== $name)
		$templates[] = "{$slug}-{$name}.php";

	$templates[] = "{$slug}.php";

	if ('' === locate_template($templates)) return;

	if (is_array($wp_query->query_vars)) {
		extract($wp_query->query_vars, EXTR_SKIP);
	}

	if (isset($s)) {
		$s = esc_attr($s);
	}

	if (is_array($args)) {
		extract($args, EXTR_SKIP);
	}

	// If $query variable extracted, assume we need to set up as $wp_query
	if (isset($query)) {
		$wp_query = $query;
	}

	// If $post_object variable extracted, assume we need to set up as $post
	if (isset($post_object)) {
		$post = $post_object;
		setup_postdata($post);
	}

	if (false === $echo) {
		ob_start();
		require(locate_template($templates));
		$return = ob_get_clean();
	} else {
		require(locate_template($templates));
	}

	if (isset($query)) {
		wp_reset_query();
	}

	if (isset($post_object)) {
		wp_reset_postdata();
	}

	if (false === $echo) {
		return $return;
	}
}
