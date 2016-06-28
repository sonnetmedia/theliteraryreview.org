<?php 
	$isbn = get_post_meta($post->ID, 'isbn13', true);
	if($isbn) : 
		$isbn_13_converted = ISBN13toISBN10($isbn); //for Amazon - this conversion can be found in functions.php
  ?>
 <li><a href="http://www.amazon.com/dp/<?php echo $isbn_13_converted; ?>" title="Amazon">Amazon.com</a></li>
<?php endif; ?> 