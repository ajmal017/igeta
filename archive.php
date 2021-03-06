<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package igeta
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>


			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="container--narrow">

				<?php if ( have_posts() ) : ?>

					<ul class="media--thumbnail">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content-archive', get_post_type() );
					endwhile;
					?>
					</ul>

					<?php
					the_posts_navigation();

				else :
					?>

					<p>準備中です</p>

					<?php
				endif;
				?>

				</div>
			</section>

		</main>
	</div>

<?php
get_sidebar();
get_footer();
