<?php 

add_action('init', 'codexin_shortcodes');

function codexin_shortcodes() {

	$shortcodes = array(
		'cx_spacer',
		'cx_get_section',
		'cx_sec_title',
		'cx_icap',
		'CX_PRIVATE',
		'cx_img_series',
		'cx_service',
		'cx_lead_text',
		'cx_img_popup',
		'cx_blockquote',
		'cx_button',
		'cx_divider',
		'cx_recent_posts',
		'cx_recent_posts_small',
		'cx_animated_counters',
		'cx_team_section',
		'cx_client_slider',
		'cx_ceo_message',
		'cx_fancy_buttons',
		'cx_about_us',
		'cx_single_service',
		'cx_featured_business',
		'cx_cta_section',
		'cx_portfolio',
		'cx_team_section_2',
		'cx_support_section',
		'cx_counter',
		'cx_testimonial_1',
		'cx_single_member',
		'cx_pricing'
	);



	foreach ( $shortcodes as $shortcode ) :
		add_shortcode( $shortcode, $shortcode . '_shortcode' );
	endforeach;

}




/*  
* Syntax:
* [cx_spacer size="50"]
*
*/
function cx_spacer_shortcode ( $atts ) {
	$atts = shortcode_atts( array(
		'size' => '30',
	), $atts, 'spacer' );
	return '<div class="spacer" style="height:' . $atts['size'] . 'px; clear:both;overflow: hidden; width:100%;display: block"></div>';
} 




/*  
* Syntax:
* [get_section id="12"]
*
*/
function cx_get_section_shortcode ( $page ) {
	$page = shortcode_atts( array( 
		'id' => FALSE 
	), $page, 'get_section' );
	if ( $page['id'] !== FALSE ) :
		$page_data = @get_page( $page['id'] );
		if ( $page_data ) :
			return do_shortcode( $page_data->post_content );
		else :
			return "PAGE DOES NOT EXIST";	
		endif;
	else :
		return "PAGE ID NOT SET";
	endif;
} 




/*  
* Syntax:
* [cx_sec_title align="left" mg_bottom="50px"] Sample Title [/cx_section_title]
*
*/
function cx_sec_title_shortcode( $atts, $content = null) {
		extract(shortcode_atts(array(
			'align' => 'left',
			'mg_bottom' => '30px',
			'type'    => '1',
			'color' => ''
		), $atts));

		$result = '';
		ob_start(); 
		?>

		<?php if($type == 1):  ?>
			<h2 class="primary-title" style="color: <?php echo $color; ?>;text-align: <?php echo $align; ?>; margin-bottom: <?php echo $mg_bottom; ?>"><?php echo $content; ?></h2>	

		<?php elseif($type == 2): ?>
			<h2 class="cx-title-2" style="color: <?php echo $color; ?>;text-align: <?php echo $align; ?>; margin-bottom: <?php echo $mg_bottom; ?>"><?php echo $content; ?></h2>
		<?php elseif($type == 3): ?>
			<h2 class="cx-title-3" style="color: <?php echo $color; ?>;text-align: <?php echo $align; ?>; margin-bottom: <?php echo $mg_bottom; ?>"><?php echo $content; ?></h2>

		<?php elseif($type == 4): ?>	

			<div class="cx-title-wrapper"><h2 class="cx-sec-title-4"><?php echo $content; ?></h2></div>

		<?php else: ?>
			<h2 class="primary-title" style="color: <?php echo $color; ?>;text-align: <?php echo $align; ?>; margin-bottom: <?php echo $mg_bottom; ?>"><?php echo $content; ?></h2>

		<?php endif;  ?>	
		<?php
		$result .= ob_get_clean();
		return $result;
}







function CX_PRIVATE_shortcode ( $atts, $content = null ) {
	# Returns absolutely nothing. 
	# This shortcode is used for internal comments.
	return; 
} 



/*  
* Syntax:
* [cx_img_series source1="http://placehold.it/800X533" source2="http://placehold.it/800X533" source3="http://placehold.it/800X533"] 
*
*/
function cx_img_series_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	      'source1' => 'http://placehold.it/800X533',
	      'source2' => 'http://placehold.it/800X533',
	      'source3' => 'http://placehold.it/800X533',
	   ), $atts));

	   $result = '';
	   ob_start();
	   ?>
	
	<div class="image-series">
		<div class="row">
			<div class="col-sm-4">
				<a href="<?php echo $source1; ?>" class="mpopup"><img src="<?php echo $source1; ?>" class="img-responsive"></a>
			</div>

			<div class="col-sm-4">
				<a href="<?php echo $source2; ?>" class="mpopup"><img src="<?php echo $source2; ?>" class="img-responsive"></a>
			</div>

			<div class="col-sm-4">
				<a href="<?php echo $source3; ?>" class="mpopup"><img src="<?php echo $source3; ?>" class="img-responsive"></a>
			</div>
		</div>
	</div>

	<?php $result .= ob_get_clean();

	return $result;

}

