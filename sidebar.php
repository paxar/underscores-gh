<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gh
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<!--Add name _______.php for check current displayed page (Paxar) -->
<p class="helper">sidebar.php</p>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
