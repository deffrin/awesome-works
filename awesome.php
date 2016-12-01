<?php
/*
 Plugin Name: Awesome
*/
  

// deffrin_works is a custom post type

// work_types is the name of taxonomy


function deffrin_works_fn()
{
 	register_post_type('deffrin_works',
 		array(
 			'labels'      => array(
 			'name'          => __('Works'),
 			'singular_name' => __('Work'),
 			),
 		'public'      => true,
 		'has_archive' => true,
			)
 	);
 		
 		$labels = array(
 				'add_new_item'=> __(' Add new work type'),
 				'new_item_name'=> __('New work type'),
 				'search_items'=>__('search')
 		);
 		
 		register_taxonomy( 'work_types', 'deffrin_works',
 				array(  
 						'label'=>'Work Types',
 						'singular_label'    => 'Work Type',
 						'public'            => true,
 						'hierarchical'      => true,
 						'show_ui'           => true,
 						'show_in_nav_menus' => true,
 						'args'              => array( 'orderby' => 'term_order' ),
 						'query_var'         => true,
 						'rewrite'           => array( 'slug' => 'work_types', 'hierarchical' => true)
 						//'labels'=>$labels 
 						
 				));
 		
 		register_taxonomy_for_object_type( 'work_types', 'deffrin_works' );
 		
 }
 
 add_action('init', 'deffrin_works_fn');
 
 add_post_type_support( 'deffrin_works', 'thumbnail' );
 
 function show_work()
 {
 	
 	$posts_array = get_posts(array('post_type'=>'deffrin_works'));
 	
 	//print_r($posts_array);
 	
 	$html="";
 	
 //	print_r($posts_array);
 	
 	$txns = get_terms('work_types');
 
 	$taxonomy_html='<button class="filter" data-filter="all">All Work Types</button> ';
 	foreach ($txns as $txns_val)
 	{
 		
 		$slug_name[$txns_val->slug]=$txns_val->name;
 		
 		//$taxonomy_html.='<button class="filter" data-filter=".'.$txns_val->slug.'">'.$txns_val->name.'</button> ';
 	}
 	
 	
 	$unique_slugs=array();
 	

 	foreach ($posts_array as $row)
 	{
 		
 		$thumb_nail = get_the_post_thumbnail( $row->ID, 'full' );
 		
 		$terms = get_the_terms($row->ID,'work_types');
 		
 		$trm=array();
 		
 		foreach ($terms as $tr)
 		{
 			$trm[]=$tr->slug;
 			$unique_slugs[]=$tr->slug;
 			
 		}
 		
 		$trms=implode(" ",$trm);
 		
 		
// 		$show_terms=
//	".$row->post_title." 

 		$html.="<div class='awesome-post-section mix ".$trms."'> <div class='awesome-post-title'><span>".$row->post_title."</span></div> ".$thumb_nail."</div>";
 		
 	}
 	
 	$unique_slugs=array_unique($unique_slugs);
 	
 	foreach ($unique_slugs as $us)
 	{
 		$taxonomy_html.='<button class="filter" data-filter=".'.$us.'">'.$slug_name[$us].'</button> ';
 	}
 	wp_enqueue_script('mixitup','http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js');
 	wp_enqueue_script('main',plugin_dir_url( __FILE__ ).'awesome-works.js');
 	
 	wp_enqueue_style('roboto','https://fonts.googleapis.com/css?family=Roboto');
 	
 	wp_enqueue_style('awesome-works', plugin_dir_url( __FILE__ ).'awesome-works-theme.css');
 	
 	$out = '<div class="awesome-works-container"><div class="controls">'.$taxonomy_html.'</div>'."<div id='awesome-works-inner-container' >".$html.'<div class="gap"></div><div class="gap"></div>'.
"</div></div>";
 	
 	return  $out;

 
 }
 
 add_shortcode('awesome', 'show_work');
 