/*  
* Syntax:
* [cx_service img="http://placehold.it/600X400" link_target="#" link_text="Read More" service_title="Sample Title"]
*
*/
function cx_service_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img'           => 'http://placehold.it/600X400',
	   		'link_target'   => '#',
	   		'link_text'     => 'Read More',
	   		'service_title' => 'Sample Title'
	   ), $atts));

	   $result = '';
	   $img_src = wp_get_attachment_image_src($img);

	   $img_source = $img_src[0];
	   ob_start(); ?>
		
		<div class="single-service-wrapper">
			<a href="<?php echo $link_target; ?>">
				<div class="image-thumb">
					<img src="<?php echo $img_source; ?>" alt="" class="img-responsive">
				</div>
				<div class="service-link"><?php echo $link_text; ?></div>
			</a>

			<div class="service-desc">
				<h3><?php echo $service_title; ?></h3>
			</div>
		</div>
		<?php
		$result .= ob_get_clean();

		return $result;

}



/*  
* Syntax:
* [cx_lead_text first="L" margin_right=""] orem ipsum dolor  [/cx_lead_text]
*
*/
function cx_lead_text_shortcode(  $atts, $content = null) {
	   extract(shortcode_atts(array(
	   			'first' => '',
	   			'margin_right' => '',
	   ), $atts));

	   $result = '';
	   ob_start(); ?>

		<p class="lead"><span class="cx-dropcap-square"  <?php if(!empty($margin_right)): echo 'style="margin-right:'. $margin_right . 'px;"'; endif; ?>><?php echo $first; ?></span><?php echo $content; ?></p>
		<?php
		$result .= ob_get_clean();
		return $result;

}



/*  
* Syntax:
* [cx_img_popup source="" align="" alt="Sample Image" max_width=""]
*
*/
function cx_img_popup_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'source' => 'http://placehold.it/300X200',
	   		'align'  => 'pull-left',
	   		'alt'    => 'Sample Image',
	   		'max_width' => '300px'
	   ), $atts));

	   $result = '';
	   ob_start(); ?>

		<a href="<?php echo $source; ?>" class="mpopup <?php echo ' '. $align .' '; ?> thumbnail-img" style="max-width: <?php echo $max_width; ?>">
			<img src="<?php echo $source; ?>" class="img-responsive center-block" alt="<?php echo $alt; ?>">
		</a>
		<?php
		$result .= ob_get_clean();
		return $result;
}

/*  
* Syntax:
* [blockquote align="right" author="Sample Author"]
*
*/
function cx_blockquote_shortcode( $atts, $content =null ) {
	   extract(shortcode_atts(array(
	   	 'author' => 'Sample Author',
	   	 'align'  => ''
	   ), $atts));

	   $result = '';
	   ob_start(); ?>

		<blockquote <?php if($align): echo 'class="blockquote-reverse"'; else: endif; ?>><?php echo do_shortcode($content); ?><?php if($author): ?><footer><?php echo $author; ?></footer><?php  endif; ?></blockquote>
		<?php
		$result .= ob_get_clean();
		return $result;
}

/*  
* Syntax:
* [button width="230px" link="#" target="_blank"] .. [/button]
*
*/
function cx_button_shortcode( $atts, $content =null ) {
	   extract(shortcode_atts(array(
	   		'width' => '220px',
	   		'link' => '#',
	   		'target' => ''
	   ), $atts));

	   $result = '';
	   ob_start(); ?>
		<div class="btn-wrapper">
			<a href="<?php echo $link; ?>" style="width: <?php echo $width; ?>;" target="<?php echo $target; ?>"><?php echo $content; ?></a>
		</div>
		<?php
		$result .= ob_get_clean();
		return $result;
}


/*  
* Syntax:
* [cx_divider margin_top="" margin_bottom="" width=""]
*
*/
function cx_divider_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'margin_top' => '15px',
	   		'margin_bottom' => '15px',
	   		'width' => '100%'
	   ), $atts));

	   $result = '';
	   ob_start(); ?>
	   <div class="divider" style="width:<?php  echo $width; ?>"><hr style="margin-top: <?php  echo $margin_top;?>; margin-bottom: <?php echo $margin_bottom; ?>" /></div>
	   <?php $result .= ob_get_clean();
	   return $result;
}





// Recent Posts

