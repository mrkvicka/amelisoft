<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

	<div class="slider_homepage">
	<img src="../wp-content/themes/amelisoft/images/logo_amelisoft_big.png" alt="logo amelisoft">
	<?php putRevSlider( "slider1" ) ?>
	</div>
	<div id="header">

		<div class="col-full">
			<div id="logo">
		    <img src="../wp-content/themes/amelisoft/images/li_logo.png" alt="logo amelisoft">

			</div><!-- /#logo -->

			<div id="navigation" class="fr">

				<?php
if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
	wp_nav_menu( array( 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
} else {
?>
				<ul id="main-nav" class="nav fl">
					<?php
	if ( get_option( 'woo_custom_nav_menu' ) == 'true' ) {
		if ( function_exists( 'woo_custom_navigation_output' ) )
			woo_custom_navigation_output( "name=Woo Menu 1" );

	} else { ?>

						<?php if ( is_page() ) { $highlight = "page_item"; } else { $highlight = "page_item current_page_item"; } ?>
						
						<?php wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' ); ?>

					<?php } ?>
				</ul><!-- /#nav -->
				<?php } ?>
				

			</div><!-- /#navigation -->

		</div><!--/.col-full-->
	</div><!--/#header-->
    <div id="content" class="page col-full">
		<div id="main" class="fullwidth">
            
		<?php if ( $woo_options['woo_breadcrumbs_show'] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?>  

            <?php if ( have_posts() ) { $count = 0; ?>
            <?php while ( have_posts() ) { the_post(); $count++; ?>
                                                                        
                <div>

				   
                    
                    <div class="entry">
	                	<?php the_content(); ?>
						
	               	</div><!-- /.entry -->

					

                </div><!-- /.post -->
                                                    
			<?php
					} // End WHILE Loop
				} else {
			?>
				<div <?php post_class(); ?>>
                	<p></p>
                </div><!-- /.post -->
            <?php } ?>  
        
		</div><!-- /#main -->
		
    </div><!-- /#content -->

    <!--blok1 start-->
	<div class="homepage_blok entry">
		<div class="page col-full">
			<div class="icon_homepage " style="float: left; width: 20%; vertical-align: middle; text-align: center;">
				<img class="size-thumbnail wp-image-30 alignleft" alt="icon_amelisoft" src="../wp-content/themes/amelisoft/images/icon_amelisoft.png" width="150" height="150" />
			</div>
			<div style="float: right; width: 70%;">
				<h1>Amelisoft</h1>
				<p>Jsme tu pro Vás již dva roky. Navrhujeme řešení, která fungují. Staneme se Vaším partnerem, který ví, jak pokračovat dál. Jsme připraveni vyjít vstříc Vašim požadavkům a zajistit Vám úplný servis od analýzy požadavků, přes návrh řešení, implementaci, testování až po dlouhodobou údržbu produktu.
				</p>
				<a class="amelisoft_button" href="#">více</a>

			</div>
		</div>
	</div>
	<!--blok1 end-->


    <!--blok2 start-->
	<div id="ovladame" class="homepage_blok homepage_yellow entry">
		<div class="page col-full">
			<div class="icon_homepage" style="float: left; width: 20%; vertical-align: middle; text-align: center;">
				<img class="size-thumbnail wp-image-30 alignleft" alt="icon_amelisoft" src="../wp-content/themes/amelisoft/images/icon_skill.png" width="150" height="150" />
			</div>
			<div style="float: right; width: 70%;">
				<h1>Ovládáme</h1>
				<p>Naše dovednosti neustále zvyšujeme. Do každého projektu vkládáme maximum know-how a kreativity.
				Úspěch našich realizací zakládáme na precizní grafice, bezchybné funkčnosti a marketingové podpoře. Díky znalosti pokrokových technologií můžeme nabídnout to nejlepší na trhu.
				</p>
				
				<a class="amelisoft_button" href="#">objednat služby</a>
				
			</div>

		</div>

		
		
			<div id="ca-container" class="ca-container">
				<div class="ca-wrapper">
					<div class="ca-item ca-item-1">
						<div class="ca-item-main">
							<div style="margin-bottom:40px;"><img src="../wp-content/themes/amelisoft/images/icon_web_big.png"></div>
							<h3>Webové prezentace</h3>
							<h4>
								Webové stránky jsou v dnešní době jedním z prvních míst, kde zákazníci hledají informace o Vás nebo Vaší firmě.
							</h4>
								<a href="#" class="ca-more">více</a>
						</div>
						<div class="ca-content-wrapper">
							<div class="ca-content">
								<h6>Webové prezentace</h6>
								<a href="#" class="ca-close">close</a>
								<div class="ca-content-text">
									<p>My vám nabízíme kompletní řešení. Navrhneme a zrealizujeme Vaše webové stránky na profesionální úrovni podle Vašich požadavků a představ. 
									Vždy klademe důraz na přístupnost a použitelnost. Proto navrhujeme webové stránky přizpůsobené pro každé zařízení</p>
								</div>
								<ul>
									<li><a class="amelisoft_button" href="#">Naše práce</a></li>
									<li><a class="amelisoft_button" href="#">Objednat</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="ca-item ca-item-2">
						<div class="ca-item-main">
							<div style="margin-bottom:40px;"><img src="../wp-content/themes/amelisoft/images/icon_shop.png"></div>
							<h3>Internetové obchody</h3>
							<h4>I hold that the more helpless a creature, the more entitled it is to protection by man from the cruelty of man.
							</h4>
								<a href="#" class="ca-more">více</a>
						</div>
						<div class="ca-content-wrapper">
							<div class="ca-content">
								<h6>Would you eat your dog?</h6>
								<a href="#" class="ca-close">close</a>
								<div class="ca-content-text">
									<p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>
									
								</div>
								<ul>
									<li><a class="amelisoft_button" href="#">Naše práce</a></li>
									<li><a class="amelisoft_button" href="#">Objednat</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="ca-item ca-item-3">
						<div class="ca-item-main">
							<div style="margin-bottom:40px;"><img src="../wp-content/themes/amelisoft/images/icon_skill.png" width="150" height="150"></div>
							<h3>Internetový marketing</h3>
							<h4>
								I feel that spiritual progress does demand at some stage that we should cease to kill our fellow 
							</h4>
								<a href="#" class="ca-more">více</a>
						</div>
						<div class="ca-content-wrapper">
							<div class="ca-content">
								<h6>You can change the world</h6>
								<a href="#" class="ca-close">close</a>
								<div class="ca-content-text">
									<p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>
									
								</div>
								<ul>
									<li><a class="amelisoft_button" href="#">Naše práce</a></li>
									<li><a class="amelisoft_button" href="#">Objednat</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="ca-item ca-item-4">
						<div class="ca-item-main">
							<div style="margin-bottom:40px;"><img src="../wp-content/themes/amelisoft/images/icon_app.png" width="150" height="150"></div>
							<h3>Software</h3>
							<h4>
								A man is but the product of his thoughts what he thinks, he becomes.
							</h4>
								<a href="#" class="ca-more">více</a>
						</div>
						<div class="ca-content-wrapper">
							<div class="ca-content">
								<h6>Think globally, act locally</h6>
								<a href="#" class="ca-close">close</a>
								<div class="ca-content-text">
									<p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>
									<
								</div>
								<ul>
									<li><a class="amelisoft_button" href="#">Naše práce</a></li>
									<li><a class="amelisoft_button" href="#">Objednat</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="ca-item ca-item-5">
						<div class="ca-item-main">
							<div style="margin-bottom:40px;"><img src="../wp-content/themes/amelisoft/images/icon_graphic_big.png" width="150" height="150"></div>
							<h3>Grafické práce</h3>
							<h4>
								A weak man is just by accident. A strong but non-violent man is unjust by accident.
							</h4>
								<a href="#" class="ca-more">více</a>
						</div>
						<div class="ca-content-wrapper">
							<div class="ca-content">
								<h6>Animals have rights, too!</h6>
								<a href="#" class="ca-close">close</a>
								<div class="ca-content-text">
									<p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>
									
								</div>
								<ul>
									<li><a class="amelisoft_button" href="#">Naše práce</a></li>
									<li><a class="amelisoft_button" href="#">Objednat</a></li>
								</ul>
							</div>
						</div>
					</div>
					
					
				</div>
			</div>

			
	</div>


		




	<!--blok2 start-->
	<div id="reference" class="homepage_blok homepage_green entry">
		<div class="page col-full">
			<div class="icon_homepage" style="float: left; width: 20%; vertical-align: middle; text-align: center;">
				<img class="size-thumbnail wp-image-30 alignleft" alt="icon_amelisoft" src="../wp-content/themes/amelisoft/images/icon_skill.png" width="150" height="150" />
			</div>
			<div style="float: right; width: 70%;">
				<h1>Reference</h1>
				<p>Od roku 2010 jsme realizovali spoustu úspěšných webů i software a získali spokojené klienty, kteří nám správu webové stránky svěřují dodnes.
				Prohlédněte si ukázky našich realizací a budete-li mít jakýkoliv dotaz, rádi vám je odpovíme.
				</p>
				<a class="amelisoft_button" href="#">naše portfolio</a>

			</div>
		</div>
	</div>
	<!--blok2 end-->
	<!--reference start-->
	<div class="homepage_blok white_blok">
		<div class="page col-full">

			<div style="float: left; width: 20%; vertical-align: middle; text-align: center;">
				<img style="margin-left:30%;margin-top: 30%;" alt="icon_amelisoft" src="../wp-content/themes/amelisoft/images/quote.png" />
			</div>

			<div style="float: right; width: 70%;">
				<div id="ame_slider" class="jquery-slider" style="width: 100%;height: 200px; margin:0 auto;">
					<div class="simple jquery-slider-element">
						<p class="one">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eleifend justo ut accumsan posuere.
						 Morbi vitae ipsum nisi. Nulla in feugiat tortor. Nam porta lectus et nibh ornare sagittis</p>
						 <p><span class="second">Petra Glosr Cvrkalová</span></p>
					</div>
					<div class="simple jquery-slider-element">
						<p class="one">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eleifend justo ut accumsan posuere.
						 Morbi vitae ipsum nisi. Nulla in feugiat tortor. Nam porta lectus et nibh ornare sagittis</p>
						 <p><span class="second">Dana hanusová</span></p>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--reference end-->

<script type="text/javascript">
			$('#ca-container').contentcarousel();
</script>

<script>
    $(window).load(function(){
      $("#header").sticky({ topSpacing: 0 });
    });
</script>

<script>
	$('#ame_slider').slider({autoplay: true, randomize: true});
</script>
		
<?php get_footer(); ?>