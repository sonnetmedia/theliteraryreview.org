<?php
 //Template Name: FIND

$args = array(
    'post_type' => 'sm_issues',
    'posts_per_page' => 100,
    //'post_status' => array('publish', 'draft'),
    'order' => 'desc'
  );
  $latest_issues = get_posts( $args );
    ?>

  <style type="text/css">
  .btn-bottom {
    position: absolute;
    bottom:0;
  }
  h5 {
     border-bottom:1px solid #e4e4e4;
     margin-top:1.5em;
  }

  </style>
  <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </header>

<div class="row">
<?php get_template_part( 'templates/searchform') ?>
</div>
<div class="row">
  <div class="col-lg-12">
      <h3>Back Issues</h3>

        <?php  foreach( $latest_issues as $post ) : setup_postdata($post); ?>
          <div class="col-lg-6" style="height:192px;margin-bottom:75px;padding-left:0;overflow:visible;">
            <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('category-thumb', array('class' => 'bordered mt-10 alignleft')); ?>
          </a>
            <div class="issue-meta">
              <h4 style="margin-bottom:0;"><?php the_title();// excerpt title issue id buy link ?> </h4>

                  <?php echo '<em>'; the_field('issue_subtitle'); echo '</em>'; ?>
                      <div class="btn-bottomf">
                      <?php echo '<br />Vol.'; the_field('issue_volume'); ?>

                        <?php echo 'Issue '; the_field('issue_no'); echo '</p>';?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-xs btn-default btn-bottom">buy this issue</a>
                      </div>

              </div>
          </div>
        <?php endforeach; ?>
        <?php wp_reset_query(); ?>


  </div>
</div>


<!-- category-thumb
thumb-med
 -->