function cx_recent_posts_shortcode ( $atts, $content = null ) {
   extract(shortcode_atts(array(
      'limit' => '5',
     'title' => 'Our Blog Posts',
     'subtitle' => 'Tips & News',
      'cat'   => ''
   ), $atts)); 

   $result = '';
    $result.= '<div class="row">';
        $result.= '<div class="col-md-12">';
            $result.= '<div class="text-center">';
                $result.= '<h2 class="q">'. $title .'</h2>';
                $result.= '<h3 class="a">'.  $subtitle  .'</h3>';
                $result.= '<span class="tgs"></span>';
            $result.= '</div>';
        $result.= '</div>';
    $result.= '</div>';

    $result.=  '<div class="row posts">';
   ?>

	<?php $q = new WP_Query(
	   array( 
	   		'orderby' => 'date', 
	   		'order'   => 'DEC',
	   		'showposts' => $limit, 
	   		'ignore_sticky_posts' => '1',
	   		'post_type' => 'post',
	   		'cat'  => $cat
	   		)
	 );

	// $list = '<h2 style="color: ' . $content_color . '">' . $content . '</h2>'	;

	 if($q->have_posts()):
	 	$i = 0;
	 	//$list .= '<ul class="related-posts">';
	 	while ($q->have_posts()): $q->the_post();
	 		
	 		ob_start();?>
		        <div class="col-sm-6 col-md-4 col-lg-3 wow fadeIn">
		            <div class="item-blog-post">
		                <div class="thumb">
		                    <a href="<?php the_permalink(); ?>" title="Single Image Post" style="background-image:url('<?php the_post_thumbnail_url(); ?>')"></a>
		                    <div class="date">
		                        <div class="bg"></div>
		                        <div class="text">
		                            <span class="d"><?php the_time('j'); ?></span>
		                            <span class="m"><?php the_time('M'); ?></span>
		                        </div>
		                    </div>
		                </div>
		                <!-- /.thumb -->
		                <div class="content">
		                    <h2 class="title">
		                            <a href="<?php the_permalink(); ?>" title="Single Image Post"> <?php echo wp_trim_words( get_the_title(), 4, null ); ?></a>
		                        </h2>
		                    <div class="excerpt">
		                        
		                        <?php echo wp_trim_words( get_the_excerpt(), 15, null ); ?>
		                    </div>
		                    <a href="<?php the_permalink(); ?>" class="readmore" title="Read More">Read More &raquo;</a>
		                </div>
		                <!-- /.content -->
		            </div>
		            <!-- /.post -->
		        </div>

		        <?php $i++; if($i == 2): echo '<div class="clearfix visible-sm-block"></div>';  endif; ?>

	 		<?php $result .= ob_get_clean();
	 	endwhile;
	 	wp_reset_query();
	 endif;

	 return $result.= '</div>';

}




function cx_recent_posts_small_shortcode ( $atts, $content = null ) {
   extract(shortcode_atts(array(
		'limit' => '3',
		'cat'   => ''
   ), $atts)); 

   $result = '';

   ?>

	<?php $q = new WP_Query(
	   array( 
	   		'orderby' => 'date', 
	   		'order'   => 'DEC',
	   		'showposts' => $limit, 
	   		'ignore_sticky_posts' => '1',
	   		'post_type' => 'post',
	   		'cat'  => $cat
	   		)
	 );


	$result .= '<ul>';

	 if($q->have_posts()):
	 	//$list .= '<ul class="related-posts">';
	 	while ($q->have_posts()): $q->the_post();
	 		ob_start();?>

				    <li>
				        <div class="thumb">
				            <a href="<?php the_permalink(); ?>"><img alt="" src="<?php the_post_thumbnail_url(); ?>" height="60" width="60"></a>
				        </div>
				        <div class="text">
				            <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 3, null ); ?></a>
				            <span class="post-date"><?php the_time('M j') ?> - <?php the_time('Y') ?></span>
				        </div>
				    </li>

	 		<?php $result .= ob_get_clean();
	 	endwhile;


	 	wp_reset_query();
	 endif;

	 return $result.= '</ul>'; ?>


<?php

} // recent_posts_small_shortcode ( $atts )


// Animated Counters

function cx_animated_counters_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(

	   ), $atts));

	   global $codexin;

	   $first_title = $codexin['first-counter-title'];
	   $second_title = $codexin['secound-counter-title'];
	   $third_title = $codexin['third-counter-title'];
	   $fourth_title = $codexin['fourth-counter-title'];
	   

	   $first_number = $codexin['first-counter-number'];
	   $second_number = $codexin['secound-counter-number'];
	   $third_number = $codexin['third-counter-number'];
	   $fourth_number = $codexin['fourth-counter-number'];


	   $counter_bg = $codexin['codexin-animated-counter']['url'];

	   $result = '';
	   ob_start(); ?>
	   
		<div id="achievement-counters" class="achievement-counters pad-tb-100">
			<div class="container">
			    <div class="row">
			        <div class="col-xs-12 wow fadeIn">
			            <div class="project">
			                
			                <span class="counter"><?php echo $first_number; ?></span>
			                <p><?php echo $first_title; ?></p>
			            </div>

			            <div class="project">
			                 
			                <span class="counter"><?php echo $second_number; ?></span>
			                <p><?php echo $second_title; ?></p>
			            </div>

			            <div class="project">
			                
			                <span class="counter"><?php echo $third_number; ?></span>
			                <p><?php echo $third_title; ?></p>
			            </div>

			            <div class="project">
			                

			                <span class="counter"><?php echo $fourth_number; ?></span>
			                <p><?php echo $fourth_title;  ?></p>
			            </div>
			        </div>
			        <!-- end of col -->
			    </div>
			    <!-- end of row -->
			</div>
			<!-- end of container -->
		</div>



	   <?php $result .= ob_get_clean();
	   return $result;
}


