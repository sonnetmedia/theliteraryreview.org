<?php while (have_posts()) : the_post(); ?>
<div class="page-header">
  <h1>
  <?php
    if ( 'sm_issues' == get_post_type() ) {
        echo 'Back Issue';
      }
    else {
        the_category(' ');
    }
  ?>
  </h1>
</div>
  <article <?php post_class(); ?>>
    <header>
<?php
    if ( 'sm_issues' == get_post_type() ) {
        echo '<h4 style="max-width:60%;"><em>'; // max width fixes subtitle from spilling over to purchase box
        the_field('issue_subtitle'); echo '</em></h4>';
        ?><h2 class="entry-title"><?php the_title(); ?></h2><?php
        echo '<br />Vol.'; the_field('issue_volume'); echo ' Issue '; the_field('issue_no'); echo '';
        if( get_field('cover_artist') ) {
          echo '<br />Cover Artist: '; the_field('cover_artist'); echo '';
        }
      }

      else {
        ?><h2 class="entry-title"><?php the_title(); ?></h2><?php
      }
 ?>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_post_thumbnail('medium', array('class' => 'align-left-flow')); ?>
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
