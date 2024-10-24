<?php

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function vh_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'vh_pingback_header');

function vh_comment_form_defaults($defaults)
{
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace('/rows="\d+"/', 'rows="5"', $comment_field);

	return $defaults;
}
add_filter('comment_form_defaults', 'vh_comment_form_defaults');

/**
 * Filters the default archive titles.
 */
function vh_get_the_archive_title()
{
	if (is_category()) {
		$title = __('Category Archives: ', 'test') . '<span>' . single_term_title('', false) . '</span>';
	} elseif (is_tag()) {
		$title = __('Tag Archives: ', 'test') . '<span>' . single_term_title('', false) . '</span>';
	} elseif (is_author()) {
		$title = __('Author Archives: ', 'test') . '<span>' . get_the_author_meta('display_name') . '</span>';
	} elseif (is_year()) {
		$title = __('Yearly Archives: ', 'test') . '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'test')) . '</span>';
	} elseif (is_month()) {
		$title = __('Monthly Archives: ', 'test') . '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'test')) . '</span>';
	} elseif (is_day()) {
		$title = __('Daily Archives: ', 'test') . '<span>' . get_the_date() . '</span>';
	} elseif (is_post_type_archive()) {
		$cpt   = get_post_type_object(get_queried_object()->name);
		$title = sprintf(
			/* translators: %s: Post type singular name */
			esc_html__('%s Archives', 'test'),
			$cpt->labels->singular_name
		);
	} elseif (is_tax()) {
		$tax   = get_taxonomy(get_queried_object()->taxonomy);
		$title = sprintf(
			/* translators: %s: Taxonomy singular name */
			esc_html__('%s Archives', 'test'),
			$tax->labels->singular_name
		);
	} else {
		$title = __('Archives:', 'test');
	}
	return $title;
}
add_filter('get_the_archive_title', 'vh_get_the_archive_title');