/*  
* Syntax:
* [team_section]
*
*/
function cx_team_section_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(

	   ), $atts));

	   $result = '';
	   ob_start();  ?>

	<section id="team" class="team pt-100 pb-100">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">

	                  <?php 

					   global $codexin;
					   $title = $codexin['codexin-team-title'];
					   $team_desc = $codexin['codexin-short-description'];

	                    $args = array (
	                            'post_type' => 'team',
	                            'posts_per_page' => -1);

	                    $loop = new WP_Query($args);

	                   ?>

						<?php
						if ( $loop->have_posts() ) : ?>

					        <div class="row text-center wow fadeIn">
					            <h2 class="q below" style="margin-bottom: 70px;"><?php echo $title;  ?></h2>
					            <div class="col-md-10 col-md-offset-1">
					                <p style="margin-bottom:20px"><?php echo $team_desc; ?></p>
					            </div>
					        </div>
					        <div class="mgc-experts">
								<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

									<?php $desig = get_post_meta( get_the_ID(), '_codexin_team_member_designation', true ); ?>


									<div class="cslick-wrapper">
									    <div class="team-single">
									    	<a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?php if(has_post_thumbnail()): the_post_thumbnail_url(); else: echo 'http://placehold.it/300X372'; endif; ?>" alt="Team" /></a>
									        <div class="single-team-wrapper">
									            <div class="team-social">
									                <a href="<?php the_permalink(); ?>">View Biography</a>
									            </div>
									        </div>
									    </div>
									    <div class="team-description text-center">
									        <p id><?php the_title(); ?></p>
									        <p id><?php echo $desig; ?></p>
									    </div>
									</div>

									
								<?php
								endwhile; ?>

					        </div>


						<?php else :

							get_template_part( 'template-parts/content', 'none' );

						endif; 
						wp_reset_query(); ?>
				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</section>
	   


	   <?php $result .= ob_get_clean();
	   return $result;
}


/*  
* Syntax:
* [client_slider]
*
*/
function cx_client_slider_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(

	   ), $atts));

	   $result = '';
	   ob_start(); 

						
		$args = array(
			'post_type'	=> 'clients',
			'posts_per_page' => -1,
			);

		$loop = new WP_Query( $args ); ?>

		<?php	if ( $loop->have_posts() ) : ?>

	    <div class="clients">
	        <div class="container">
	            <div class="client-list">

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php //$url = get_post_meta( get_the_ID(), '_codexin_client_logo_url', true ); ?>
					<?php $url = rwmb_meta('codexin_clients_surl', 'type=text'); ?>

	                <div class="item">
	                    <a href="<?php echo $url ?>" target="_blank"><img src="<?php  the_post_thumbnail_url(); ?>" /></a>
	                </div>


			<?php endwhile; endif;
			wp_reset_query(); ?>

	            </div>
	        </div>
	    </div>

	   <?php $result .= ob_get_clean();
	   return $result;
}

/*  
* Syntax:
* [cx_ceo_message name="Marnée Morgan" image="http://placehold.it/200X200" heading="A message from our ceo"] .... [/ceo_message]
*
*/

function cx_ceo_message_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'heading'  => 'A message from our ceo',
	   		'image'  => 'http://placehold.it/200X200',
	   		'name'   => 'Marnée Morgan'

	   ), $atts));

	   $result = '';
	   ob_start(); 
	   ?>

		<div class="container">
		    <div class="row text-center">
		        <div class="col-xs-12 col-sm-8 col-sm-offset-2 wow fadeIn">
		            <div class="cx-ceo-message">
		                <h2 class="q below"><?php echo $heading; ?></h2>
		                <img src="<?php echo $image;  ?>" alt="">
		                <div class="message-desc">
		                    <p id><?php echo $content; ?></p>
		                    <p class="author">- <?php echo $name; ?></p>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>



		<?php
		$result .= ob_get_clean();
		return $result;
}


/*  
* Syntax:
* [cx_fancy_buttons button_txt="" target="" href="" type=""]
*
*/

