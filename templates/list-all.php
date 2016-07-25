<?php
 //Template Name: All Single Posts
?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<div class="page-header">
  <h1>
    <?php echo roots_title(); ?>
  </h1>
</div>

<div class="row">
  <div class="col-lg-9">

  <?php
  // the query
  $wp_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'paged' => $paged, 'posts_per_page'=>30)); ?>

  <?php if ( $wp_query->have_posts() ) : ?>

    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

      <article <?php post_class(); ?>>
        <header>
          <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php get_template_part('templates/entry-meta'); ?>
        </header>
        <div class="entry-summary">
           <?php the_excerpt(); ?>
        </div>
      </article>
    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>

  <?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>

  </div>
  <div class="col-lg-3">
      <h3>Featured Authors</h3>


      <?php

      /**
       *  List Users Alphabetically
       *
       *  Create a list of all authors of a WordPress blog.
       *  Names are grouped by first name with a single letter
       *  as a header character.
       *
       *      Call the function with <?php ngtj_list_users_alphabetically(); ?>
       *      where you want the list to appear.
       *
       *  @author   Nate Jacobs
       *  @link   https://gist.github.com/1321741
       *  http://wordpress.org/support/topic/customize-wp_list_authors-for-user-directory?replies=4
       */
      function ngtj_list_users_alphabetically()
      {
        $users = get_users( 'orderby=nicename&role=author' );

        $first_letter = '';
        foreach( $users as $user )
        {
          $space = strpos( $user->user_login, ' ' );
          $letter = substr( $user->user_login, 0, 1 );
          $letter = strtoupper( $letter );

          if ( $letter != $first_letter )
          {
            $first_letter = $letter;
          echo "<h5 id='ft_contrib_alphaletter_$first_letter'>$first_letter</h5>";
          }
          echo '<a href="' . get_author_posts_url( $user->ID, $user->user_nicename ) . '" title="' . $user->display_name . '">' . $user->display_name . '</a>';
          echo "<br>";
        }
      }
      ?>

      <?php ngtj_list_users_alphabetically(); ?>

  </div>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>