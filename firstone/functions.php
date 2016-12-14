<?php 

//==========================================
// Set the content width based on the theme's design and stylesheet.
//==========================================
if ( ! isset( $content_width ) ) 
{
	$content_width = 660;
}

//==========================================
// Include scripts
//==========================================
function firstone_script_enqueue()
{
	// css
	wp_enqueue_style ( 'normalize',			get_template_directory_uri() . '/css/normalize.css', array(), '4.2.0', 'all' );
	wp_enqueue_style ( 'bootstrap',			get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all' );
	wp_enqueue_style ( 'MDB',				get_template_directory_uri() . '/css/mdb.min.css' );
	wp_enqueue_style ( 'font-awesome',		get_template_directory_uri() . '/css/font-awesome.min.css' ); 
	wp_enqueue_style ( 'customstyle',		get_template_directory_uri() . '/css/firstone.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style ( 'customcarousel',	get_template_directory_uri() . '/css/firstone-carousel.css', array(), '1.0.0', 'all' );

	// js
	wp_enqueue_script ( 'jquery' );
	wp_enqueue_script ( 'bootstrapjs',		get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true );
	wp_enqueue_script ( 'Tether',			get_template_directory_uri() . '/js/tether.min.js', array(), '1.0.0', true );
	wp_enqueue_script ( 'MDB',				get_template_directory_uri() . '/js/mdb.min.js', array(), '1.0.0', true );
	wp_enqueue_script ( 'customjs',			get_template_directory_uri() . '/js/firstone.js', array(), '1.0.0', true );
}
add_action ( 'wp_enqueue_scripts', 'firstone_script_enqueue' );

//==========================================
// Activate menus
//==========================================
function firstone_theme_setup()
{
	add_theme_support ( 'menus' );
	
	register_nav_menu ( 'primary', 'Primary Header Navigation' );
	register_nav_menu ( 'secondary', 'Footer Navigation' );
}
add_action ( 'init', 'firstone_theme_setup' );

//==========================================
// Disable background images on mobile devices
//==========================================
function firstone_disable_background_on_mobile()
{
	if ( wp_is_mobile() && ! is_admin() && ! is_customize_preview() )
	{
		remove_theme_support( 'custom-background' );
	}
	else
	{
		add_theme_support( 'custom-background' );
	}
}
add_action ( 'after_setup_theme', 'firstone_disable_background_on_mobile' );

//==========================================
// Theme support function
//==========================================
//add_theme_support ( 'custom-background' );
add_theme_support ( 'custom-header' );
add_theme_support ( 'title-tag' );
add_theme_support ( 'post-thumbnails' );
add_theme_support ( 'automatic-feed-links' );
add_theme_support ( 'post-formats', array('aside','image','video') );
add_theme_support ( 'html5',array('search-form') );
add_theme_support ( 'custom-logo', array('height'		=> 40,
										 'flex-width'	=> true, ));
$defaults = array(
    'default-position-x' => 'left',
    'default-position-y' => 'top',
    'default-attachment' => 'fixed',
);
add_theme_support( 'custom-background', $defaults );

//==========================================
// Filter function
//==========================================
//remove_filter( 'comment_text', 'wpautop', 30 );

// Filter the "read more" excerpt string link to the post.
// @param string $more "Read more" excerpt string.
// @return string (Maybe) modified "read more" excerpt string.
function wpdocs_excerpt_more( $more ) 
{
    return sprintf ( '<a class="read-more fa fa-share" href="%1$s">%2$s</a>', 
					 get_permalink(get_the_ID()), 
					 ' more...' );
}
add_filter ( 'excerpt_more', 'wpdocs_excerpt_more' );

// due to security reasons remove wp version
function firstone_remove_version()
{
	return '';
}
add_filter ( 'the_generator', 'firstone_remove_version' );

// Set default avatar
define ( 'DEFAULT_AVATAR_URL', get_template_directory_uri() . '/img/avatar.jpg' );
function no_gravatars( $avatar ) 
{
	//error_log ( 'no_gravatars()=' . $avatar );
	return preg_replace ( "/http.*?gravatar\.com[^\']*/", DEFAULT_AVATAR_URL, $avatar );
}
//add_filter( 'get_avatar', 'no_gravatars' );

// extend title
function firstone_title_name ( $title, $sep )
{
	return bloginfo('name') . $title;
}
add_filter( 'wp_title', 'firstone_title_name', 10, 2 );

// filter mails
function firstone_mail_filter ( $args ) 
{
	
	$new_wp_mail = array(
		'to'          => $args['to'],
		'subject'     => $args['subject'],
		'message'     => $args['message'],
		'headers'     => $args['headers'],
		'attachments' => $args['attachments'],
	);
	
	return $new_wp_mail;
}
//add_filter ( 'wp_mail', 'firstone_mail_filter' );

//==========================================
// Sidebar function
//==========================================
function firstone_widget_setup()
{
	register_sidebar ( array('name'          => 'Firstone Standard Sidebar', 
							 'id'            => 'sidebar-1',
							 'class'         => 'custome',
							 'description'   => 'Standard Sidebar',
							 'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							 'after_widget'  => '</aside>',
							 'before_title'  => '<h1 class="widget-title">',
							 'after_title'   => '</h1>') );

	register_sidebar ( array('name'          => 'Footer Widgets Left Outside', 
							 'id'            => 'footer-widget-left-outside',
							 'class'         => 'custome',
							 'description'   => 'Footer Left Outside Widgets',
							 'before_widget' => '<aside id="%1$s" class="footer-widget-left %2$s">',
							 'after_widget'  => '</aside>',
							 'before_title'  => '<h1 class="footer-widget-title">',
							 'after_title'   => '</h1>') );

	register_sidebar ( array('name'          => 'Footer Widgets Left Inside', 
							 'id'            => 'footer-widget-left-inside',
							 'class'         => 'custome',
							 'description'   => 'Footer Left Inside Widgets',
							 'before_widget' => '<aside id="%1$s" class="footer-widget-left %2$s">',
							 'after_widget'  => '</aside>',
							 'before_title'  => '<h1 class="footer-widget-title">',
							 'after_title'   => '</h1>') );

	register_sidebar ( array('name'          => 'Footer Widgets Right Inside', 
							 'id'            => 'footer-widget-right-inside',
							 'class'         => 'custome',
							 'description'   => 'Footer Right Inside Widgets',
							 'before_widget' => '<aside id="%1$s" class="footer-widget-right %2$s">',
							 'after_widget'  => '</aside>',
							 'before_title'  => '<h1 class="footer-widget-title">',
							 'after_title'   => '</h1>') );

	register_sidebar ( array('name'          => 'Footer Widgets Right Outside', 
							 'id'            => 'footer-widget-right-outside',
							 'class'         => 'custome',
							 'description'   => 'Footer Right Outside Widgets',
							 'before_widget' => '<aside id="%1$s" class="footer-widget-right %2$s">',
							 'after_widget'  => '</aside>',
							 'before_title'  => '<h1 class="footer-widget-title">',
							 'after_title'   => '</h1>') );
}
add_action ( 'widgets_init', 'firstone_widget_setup' );

//==========================================
// settings page
//==========================================

require 'inc/theme-settings.php';

//==========================================
// utility functions
//==========================================
function is_mobile()
{
    return ( ! wp_is_mobile() && strpos($_SERVER['HTTP_USER_AGENT'], 'Tablet') === false );
}

//==========================================
// create social icon row
//==========================================
function firstone_socialicon_row ( $title, $permalink, $image='', $summary='' )
{
	$string  = '<div class="row social-row">';

	// facebook
	$string .= '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?s=100&p[title]=' . $title;
	//if ( $summary )
	{
		$string .= '&p[summary]=' . $summary;
	}
	$string .= '&p[url]=' . $permalink;
	//if ( $image )
	{
		$string .= '&p[image]=' . $image;
	}
	$string .= '" class="social-media-col col-xs-4 col-sm-2 col-md-2 col-lg-2">';
	$string .= '<span class="social-media-icon"><i class="animated-icon fa fa-facebook"></i></span>';
	$string .= '</a>';

	// twitter
	$string .= '<a target="_blank" href="https://twitter.com/home/?status=' . $title . ' - ' . $permalink . 
			   '" class="social-media-col col-xs-4 col-sm-2 col-md-2 col-lg-2">';
	$string .= '<span class="social-media-icon"><i class="animated-icon fa fa-twitter"></i></span>';
	$string .= '</a>';

	// google+
	$string .= '<a target="_blank" href="https://plus.google.com/share?url=' . $permalink . 
			   '" class="social-media-col col-xs-4 col-sm-2 col-md-2 col-lg-2">';
	$string .= '<span class="social-media-icon"><i class="animated-icon fa fa-google-plus"></i></span>';
	$string .= '</a>';

  // print
  //$string .= '<a href="">';
  //$string .= '<span class="social-media-icon"><i class="fa fa-print"></i></span>';
  //$string .= '</a>';
  
  // email
  //$string .= '<a href="">';
  //$string .= '<span class="social-media-icon"><i class="fa fa-envelope-o"></i></span>';
  //$string .= '</a>';
  
  $string .= '</div>';
  return $string;
}

//==========================================
// returns the blog url
//==========================================
function firstone_get_post_page_url() 
{
	if ( 'page' == get_option('show_on_front') ) 
	{
		return get_permalink(get_option('page_for_posts') );
	} 
	else 
	{
 		return home_url();
 	} 
}

// ==========================================
// Include Walker file
// ==========================================
//require 'inc/walker.php';
 
// ==========================================
// Return the name of a given file name
// ==========================================
function firstone_get_name ( $filename, $check_geo=false )
{
	$name = substr($filename,0,strpos($filename,"."));
	if ( $check_geo && strpos($name,"@") )
	{
		$name = substr($name,0,strpos($name,"@"));
	}
	return $name;
}

// ==========================================
// Return the geo location or -1
// ==========================================
function firstone_get_geo ( $name )
{
	if ( strpos($name,"@") )
	{
		$location = substr($name,strpos($name,"@")+1);
	}
	else
	{
		$location = false;
	}
	return $location;
}

//
// return the google map link for the given coordinates
// http://maps.google.com/?q=<lat>,<lng>
//
function firstone_get_google_link ( $coordinates )
{
	if ( $coordinates )
	{
		return 'http://maps.google.com/?q=' . str_replace('p','.',$coordinates);
	}
	return 'undefined';
}

// ==========================================
// Handle comments
// ==========================================
function firstone_theme_comment ( $comment, $args, $depth ) 
{
	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="fo-comment-block" style="margin-left: <?php echo (($depth-1)*1.5)?>em; 
	<?php if($depth>1) : ?> border-left: 1px solid gray;<?php endif; ?>">

		<div class="fo-comment-timestamp">
			<small>
				<span class="glyphicon glyphicon-calendar"></span><?php echo get_comment_date('M j, Y'); ?> &nbsp;
				<span class="glyphicon glyphicon-time"></span><?php echo get_comment_time('H:i'); ?> &nbsp;
				<?php if ( current_user_can('administrator') && $args['editable']==true ) : ?>
					<span class="glyphicon glyphicon-edit"></span><?php edit_comment_link('Edit') ?>
				<?php endif;?>
			</small>
		</div>

		<div class="fo-avatar-row">
			<?php echo get_avatar($comment,$size='48'); ?>
			<?php printf('<cite>%s</cite> <span>says:</span>', get_comment_author()) ?>
		</div>

		<?php if ($comment->comment_approved == '0') : ?>
			<div class="fo-comment-waiting">Your comment is awaiting moderation.</div>
		<?php endif; ?>

		<div class="fo-comment-content"><?php comment_text() ?></div>
		
		<div>
			<?php if($args['editable']==true) comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>

	</div>
	<?php
}

// ==========================================
// Set container background to transparent 
// when background image set
// style="<?php if (get_background_image()) : background:rgba(0,0,0,0.2);<?php endif;"
// ==========================================
function firstone_background()
{
	?>
	style="background:rgba(0,0,0,0.2);"
	<?php
}

// ==========================================
// Set banner background to transparent 
// when background image set
// style="<?php if (get_background_image()) : background:rgba(0,0,0,0.2);<?php endif;"
// ==========================================
function firstone_banner_background()
{
	?>
	style="<?php if (get_background_image()) : opacity:0.2; endif;?>"
	<?php
}

//
// info shown on top of every blog entry
//
function firstone_blog_info_header ( $comments )
{
	?>
	<small class="blog-timestamp">
	<span class="blog-header"><span class="glyphicon glyphicon-calendar"></span><?php the_time('M j, Y'); ?></span>
	<span class="blog-header"><span class="glyphicon glyphicon-time"></span><?php the_time('H:i'); ?></span>
	<?php if ( current_user_can('administrator') ) : ?>
		<span class="blog-header"><span class="glyphicon glyphicon-edit"></span><?php edit_post_link('Edit'); ?></span>
	<?php endif;?>
	<?php if ( get_the_tags() ) : ?>
		<span class="blog-header"><span class="glyphicon glyphicon-tags blog-tags"></span><?php the_tags(''); ?></span>
	<?php endif;?>
	<span class="blog-header"><span class="glyphicon glyphicon-comment blog-comments"></span><?php echo sizeof($comments); ?></span>
	</small>
	<?php
}