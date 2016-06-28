<?php $issue_title_id = get_latest_issue_id(); ?>
<div class="splash row">
    <div class="pure-g-r content">
        <div class="pure-u-19-24">
        </div>
        <div class="col-lg-3 pull-right splash-box">
            <a href="<?php echo get_permalink($issue_title_id); ?>">
            <div class="l-box splash-text">
                <span class="post-meta" style="color:#111;">current issue</span>
                <h1 class="splash-head">
                    <?php echo get_the_title($issue_title_id); ?>
                </h1>
                <p class="splash-subhead"><?php the_field('issue_subtitle', $issue_title_id); ?></p>
            </div>
            </a>
        </div>
    </div>
</div>