function cx_fancy_buttons_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'button_txt'  => 'Read More',
	   		'target'  => '_self',
	   		'href'   => '#',
	   		'type'   => '1'

	   ), $atts));

	   $result = '';
	   ob_start(); 
	   ?>

		<?php if($type == 1): ?>
			<a class="cx_btn cx_centerSwipe" href="<?php echo $href; ?>" target="<?php echo $target; ?>">
			  	<span><?php echo $button_txt; ?></span>
			</a>
		<?php elseif($type == 2): ?>	
			<a class="cx_btn cx_centerSwipe cx_skewSwipe" href="<?php echo $href; ?>" target="<?php echo $target; ?>">
			  <span><?php echo $button_txt; ?></span>
			</a>

		<?php elseif($type == 3): ?>	
			<div class="cx_btn_3_wrapper">
				<a class="cx_btn_3"  href="<?php echo $href; ?>" target="<?php echo $target; ?>">
					<span><?php echo $button_txt; ?></span><em></em>
				</a>
			</div>

		<?php elseif($type == 4): ?>	
			<div class="cx_btn_4">
				<a href="<?php echo $href; ?>" target="<?php echo $target; ?>"><?php echo $button_txt; ?></a>
			</div>

		<?php else: echo 'Button type not exists'; ?>	

		<?php endif; ?>	

		<?php
		$result .= ob_get_clean();
		return $result;
}



function cx_about_us_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'headline'  => 'Who we are',
	   		'sub_heading'  => 'Lorem Ipsum demo',
	   		'image'  => 'http://placehold.it/600X400',
	   		'btn_text' => 'Read More',
	   		'link_target' => '#'

	   ), $atts));

	   $result = '';
	   $img_src = wp_get_attachment_image_src($image, 'full');

	   $img_source = $img_src[0];
	   ob_start(); 
	   ?>

		<div class="flex-wrapper">
			<div class="col-md-8 col-sm-7" style="visibility: visible; animation-name: fadeIn;">
			<h2 class="cx-title-3">
		        <div id="cx-typed-strings-1">
		            <p><?php echo $headline; ?></p>
		        </div>
		        <span class="cx-element-1"></span>
			</h2>
			<h3 class="cx-subtitle-3"><?php echo $sub_heading; ?></h3>
			<div class="text" style="margin-bottom: 30px;">
				<?php echo do_shortcode($content); ?>
			</div>

			<a class="cx_btn cx_centerSwipe cx_skewSwipe" href="<?php echo $link_target ?>">
			  <span><?php echo $btn_text; ?></span>
			</a>

			</div>
			<div class="col-md-4 col-sm-5" style="visibility: visible; animation-name: fadeIn;"><img class="img-responsive pull-right" src="<?php echo $img_source;  ?>" alt=""></div>
		</div>



		<?php
		$result .= ob_get_clean();
		return $result;
}



function cx_single_service_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'image' => 'http://placehold.it/300X200',
	   		'title' => 'Sample Title',
	   		'icon'=> '',
	   		'link' => '#'


	   ), $atts));

	   $result = '';

	   $img_src1 = wp_get_attachment_image_src($image, 'full');

	   $img_source1 = $img_src1[0];

	   $img_src2 = wp_get_attachment_image_src($icon, 'full');

	   $img_source2 = $img_src2[0];
	   ob_start(); 
	   ?>

		<aside class="services-plans">
		    <figure><a href="<?php echo $link; ?>"><img src="<?php echo $img_source1; ?>" alt=""></a></figure>
		    <div class="service-innerbox">
		        <div class="icon-holder BlueBg effect-helix in" data-effect="helix" style="transition: all 0.7s ease-in-out;"><a href="<?php echo $link; ?>"><span><img src="<?php echo $img_source2; ?>"" alt=""></span></a></div>
		        <h4><?php echo $title; ?></h4>
		        <p><?php echo $content; ?></p>
		        <!--service-innerbox-->
		    </div>
		    <!--services-plans-->
		</aside>


		<?php
		$result .= ob_get_clean();
		return $result;
}

function cx_featured_business_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'image' => 'http://placehold.it/800X533',
	   		'big_heading' => '',
	   		'headline' => '',
	   		'btn_text' =>'',
	   		'link_target' => '#'

	   ), $atts));

	   $result = '';

	   $img_src1 = wp_get_attachment_image_src($image, 'full');
	   $img_source1 = $img_src1[0];
	   ob_start(); 
	   ?>

        <div class="featured-business flex-wrapper">
          <div class="text-center col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="logo-backgrounds">
                  <figure class="business-meeting-img"><img src="<?php echo $img_source1; ?>" alt=""></figure>
                  <!--logo-background-->
              </div>
              <!--text-center-->
          </div>
          <div class="business-box col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <h1 class="cx-title-3"><?php echo $big_heading; ?></h1>
              <h2 class="black-font"><?php echo $headline; ?></h2>
			  <?php echo $content; ?>

				<a class="cx_btn cx_centerSwipe cx_skewSwipe" href="<?php echo $link_target ?>">
				  <span><?php echo $btn_text; ?></span>
				</a>
              <!--business-box-->
          </div>
        </div>



		<?php
		$result .= ob_get_clean();
		return $result;
}



