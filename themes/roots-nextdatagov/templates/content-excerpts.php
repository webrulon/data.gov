<section class="updates">


<div class="page-header">
  <h1>Updates</h1>
</div>


<?php
//query_posts('meta_key=featured_datagov&meta_value=Yes&ignore_sticky_posts=1&posts_per_page=3');
$args = array( 
                'post_type' => 'post',
                'ignore_sticky_posts' => 1,                
                'tax_query' => array(
                	                array(
                	                'taxonomy' => 'post_format',
                	                'field' => 'slug',
                	                'terms' => array( 'post-format-link', 'post-format-status', 'post-format-gallery', 'post-format-image' ),
                	                'operator' => 'NOT IN'
                	                ),
                                    array(
                	                'taxonomy' => 'featured',
                	                'field' => 'slug',
                	                'terms' => array( 'highlights'),
                	                'operator' => 'NOT IN'
                	                ),
                                    array( // This filter is in case an intro Page is accidentally added as a Post
                                    'taxonomy' => 'featured',
                                    'field' => 'slug',
                                    'terms' => array( 'browse'),
                                    'operator' => 'NOT IN'
                                    )                 	                
                                ),                                                                             
                'posts_per_page' => 3 );

$new_query = new WP_Query($args);

?>

<?php while ($new_query->have_posts()) : $new_query->the_post(); ?>

<article <?php post_class(); ?>>
  <header>
    <?php $category = get_the_category() ?>
    <h5 class="category category-header topic-<?php echo $category[0]->slug;?>"><a href="/<?php echo $category[0]->slug;?>"><i></i><span><?php echo $category[0]->cat_name;?></span></a></h5>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>

<?php endwhile; ?>

<?php
wp_reset_postdata();
?>

<?php
//'terms' => array( 'post-format-link', 'post-format-status', 'post-format-gallery', 'post-format-image' ),

$args = array( 
                'post_type' => 'post',
                'ignore_sticky_posts' => 1,                
                'tax_query' => array(
                	                array(
                	                'taxonomy' => 'post_format',
                	                'field' => 'slug',
                	                'terms' => array( 'post-format-status'),
                	                ),
                                    array(
                	                'taxonomy' => 'featured',
                	                'field' => 'slug',
                	                'terms' => array( 'highlights'),
                	                'operator' => 'NOT IN'
                	                )
                                ),                
                'posts_per_page' => 3 );

$new_query = new WP_Query($args);

?>

<?php while ($new_query->have_posts()) : $new_query->the_post(); ?>

<article <?php post_class('col-md-4 col-lg-4'); ?>>

  <header>
    <div class="tweet-author">
        <a class="author-link" href="https://twitter.com/<?php the_field('twitter_handle'); ?>">
            <span class="author-image">
                <img alt="" src="<?php the_field('twitter_photo'); ?>">
            </span>
            <div>
            <span class="author-name">
                <?php the_field('persons_name'); ?>            
            </span>
                <span class="author-handle">
                    @<?php the_field('twitter_handle'); ?>            
                </span>         
            </div>
        </a>
         
    </div>
  </header>  
    
    <div class="body">
        <?php the_content('Read the rest of this entry »'); ?>
    </div>
</article>

<?php endwhile; ?>

<?php
wp_reset_postdata();    
?>

</section>

