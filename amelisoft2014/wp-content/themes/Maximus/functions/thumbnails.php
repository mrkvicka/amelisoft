<?php

if (function_exists( 'add_image_size')) {
	add_image_size('thumbnail', 67, 63, true);
	add_image_size('medium', 279, 138, true);
	add_image_size('large', 420, 308, true);
	add_image_size('recent', 260, 125, true);
	add_image_size('home5', 464, 310, true);
	add_image_size('home3', 475, 291, true);
	add_image_size('post',  585, 222, true);
	add_image_size('home2', 633, 370, true);
	add_image_size('home',  928, 370, true);
}

?>