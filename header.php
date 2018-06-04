<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package igeta
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( get_template() ); ?>>
<!--[if lt IE 10]>
	<p class="browserupgrade">あなたは<a href="https://www.microsoft.com/japan/msbc/Express/ie_support/?tduid=(c23a0b4c2c4250d18195e73da240a60d)(256380)(2459594)(TnL5HPStwNw-X1eNbpe1sMi3IMh_IJlqPA)()" target="_blank">Microsoftがもはやサポートしていない</a>旧いWebブラウザを使用されています。サポート対象から外れたブラウザはセキュリティ的に危険です。安全性を確保し、表示の適正化するために<a href="http://browsehappy.com/">ブラウザをアップデート</a>することをおすすめします。</p>
<![endif]-->



<div class="site">
	<a class="screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'igeta' ); ?></a>



	<div class="header-wrapper">


		<header id="masthead" class="site-header" role="banner">
			<div class="container">

			<?php
			if ( has_custom_logo() ) {
				$igeta_site_title = get_custom_logo();
			}
			else {
				$igeta_site_title = '<a href="' . get_bloginfo('url', 'display') . '" class="custom-logo-link">' . get_bloginfo('name', 'display') . "</a>";
			}

			if ( is_front_page() ) : ?>
				<div class="site-branding">
					<h1 class="site-title"><?php echo $igeta_site_title ?></h1>
					<?php
					$igeta_description = get_bloginfo( 'description', 'display' );
					if ( isset( $igeta_description ) ) : ?>
						<p class="catch-phrase"><?php echo $igeta_description; ?></p>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<div class="site-branding">
					<p class="site-title"><?php echo $igeta_site_title ?></p>
				</div>
			<?php endif; ?>


			<?php get_template_part( 'template-parts/primary-menu' ); ?>

			</div>
		</header>



		<?php if ( is_front_page() ) : ?>
			<?php get_template_part( 'template-parts/hero-image' ); ?>
		<?php endif ; ?>

	</div>





	<?php
	// アイキャッチ画像をCSS背景に
	//   出力：echo $post_thumnail_bg_style;
	if ( is_singular( 'post' ) ) {
		if ( has_post_thumbnail() ) {
			echo '<div class="bg--post-thumbnail bg--post-thumbnail--large" style="background-image:url(' . wp_get_attachment_url( get_post_thumbnail_id() ) . ');"></div>';
		} else {
			echo '<div class="bg--post-thumbnail"><p class="parent-title">ブログ</p></div>';
		}

		get_template_part( 'template-parts/breadcrumbs' );

		// $post_thumnail_bg_style = '';
		// if ( has_post_thumbnail() ) {
		// 	$post_thumnail_bg_style = ' style="background-image:url('
		// 	. wp_get_attachment_url( get_post_thumbnail_id() )
		// 	. ');"';
		// }
	}

	?>
	<?php if ( is_home() || ( 'post' === get_post_type() && ( is_category() || is_tag() || is_month() || is_author() ) ) ) : ?>
		<div class="bg--post-thumbnail">
			<p class="parent-title">ブログ</p>
		</div>
		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
	<?php elseif ( is_singular( 'member' ) || is_post_type_archive( 'member' ) ) : ?>
		<div class="bg--post-thumbnail">
			<p class="parent-title">プライベート・ギャラリー</p>
		</div>
		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
	<?php endif ; ?>





	<?php
	/**
	 * カラム分け用
	 */
	$layout_class = '';
	if ( is_single() || is_archive() || is_home() ) {
		$layout_class = ' container';
	}
	?>


	<div class="site-content<?php echo $layout_class ?>">