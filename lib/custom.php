<?php
/**
 * Custom functions
 */
// Converts ISBN-13 to ISBN-10
// Leaves ISBN-10 numbers (or anything else not matching 13 consecutive numbers) alone
function ISBN13toISBN10($isbn) {
    if (preg_match('/^\d{3}(\d{9})\d$/', $isbn, $m)) {
        $sequence = $m[1];
        $sum = 0;
        $mul = 10;
        for ($i = 0; $i < 9; $i++) {
            $sum = $sum + ($mul * (int) $sequence{$i});
            $mul--;
        }
        $mod = 11 - ($sum%11);
        if ($mod == 10) {
            $mod = "X";
        }
        else if ($mod == 11) {
            $mod = 0;
        }
        $isbn = $sequence.$mod;
    }
    return $isbn;
}

function pubspring_setup() {
    add_image_size( 'category-thumb', 120, 9999 );
        add_image_size( 'thumb-med', 200, 9999 );
  }
add_action('after_setup_theme', 'pubspring_setup');

function typekit(){ ?>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<script type="text/javascript" src="//use.typekit.net/hic8aof.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php
}
add_action('wp_head', 'typekit');


function get_latest_issue_id() {
  //Get the latest issue for use elsewhere around the site
  global $latest_issue_id;
  $latest_issues_args = array(
    'post_type' => 'sm_issues',
    'posts_per_page' => 1
  );
  $latest_issues = get_posts( $latest_issues_args );
    foreach( $latest_issues as $post ) : setup_postdata($post);
      if (!isset($latest_issue_id)) {
          $latest_issue_id = $post->ID;
        }
 endforeach;
return $latest_issue_id;
}

function javascript_functions() {
//Pull the latest issue's cover to display full screen, using the backstretch function

if ( 'sm_issues' == get_post_type() ){

  $issue_title_id = get_the_ID();


}

else {
$issue_title_id = get_latest_issue_id();
}







  $issue_image = get_field('issue_image_site', $issue_title_id);
  $size = "full"; // (thumbnail, medium, large, full or custom size)
  $image = wp_get_attachment_image_src( $issue_image, $size );
?>

  <script type="text/javascript">
    jQuery(document).ready(function($){
     $.backstretch("<?php echo $image[0]; ?>", {speed: 100, centeredY: true});
     $("#content_wrapper").waypoint(function(direction) {

         if (direction === 'down') {
                 $('.sidebar').toggleClass('blacken');
         }
         else {
           $('.sidebar').removeClass('blacken');
         }
      }, { offset: '65%' });

    });

    $("#show-box-purchase").click(function(){
    $("#box-purchase").slideToggle();
});
</script>
<?php   }
add_action('wp_footer', 'javascript_functions', 20);

function display_issue_cover() {
// Display the cover in the sidebar
  $issue_title_id = get_latest_issue_id();
  $size = "category-thumb"; // (thumbnail, medium, large, full or custom size)
  $cover_image = get_the_post_thumbnail($issue_title_id, $size, array('class' => 'alignleftt'));

  $permalink = get_permalink( $issue_title_id );

  echo '<a href="' .$permalink. '">';
  echo $cover_image;
  echo '</a>';

}


function issue_style() {
  $issue_title_id = get_latest_issue_id();
  $issue_cover = get_field('issue_color',$issue_title_id );
  ?>
<style type="text/css">
.splash .splash-subhead, .btn-subscribe-issue, .issue-color {
  color: <?php echo $issue_cover ?>;
}
.btn-subscribe-issue {
  width: 120px;
  border: 1px solid <?php echo $issue_cover ?>;
  /*background-color: <?php echo $issue_cover ?>;*/
}
a:hover .btn-subscribe-issue {
  background-color: #FFF;
  color: #000;
}
  img.alignright, .alignright, .alignright img {float:right; margin:0 0 1em 1.5em;}
  img.alignleft, .alignleft, .alignleft img {float:left; margin:0 1em 1em 0;}
  img.aligncenter, .aligncenter img {display: block; margin-left: auto; margin-right: auto;}
  a img.alignright {float:right; margin:0 0 1em 1em;}
  a img.alignleft {float:left; margin:0 1em 1em 0;}
  a img.aligncenter {display: block; margin-left: auto; margin-right: auto;}

</style>
<?php }
add_action('wp_head', 'issue_style');

function wp_image_styles(){ ?>
<style type="text/css">

</style>
<?php }
add_action('wp_head', 'wp_image_styles');






function sm_change_post_qty( $query ) {
    if ( is_home() ) {
        //Display only 1 post for the original blog archive
        $query->query_vars['posts_per_page'] = 1;
        return;
    }
    if ( is_post_type_archive() || is_tax() ){
        //Display 50 posts for a custom post type called 'movie'
        $query->query_vars['posts_per_page'] = 51;
        return;
    }
}
add_action('pre_get_posts', 'sm_change_post_qty', 1);


