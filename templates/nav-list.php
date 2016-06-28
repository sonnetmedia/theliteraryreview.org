<?php  
    remove_filter( 'pre_get_posts', 'sm_change_post_qty' ,1); 
    global $post;

    $args = array('posts_per_page' => 3, 'offset' => 1, 'post_type' => 'post',);
    $sidebar_posts = get_posts( $args );
?>
<!-- <div class="pure-u">
    <div class="content" style="padding-top:0;">
        <h4 class="brand">You Read. We Feed.</h4>
    </div>    
</div>
 -->

<div class="content posts-sidebar">
    <ul class="posts-list">
            <?php foreach ($sidebar_posts as $post ) : setup_postdata($post);   ?>
        <li>
            <a href="<?php the_permalink(); ?>">
                <span class="post-list-author">
                    <?php the_author(); ?>
                </span>
                <br />
                <?php the_title(); ?>
            </a>
        </li>
            <?php  endforeach;   ?> 
            <li class="post-meta"><a href="/find/" class="issue-color">Find More Articles</a></li>
    </ul>
<!-- 
<li class="post-meta"><a href="/find/" class="issue-color">Find More Articles</a></li>
 -->
        

</div>
<!-- <a href="http://www.fdu.edu/" title="Farleigh Dickenson University" class="logo-school-sidebar">
                <img src="/media/2013/07/fdulogo_260x78.png" style="width:110px;">
            </a>
 -->   


