

			<div class="footer-container">

				<?php if ( ! is_front_page() ) :?>
					<div class="row">

						<div class="footer-widget-container col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix">

							<div class="widgets-area Xadd-border col-xs-12 col-sm-12 col-md-12 col-lg-6 clearfix">
			    				<?php dynamic_sidebar('footer-widget-left-outside') ?>
			    			</div>
							<div class="widgets-area Xadd-border col-xs-12 col-sm-12 col-md-12 col-lg-6 clearfix">
			    				<?php dynamic_sidebar('footer-widget-left-inside') ?>
			    			</div>

		    			</div>

						<div class="footer-widget-container col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix">

							<div class="widgets-area Xadd-border col-xs-12 col-sm-12 col-md-12 col-lg-6 clearfix">
			    				<?php dynamic_sidebar('footer-widget-right-inside') ?>
			    			</div>
							<div class="widgets-area Xadd-border col-xs-12 col-sm-12 col-md-12 col-lg-6 clearfix">
			    				<?php dynamic_sidebar('footer-widget-right-outside') ?>
			    			</div>

		    			</div>

					</div>
				<?php endif;?>

			</div>

			<footer>
				<div class="row footer-row" style="margin: 0;">
					<div class="tech-logo-row col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<?php $logodir = esc_url(get_template_directory_uri()) ?>
						<span class="tech-logo"><img src="<?php echo $logodir ?>/img/tech-logos/html5.png" class="pull-left" width="auto" height="25" alt="HTML5"></span>
						<span class="tech-logo"><img src="<?php echo $logodir ?>/img/tech-logos/css3.png" class="pull-left" width="auto" height="25" alt="CSS3"></span>
						<span class="tech-logo"><img src="<?php echo $logodir ?>/img/tech-logos/bootstrap.png" class="pull-left" width="auto" height="25" alt="Bootstrap"></span>
						<span class="tech-logo"><img src="<?php echo $logodir ?>/img/tech-logos/mysql.png" class="pull-left" width="auto" height="25" alt="MySql"></span>
						<span class="tech-logo"><img src="<?php echo $logodir ?>/img/tech-logos/jquery.png" class="pull-left" width="auto" height="25" alt="jQuery"></span>
						<span class="tech-logo"><img src="<?php echo $logodir ?>/img/tech-logos/wordpress.png" class="pull-left" width="auto" height="25" alt="WordPress"></span>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	
						<p class="footer-credit">by <a href="https://firstonewebdev.com" target="_blank">first one web development</a> <span class="fa fa-copyright"></span> 2016 </p>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<p class="footer-impressum"><a href="<?php echo esc_url(site_url()) ?>/impressum">Impressum</a></p>
					</div>
				</div>
			</footer>

		<?php wp_footer(); ?>
	
	</body>
</html>