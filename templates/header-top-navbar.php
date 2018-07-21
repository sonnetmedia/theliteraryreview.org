<header class="banner navbar navbar-inverse navbar-fixed-top" role="banner">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
<style type="text/css">
a .fa-envelope {color: #999; !important}
</style>



                        <?php  $sm_facebook =  get_field('facebook_handle', 'option');
                                $sm_twitter =  get_field('twitter_handle', 'option');
                        ?>

                    <div class="col-xs-8 col-sm-2 col-md-3 col-lg-3 nav-search">
                        <form role="search" method="get" class="search-form form-inline" action="<?php echo home_url('/'); ?>">
                          <div class="input-group">
                            <input id="search" type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
                            <label for="search" class="visuallyhidden"><?php _e('Search for:', 'roots'); ?></label>
                            <span class="input-group-btn">
                              <button type="submit" class="search-submit btn btn-default"><?php _e('Search', 'roots'); ?></button>
                            </span>
                          </div>
                        </form>
                    </div>

                    <div class="sharing-buttons col-xs-3 col-sm-2 col-md-2 col-lg-1 col-xs-4 pull-right" >

                        <!--
                        <a href="http://visitor.r20.constantcontact.com/manage/optin?v=001gZhl0uV6LWFk3pfUnHJZzgxak0DfMlzz8mRLhzC8Pk261wgknNqLfjkj7jFoSs3Pe0ZF6k7FIHU8P71IZUme4PjFIBTqe5h_NuXOMA1ajkk%3D">
                            <i class="fa fa-envelope fa-lg"></i>
                        </a>
                        -->

                        <?php if ($sm_twitter) {   ?>

                            <a href="https://twitter.com/<?php echo $sm_twitter ?>" target="_blank">
                                <i class="fa fa-twitter fa-lg"></i>
                            </a>

                        <?php   } if ($sm_facebook) {    ?>

                            <a href="http://www.facebook.com/<?php echo $sm_facebook ?>" target="_blank" >
                                <i class="fa fa-facebook fa-lg"></i>
                            </a>


                        <?php  }    ?>

                    </div>




    </nav>
</header>
