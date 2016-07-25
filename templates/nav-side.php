<a href="#menu__side" id="menuLink" class="menu__side--link">
    <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars fa-lg"></i>
</a>
<div class="sidebar" id="menu__side">
    <div class="menu__side menu__side--open">
    <?php get_template_part('/templates/nav-header');    ?>
        <?php
            get_template_part( '/templates/nav-side-interior' );
        ?>
         <a href="http://www.fdu.edu/" title="Farleigh Dickenson University" class="logo-school">
            <img src="/media/2013/07/fdulogo_260x78.png" style="width:140px;">
        </a>
    </div><!--  /.menu__side  -->
</div><!--  /.sidebar #menu__side  -->

    <!-- style="width:110px;"> -->



