# awesome-works
A Wordpress plugin for managing work. The plugin can be classified according to work types.

Install the plugin using Wordpress.

After installing a new Post type will be created. Also that post type will have custom Work Type taxonomy.

This Work type taxonomy behaves just like the Category taxonomy,but is very specific to the custom post called Work.

You can use the shortcode,'awesome', for displaying the Works in an organised manner.

You can either put the shortode in the content of the post,or you can write it directly inside a theme file as given below,

<?php
	echo do_shortcode('[awesome]');
?>