function purchase_info($content) {
  if ( 'sm_issues' == get_post_type() ) {

      $issue_price_print = get_field("issue_price_print", "option");
      $issue_price_ebook = get_field("issue_price_ebook", "option");
      $issue_shipping_charge = get_field("issue_shipping_charge", "option");
      $issue_shipping_charge_intl = get_field("issue_shipping_charge_intl", "option");

      $issue_title = get_the_title($post->ID);
      $issue_no = get_field('issue_no');
      $issue_volume = get_field('issue_volume');
      $paypal_acct_email_address = get_field('paypal_acct_email_address', 'option');

      $isbn = get_field('isbn13');
      $gumroad_embed = get_field('gumroad_embed');
      $content.='<div class="box-upper-right"><h6><a href="javascript:void(0)" id="show-box-purchase">purchase options</a></h6><div style="display:none" id="box-purchase">';
      if($isbn) {
          $isbn_13_converted = ISBN13toISBN10($isbn); //for Amazon - this conversion can be found in functions.php

          // AMAZON
          //$content.= '<span><a href="http://www.amazon.com/dp/' .$isbn_13_converted . ' " class="btn btn-default btn-sm">Kindle/print via Amazon</a></span>';
        } //if isbn

          //EPUB PAYPAL
          $content_do_not_show.='<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="paypal"><input type="hidden" value="http://www.theliteraryreview.org.php54-1.dfw1-1.websitetestlink.com/?ACT=20" name="notify_url" /> <input type="hidden" value="http://www.theliteraryreview.org.php54-1.dfw1-1.websitetestlink.com/thank-you/" name="return" /><input type="hidden" value="http://www.theliteraryreview.org.php54-1.dfw1-1.websitetestlink.com/canceled-order/ ‎" name="cancel_return" /><input type="hidden" name="business" value="'.$paypal_acct_email_address.'" /><input type="hidden" name="item_name" value="Issue: '. $issue_title .' (electronic edition)" /><input type="hidden" name="item_number" value="(' .$issue_volume. '-' .$issue_no.')" /><input type="hidden" name="amount" value="'.$issue_price_ebook.'" /><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="add" value="1" /><input type="hidden" name="no_note" value="1" /><input type="hidden" name="no_shipping" value="2" /><input type="hidden" name="shipping" value="0.00" /><input type="hidden" name="shipping2" value="" /><input type="hidden" name="cmd" value="_cart"><input type="submit" class="btn btn-primary btn-sm" name="submit" border="0" alt="Buy now safely through PayPal" value="Epub via PayPal: $'.$issue_price_ebook.'"></form>';


            //PRINT PAYPAL
           $content.='<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="paypal"><input type="hidden" value="http://www.theliteraryreview.org/?ACT=20" name="notify_url" /> <input type="hidden" value="http://www.theliteraryreview.org/thank-you/" name="return" /><input type="hidden" value="http://www.theliteraryreview.org/canceled-order/ ‎" name="cancel_return" /><input type="hidden" name="business" value="'.$paypal_acct_email_address.'" /><input type="hidden" name="item_name" value="Issue: '. $issue_title .' (print edition)" /><input type="hidden" name="item_number" value="(' .$issue_volume. '-' .$issue_no.')" /><input type="hidden" name="amount" value="'.$issue_price_print.'" /><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="add" value="1" /><input type="hidden" name="no_note" value="1" /><input type="hidden" name="no_shipping" value="2" /><input type="hidden" name="shipping" value="'.$issue_shipping_charge.'" /><input type="hidden" name="shipping2" value="" /><input type="hidden" name="cmd" value="_cart"><input type="submit" class="btn btn-primary btn-sm" name="submit" border="0" alt="Buy now safely through PayPal" value="Print edition via PayPal: $'.$issue_price_print.'"></form>';

            //INTERNATIONAL
          $content.='<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="paypal"><input type="hidden" value="http://www.theliteraryreview.org/?ACT=20" name="notify_url" /> <input type="hidden" value="http://www.theliteraryreview.org/thank-you/" name="return" /><input type="hidden" value="http://www.theliteraryreview.org/canceled-order/ ‎" name="cancel_return" /><input type="hidden" name="business" value="'.$paypal_acct_email_address.'" /><input type="hidden" name="item_name" value="Issue: '. $issue_title .' (print edition)" /><input type="hidden" name="item_number" value="(' .$issue_volume. '-' .$issue_no.')" /><input type="hidden" name="amount" value="'.$issue_price_print.'" /><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="add" value="1" /><input type="hidden" name="no_note" value="1" /><input type="hidden" name="no_shipping" value="2" /><input type="hidden" name="shipping" value="'.$issue_shipping_charge_intl.'" /><input type="hidden" name="shipping2" value="" /><input type="hidden" name="cmd" value="_cart"><input type="submit" style="border-color:#FFF;font-size:70%;line-height:1;margin-bottom:0;padding-left:0;" class="btn btn-default btn-sm" name="submit" border="0" alt="Buy now safely through PayPal" value="Non-U.S. readers click here to purchase via Paypal"></form>';

          $content.= '<hr>' . $gumroad_embed;

          $content.='</div></div>';

  }//if sm_issues

else {
$content.= "<div class='subscribe'>";

                $content.= "</div>";

}
return $content;

}//function
add_action( 'the_content', 'purchase_info' , 20);