function cx_cta_section_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'title' => '',
	   		'subtitle' => '',
	   		'btn_text1' => '',
	   		'btn_text2' => '',
	   		'link_target1' => '',
	   		'link_target2' => '',
	   		'image' => 'http://placehold.it'

	   ), $atts));

	   $result = '';

	   $img_src1 = wp_get_attachment_image_src($image, 'full');
	   $img_source1 = $img_src1[0];
	   ob_start(); 
	   ?>

	    <div id="cx_cta_section" class="section">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12">
	                    <div class="flex-wrapper centered">
						    <div class="column-single first">
						        <h2><?php echo $title; ?></h2>
						        <h4><?php echo $subtitle; ?></h4>
						    </div>

						    <div class="column-single second">
						        <a class="cx_btn cx_centerSwipe cx_skewSwipe" href="<?php echo $link_target1 ?>">
						          <span><?php echo $btn_text1; ?></span>
						        </a>
						    </div>

						    <div class="column-single">
						        <a class="cx_btn cx_centerSwipe cx_skewSwipe" href="<?php echo $link_target2 ?>">
						          <span><?php echo $btn_text2; ?></span>
						        </a>
						    </div>
						</div>
	                </div>
	            </div>
	        </div>
	    </div>


	    <script>
	    jQuery(document).ready(function($){
		    $('#cx_cta_section').parallax({
		        imageSrc: '<?php echo $img_source1; ?>'
		    });

		});    
	    </script>



		<?php
		$result .= ob_get_clean();
		return $result;
}



function cx_portfolio_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(


	   ), $atts));

	   $result = '';

	   ob_start(); 
	   ?>

        <div class="container">                   
            <div class="portfolio-content">
                <div class="portfolio-filter-wrap text-center" >
                    <ul class="portfolio-filter hover-style-one">
                        <li><button data-filter="*" class="cx_filter_btn cx_active"> All</button></li>
		                <?php

		                $taxonomy = 'field';
		                $taxonomies = get_terms($taxonomy); 
		                    foreach ( $taxonomies as $tax ) {
		                        echo '<li><button data-filter=".' .strtolower($tax->name) .'" class="cx_filter_btn" >' . $tax->name . '</button></li>';

		                    }?>
                    </ul>
                </div>
                <div class="portfolio portfolio-gutter portfolio-style-four portfolio-container portfolio-masonry portfolio-column-count-3">

				<?php 

		            $args = array (
		                'post_type' => 'portfolio',
		                'showposts' => 6,
		                'orderby' => 'date',
                    	'order' => 'DESC'
		                );

		            $loop = new WP_Query($args);

		              if( $loop->have_posts() ) :

		              while( $loop->have_posts() ) : $loop->the_post(); 

		                $field_id =  get_the_ID();  

		                $term_list = wp_get_post_terms($field_id, 'field'); ?>

		                    <div class="portfolio-item <?php foreach ($term_list as $sterm) { echo strtolower($sterm->name)." "; } ?>">
		                        <div class="portfolio-item-content">
		                            <div class="item-thumbnail">
		                                <?php the_post_thumbnail('portfolio-small-thumbnail'); ?>                                          
		                                <ul class="portfolio-action-btn">
		                                    <li>
		                                        <a class="venobox" href="<?php the_permalink(); ?>"><i class="fa fa-gg"></i></a>
		                                    </li>
		                                </ul>                                            
		                            </div>
		                            <div class="portfolio-description">
		                                <h4><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h4>
		                                <ul class="portfolio-cat">
			                                <?php 
			                                foreach ($term_list as $sterm) {
			                                    echo '<li>'.$sterm->name.'</li>';
			                                    //echo $sterm->name;
			                                } 

			                                ?>
		                                </ul>
		                            </div>                                    
		                        </div>
		                    </div>
		             <?php endwhile; else : endif; 

		              wp_reset_postdata();  ?>     
                  
                </div>
<!--                 <div class="pagination-area pt-50">
                    <div class="load-more text-center">
                        <a class="btn-medium" href="#">Load More</a>
                    </div>
                </div> -->
            </div>
        </div>


		<?php
		$result .= ob_get_clean();
		return $result;
}


