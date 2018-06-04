<?php
/**
Template Name: フロントページ
Template Post Type: page
*/

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kunai
 */

the_post();
get_header(); ?>


    <div id="content" class="site-content">


        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">




                <div class="container">
                <?php if ( is_front_page() ) : ?>
                        <?php if ( has_excerpt() || get_the_content() ) : // TODO: 読み込み減らすようリファクタリング ?>
                        <div class="front-page-content">
                                <?php if ( has_excerpt() ) : ?>
                                <div class="front-page-content__lead">
                                        <?php the_excerpt(); ?>
                                </div>
                                <?php endif; ?>
                                <?php if ( get_the_content() ) : ?>
                                <div class="front-page-content__body">
                                        <?php the_content() ?>
                                </div>
                                <?php endif; ?>
                        </div>
                        <?php endif; ?>
                <?php else : ?>
                <?php get_template_part( 'template-parts/show-top-level-header' ); // 最上位のヘッダーの表示 ?>
                <?php endif ; ?>
                </div>





                <section class="border-bottom">
                        <div class="container--narrow">
                                <div class="media--thumbnail">
                                        <img class="media__img" src="http://dummyimage.com/320x240/CCC/fff.png&text=代替テキスト">
                                        <div class="media__body">
                                                <h3 class="media__title"><a href="#">境域講演会と保育参観</a></h3>
                                                <p class="media__meta">2017年9月15日<span class="sep"> | </span>カテゴリ名</p>
                                        </div>
                                </div>
                                <div class="media--thumbnail">
                                        <img class="media__img" src="http://dummyimage.com/320x240/CCC/fff.png&text=代替テキスト">
                                        <div class="media__body">
                                                <h3 class="media__title"><a href="#">境域講演会と保育参観</a></h3>
                                                <p class="media__meta">2017年9月15日<span class="sep"> | </span>カテゴリ名</p>
                                        </div>
                                </div>
                                <div class="media--thumbnail">
                                        <img class="media__img" src="http://dummyimage.com/320x240/CCC/fff.png&text=代替テキスト">
                                        <div class="media__body">
                                                <h3 class="media__title"><a href="#">境域講演会と保育参観</a></h3>
                                                <p class="media__meta">2017年9月15日<span class="sep"> | </span>カテゴリ名</p>
                                        </div>
                                </div>
                        </div>
                </section>





                <div class="container">
                    <section class="widget widget_categories">
                        <h3 class="widget-title">ウィジェット・タイトル</h3>
                        <ul>
                                <li><a href="#">イベント</a></li>
                                <li><a href="#">教育</a></li>
                                <li><a href="#">安全</a></li>
                                <li><a href="#">まちづくり</a></li>
                                <li><a href="#">福祉</a></li>
                        </ul>
                    </section>
                </div>




                    <?php // フロントページのウィジェットコンテンツ群。有効なら表示
                    if ( is_active_sidebar( 'front-page-contents' ) ) :
                    ?>
                            <div class="front-page-contents-area">
                                    <?php dynamic_sidebar( 'front-page-contents' ); ?>
                            </div>
                    <?php endif; ?>





                    <?php
                    /**
                     * ブログ最新記事
                     */
                    $article_posts = get_posts(
                            array(
                                    // 'category'                => 149,// カテゴリIDで指定する場合
                                    'post_type'              => 'post',
                                    // 'category_name' => 'news',// カテゴリスラッグ
                                    // 'category__not_in' => array( 149 ),// ニュースカテゴリ以外
                                    'posts_per_page'     => 12,
                                    'order'                     => 'DESC',
                                    'orderby'                   => 'date'
                            )
                    );
                    if ( isset( $article_posts ) ) :
                    ?>

                            <section class="bg-dark border-bottom">
                                    <div class="container">
                                            <div class="aligncenter">
                                                    <h2>ブログ最新記事<small>blog</small></h2>
                                                    <p>様々なレイアウトパターンが適用できます</p>
                                            </div>

                                            <div class="grid grid--mobile-2col card--base">

                                            <?php
                                            foreach ( $article_posts as $post ) :setup_postdata( $post );

                                            // カテゴリ表示用
                                            $cat = get_the_category();
                                            $cat = $cat[0];
                                            ?>

                                                            <div class="card">
                                                            <?php if ( has_post_thumbnail() ) :
                                                            ?>
                                                                    <a href="<?php the_permalink(); ?>">
                                                                            <?php the_post_thumbnail( 'large', array( 'class' => "card__img" ) ); ?>
                                                                    </a>
                                                            <?php else : // アイキャッチ画像がない場合 ?>
                                                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/no-image.png" alt="" class="card__img"></a>
                                                            <?php endif; ?>

                                                                    <div class="card__body">
                                                                            <h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                                            <p class="card__meta"><?php echo get_the_date( 'Y年m月d日' ); ?></p>
                                                                            <p class="card__meta"><?php echo get_cat_name($cat->term_id); ?></p>
                                                                            <!-- <p><?php the_excerpt(); ?></p> -->
                                                                    </div>
                                                            </div>

                                            <?php
                                            endforeach; wp_reset_postdata();
                                            ?>
                                            </div>
                                            <p class="aligncenter"><a class="btn--primary" href="./blog/">全ての記事を見る</a></p>
                                    </div>
                            </section>

                    <?php
                    endif;
                    // ブログ最新記事 ここまで
                    ?>



                <section class="border-bottom aligncenter">
                    <div class="container--narrow img--circle">

                        <div class="media--mobile-2col">
                            <img class="media__img" src="http://dummyimage.com/200x300/CCC/fff.png&text=代替テキスト">
                            <div class="media__body">
                                <h3 class="media__title">見出しです</h3>
                                <p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
                                <p class="alignright">社長 <b>鈴木 太郎</b></p>
                            </div>
                        </div>

                        <div class="media media--inverse">
                            <img class="media__img" src="http://dummyimage.com/800x600/CCC/fff.png&text=代替テキスト">
                            <div class="media__body">
                                <h3 class="media__title">見出しです</h3>
                                <p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
                                <p class="alignright">社長 <b>鈴木 太郎</b></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-light">
                        <div class="container--narrow">
                            <div class="media--25">
                                <img class="media__img" src="http://dummyimage.com/800x600/CCC/fff.png&text=代替テキスト">
                                <div class="media__body">
                                    <h3 class="media__title">見出しです</h3>
                                    <p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
                                    <p class="alignright">社長 鈴木 太郎</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container--narrow">
                        <div class="media--50 media--inverse">
                            <img class="media__img" src="http://dummyimage.com/800x600/CCC/fff.png&text=代替テキスト">
                            <div class="media__body">
                                <h3 class="media__title">見出しです</h3>
                                <p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
                                <p class="alignright">社長 鈴木 太郎</p>
                            </div>
                        </div>

                        <div class="media--75">
                            <img class="media__img" src="http://dummyimage.com/800x600/CCC/fff.png&text=代替テキスト">
                            <div class="media__body">
                                <h3 class="media__title">見出しです</h3>
                                <p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
                                <p class="alignright">社長 鈴木 太郎</p>
                            </div>
                        </div>
                    </div>
                </section>



                <section class="border-bottom">
                    <div class="container--narrow">
                        <img class="rounded" src="http://dummyimage.com/1200x400/CCC/fff.png&text=代替テキスト">
                    </div>
                </section>



                <section class="border-bottom">
                    <div class="container--narrow">
                        <table class="equal-row-width">
                            <caption>キャプション</caption>
                            <tbody>
                                <tr>
                                    <th> </th>
                                    <th>見出し１</th>
                                    <th>見出し２</th>
                                </tr>
                                <tr>
                                    <th>見出しA</th>
                                    <td>内容が入ります</td>
                                    <td>内容が入ります</td>
                                </tr>
                                <tr>
                                    <th>見出しB</th>
                                    <td>内容が入ります</td>
                                    <td>内容が入ります</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>



                <section class="container border-bottom">
                    <div class="grid--wide grid--mobile-2col">
                        <div class="card">
                            <img src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="" class="card__img">
                            <div class="card__body">
                                <p>ダミーです私は同年同時にこういう理解通りというは</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="" class="card__img">
                            <div class="card__body">
                                <p>ダミーです私は同年同時にこういう理解通りというは</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="" class="card__img">
                            <div class="card__body">
                                <p>ダミーです私は同年同時にこういう理解通りというは</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="" class="card__img">
                            <div class="card__body">
                                <p>ダミーです私は同年同時にこういう理解通りというは</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="" class="card__img">
                            <div class="card__body">
                                <p>ダミーです私は同年同時にこういう理解通りというは</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="" class="card__img">
                            <div class="card__body">
                                <p>ダミーです私は同年同時にこういう理解通りというは</p>
                            </div>
                        </div>
                    </div>
                </section>



                <section class="aligncenter">
                    <div class="container">
                        <h2>アクセスマップ<small>Access Map</small></h2>
                        <p class="mb-5">来園経路の詳しい説明をご用意しておりますのでご覧ください<br>
                            <a href="#">» 電車の方</a>　<a href="#">» 車の方</a></p>
                            <div class="embed-container">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13096.21480879533!2d135.41509313675814!3d34.854877934782415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000f70fab46217b%3A0x7c2da033a8233054!2z44CSNjY2LTAxMjMg5YW15bqr55yM5bed6KW_5biC6byT44GM5rud!5e0!3m2!1sja!2sjp!4v1524830616803" width="1200" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                            <p class="text-center"><a class="btn btn-lg" href="https://www.google.co.jp/maps/place/〒666-0123+兵庫県川西市鼓が滝/@34.8548779,135.4063599,15z/data=!3m1!4b1!4m5!3m4!1s0x6000f70fab46217b:0x7c2da033a8233054!8m2!3d34.8554875!4d135.4245655?hl=ja">Google マップで見る<small>map</small></a></p>
                    </div>
                </section>


                <?php get_template_part( 'template-parts/widget-main-bottom' ); ?>

            </main>

        <!-- /#primary.content-area -->
        </div>


        <?php get_sidebar(); ?>


    <!-- /#content -->
    </div>

    <a href="#top" id="move-to-page-top"><i class="fa fa-chevron-up" aria-hidden="true"></i> Top</a>

<?php get_footer(); ?>