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

                    <div class="sharing-buttons col-lg-1 pull-right" >

<a href="http://visitor.r20.constantcontact.com/manage/optin?v=001gZhl0uV6LWFk3pfUnHJZzgxak0DfMlzz8mRLhzC8Pk261wgknNqLfjkj7jFoSs3Pe0ZF6k7FIHU8P71IZUme4PjFIBTqe5h_NuXOMA1ajkk%3D">
                                <i class="fa fa-envelope fa-lg"></i>
                            </a>





                        
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