function cx_team_section_2_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'post_shown' => '4',


	   ), $atts));

	   $result = '';
	   ob_start();  ?>

	<section id="team">
		<!-- <div class="container"> -->
			<div class="row">
                    
	                  <?php 
	                    $args = array (
	                            'post_type' => 'team',
	                            'showposts' => $post_shown,
	                            );

	                    $loop = new WP_Query($args);

	                   ?>

						<?php
						if ( $loop->have_posts() ) : ?>
							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
									<div class="col-md-3 col-sm-6">
								<?php //$desig = get_post_meta( get_the_ID(), 'team_member_designation', true ); ?>
								<?php $desig = rwmb_meta('codexin_team_designation', 'type=text'); ?>
								<?php $t_facebook = rwmb_meta('codexin_team_facebook', 'type=text'); ?>
								<?php $t_twitter = rwmb_meta('codexin_team_twitter', 'type=text'); ?>
								<?php $t_linkedin = rwmb_meta('codexin_team_linkedin', 'type=text'); ?>
								<?php $t_ig = rwmb_meta('codexin_team_ig', 'type=text'); ?>

	                        <div class="block block--style-5 z-depth-1-bottom">
	                            <div class="block-image">
	                                <a href="<?php the_permalink(); ?>">
	                                    <img src="<?php if(has_post_thumbnail()): the_post_thumbnail_url('team-single'); else: echo 'http://placehold.it/380X470'; endif; ?>">
	                                </a>
	                            </div>
	                            <div class="block-caption--over text-center">
	                                <h4 class="block-title-upper text-uppercase"><?php echo $desig;  ?></h4>
	                                <h3 class="heading heading-6 strong-600"> <?php echo the_title();  ?></h3>
	                                <ul class="social-media social-media--style-1 social-media-circle mt-1">
	                                		<?php if(!empty($t_facebook)): ?>
		                                    <li>
		                                        <a href="<?php echo $t_facebook; ?>" target="_blank">
		                                            <i class="fa fa-facebook"></i>
		                                        </a>
		                                    </li>
		                                   <?php endif; ?> 

		                                   <?php if(!empty($t_twitter)): ?>
	                                    <li>
	                                        <a href="<?php echo $t_twitter; ?>" target="_blank">
	                                            <i class="fa fa-twitter"></i>
	                                        </a>
	                                    </li>
																				<?php endif; ?> 
	                                    <?php if(!empty($t_ig)): ?>
	                                    <li>
	                                        <a href="<?php echo $t_ig; ?>" target="_blank">
	                                            <i class="fa fa-instagram"></i>
	                                        </a>
	                                    </li>
	                                    <?php endif; ?> 

	                                    <?php if(!empty($t_linkedin)): ?>
	                                    <li>
	                                        <a href="<?php echo $t_linkedin; ?>" target="_blank">
	                                            <i class="fa fa-linkedin"></i>
	                                        </a>
	                                    </li>
	                                    <?php endif; ?> 
	                                </ul>
	                            </div>
	                        </div>

									</div> <!-- end of col -->
						<?php endwhile; else :

							get_template_part( 'template-parts/content', 'none' );

						endif; 
						wp_reset_query(); ?>


			</div> <!-- end of row -->
		<!-- </div> end of container -->
	</section>
	   


	   <?php $result .= ob_get_clean();
	   return $result;
}

/*  
* Syntax:
* [cx_support_section icon_bg="cyan" fa_icon="fa-comments" heading_title="Technocal Support" href="#" link_txt="Get Help"] Sample Title [/cx_support_section]
*
*/

// dropdown =>
// 	icon_bg  => 1. cyan
// 				2. orange
// 				3. blue
// 	fa_icon  => 1. fa-comments
// 				2. fa-list-ol
// 				3. fa-book


function cx_support_section_shortcode( $atts, $content = null) {
		extract(shortcode_atts(array(
			'cx_support_color' 			=> '',
			'fa_icon'			=> 'fa-comments',
			'heading_title'		=> 'Technical Support',
			'href'				=> '#',
			'link_txt'			=> 'Get help'

		), $atts));

		$result = '';
		ob_start(); 
		?>
		
            <div style="<?php echo 'background-color:'.$cx_support_color;?>" class="support_icon_box support_icon_<?php //echo $cx_icon_bg ?>">
                <i class="fa <?php echo $fa_icon ?>"></i>
            </div>
            <div class="support_content_box">
                <h4><?php echo $heading_title ?></h4>
                <p><?php echo $content ?></p>
            </div>
            <div class="support_content_btn">
                <a style="<?php echo 'background-color:'.$cx_support_color;?>" target="_blank" class="support_btn_<?php //echo $cx_icon_bg ?>" href="<?php echo $href ?>"><?php echo $link_txt ?></a>
            </div>



		<?php
		$result .= ob_get_clean();
		return $result;
}





/*  
* Syntax:
* [cx_counter bg_color="" icon="" icon_color="" count_up="" count_color="" txt="" txt_color=""]
*
*/

function cx_counter_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'bg_color'    => '#f6f6f6',
			'icon'        => 'fa-group',
			'icon_color'  => '#d2d2d2',
			'count_up'    => '3,275',
			'count_color' => '#666',
			'txt' 		  => 'Registered Members',
			'txt_color'   => '#909090'

	   ), $atts));


	   $result = '';
	   ob_start(); 
		?>

		<div class="counter-box" style="background: <?php echo $bg_color; ?>">
			<i class="fa <?php echo $icon; ?>" style="color: <?php echo $icon_color; ?>"></i>
			<span class="counter" style="color: <?php echo $count_color; ?>"><?php echo $count_up; ?></span>
			<p style="color: <?php echo $txt_color; ?>"><?php echo $txt; ?></p>
		</div>

		<?php
		$result .= ob_get_clean();
		return $result;
}


/*  
* Syntax:
* [cx_counter bg_color="" icon="" icon_color="" count_up="" count_color="" txt="" txt_color=""]
*
*/

function cx_testimonial_1_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(


	   ), $atts));

	   $result = '';
	   ob_start(); 
		?>

          <?php 
        $args = array (
                'post_type' => 'testimonial',
                'posts_per_page'=> -1
                );

        $loop = new WP_Query($args);

       ?>

        <div class="row">

            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <div class="testimonial-wrapper-1">
                    <div class="testimonials">
					            <?php 
											if ( $loop->have_posts() ) : ?>
												<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>


					                      <div>
					                        <div class="author">
					                        		<img src="http://www.surgeenterprise.com/wp-content/uploads/2017/04/author.png" alt="" class="img-circle">
					                        </div>
					                        <p><?php the_content(); ?></p>
					                        <div class="author">

					                        		<?php $cauthor = rwmb_meta('codexin_author_name', 'type=text'); ?>
					                        		<?php $cdesig = rwmb_meta('codexin_author_designation', 'type=text'); ?>
					                            <p class="authorname"><?php echo $cauthor; ?></p>
					                            <p class="authordesig"><?php echo $cdesig; ?></p>
					                        </div>  
					                      </div> <!-- 1st item -->

					  						<?php endwhile; else :

												get_template_part( 'template-parts/content', 'none' );

												endif; 
												wp_reset_query(); ?>

                    </div>
                </div>
            </div>
        </div>

		<?php
		$result .= ob_get_clean();
		return $result;
}


/*  
* Syntax:
* [cx_single_member team_image="http://www.surgeenterprise.com/wp-content/uploads/2017/04/jenn.jpg"]
*
*/

function cx_single_member_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'team_image'    => '',
	   		'team_name'		=> 'John Doe',
	   		'team_desig'	=> 'CEO',
	   		'fb_url'		=> 'http://facebook.com',
	   		'tw_url'		=> 'http://twitter.com',
	   		'ig_url'		=> 'http://instagram.com'


	   ), $atts));

	    $result = '';

		$img_src1 = wp_get_attachment_image_src($team_image, 'full');
		$img_source1 = $img_src1[0];


	   ob_start(); 
		?>


			<div class="single-member" style="max-width: 370px;">
			    <div class="member-img">
			        <img src="<?php echo $img_source1 ?>" alt="">
			    </div>
			    <div class="member-details">
			        <div class="member-info-wrapper">
			            <h3><a href="#"><?php echo $team_name ?></a></h3>
			            <p><?php echo $team_desig ?></p>
			            <ul class="member-social-links">
			            	<?php if(!empty($fb_url)): ?>
			                	<li><a href="<?php echo $fb_url ?>"><i class="fa fa-facebook"></i></a></li>
			            	<?php endif; ?>
			            	<?php if(!empty($tw_url)): ?>
			                <li><a href="<?php echo $tw_url ?>"><i class="fa fa-twitter"></i></a></li>
			                <?php endif; ?>
			                <?php if(!empty($ig_url)): ?>
			                <li><a href="<?php echo $ig_url ?>"><i class="fa fa-instagram"></i></a></li>
			                <?php endif; ?>
			            </ul>
			        </div>
			    </div>
			</div>


		<?php
		$result .= ob_get_clean();
		return $result;
}



function cx_pricing_shortcode( $atts, $content = null){


	   extract(shortcode_atts(array(
	   		'bg_image' => '',
	   		'price'		=> '$800',
	   		'sub_title'		=> '($133/month for 6 month)',
	   		'type'		=> 'standard',
	   		'btn_link' =>'',
	   		'btn_text' =>'Purchase now',
	   		'target' => '_self'


	   ), $atts));


	   $result = '';

		$img_src1 = wp_get_attachment_image_src($bg_image, 'full');
		$img_source1 = $img_src1[0];
	   ob_start(); 
		?>

	    <div class="cx-price <?php if($type=='pro'): echo ' pro'; elseif($type=='premium'): echo ' premium'; else: endif; ?>">
	        <div class="cx-per-price"  style="background-image: url(<?php echo $img_source1 ;?>);">
	            <h2><?php echo $price;?></h2>
	            <p><?php echo $sub_title; ?></p>
	        </div>


	        <h2 class="cx-quality"><?php echo $type;?></h2>
	        <!-- <ul class="cx-details"> -->
	        	<?php echo $content;?>
	        <!-- </ul> -->
	        <a href="<?php echo $btn_link;?>" target="<?php echo $target; ?>" class="btn btn-default"><?php echo $btn_text;?></a>
	    </div>


		<?php
		$result .= ob_get_clean();
		return $result;
}







