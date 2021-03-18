(function($){
   "use strict";	
	//----------> Site Preloader	
	$(window).load(function() {	
         $('#preloader').fadeOut('slow', function(){
			  $(this).remove();
		 }); 
    });	
	$(document).ready(function(){
		var site_dark = ( $("body").hasClass("dark") ? "yes" : "no" );
		var site_dir = "ltr";
		if( $("html").css('direction') == 'rtl' || $("html").attr('dir') == 'rtl') {
			site_dir = "rtl";
		};
		
		//----------> Validation
		if ( $.isFunction($.fn.validate) ) {
			$("#contact-us-form").validate({
				submitHandler: function(contact_form) {
					$('.form_loader').css({ "display": "block"});
					$('#form-messages').css({ "opacity": "0"});
					$(contact_form).ajaxSubmit({
						target: '#form-messages',
						success: function() {
							$('.form_loader').css({ "display": "none"});
							$('#form-messages').css({ "opacity": "1"});
							$('#form-messages').addClass("send_success");
							$('#contact-us-form').find('.form_fill_fields').val('');
						},
						
					});
				}
			});
			
			$("#careers-form").validate({
				submitHandler: function(contact_form) {
					$('.form_loader').css({ "display": "block"});
					$('#form-messages').css({ "opacity": "0"});
					$(contact_form).ajaxSubmit({
						target: '#form-messages',
						success: function() {
							$('.form_loader').css({ "display": "none"});
							$('#form-messages').css({ "opacity": "1"});
							$('#form-messages').addClass("send_success");
							$('#careers-form').find('.form_fill_fields').val('');
						},
						
					});
				}
			});
			
			$("#newsletter_form").validate({
				submitHandler: function(subscribe_mail) {
					$('.newsletter_button').find(".refresh_loader").css({"opacity" : "1"}).siblings("i").css({"opacity" : "0"});
					$('#subscribe_output').slideUp(300);
					$(subscribe_mail).ajaxSubmit({
						target: '#subscribe_output',
						success: function() {
							$('.newsletter_button').find(".subscribe_true").css({"opacity" : "1"}).siblings("i").css({"opacity" : "0"});
							$('#subscribe_output').slideDown(300);
							setTimeout(function() {
								$('#subscribe_output').slideUp(300);
								$('.newsletter_button').find(".subscribe_btn").css({"opacity" : "1"}).siblings("i").css({"opacity" : "0"});
							}, 4000 );
							$('#newsletter_form').find('.subscribe-mail').val('');
						}
					});
				},
			});
		};
		
		$('.sign_up_login_flip').on("click", function(){
			var $this = $(this);
			var $form = $this.closest("form");
			var $form_other = $form.siblings("form");
			$form.removeClass("owl-goDown-in").addClass("owl-goDown-out");
			$form_other.removeClass("flip_top").css({"display" : "block"});
			setTimeout(function() {
				if($form.hasClass("login_flip")){
					$form.removeClass("flip_top").css({"display" : "none"});
				}
				$form_other.removeClass("owl-goDown-out").addClass("owl-goDown-in");
				$form_other.addClass("flip_top");
				
			}, 300 );
			
			return false;
		});
		//----------> Top Bar Expand
		$(".top_expande").on("click", function(){ 
			var $thiss = $(this);
			var $conta = $thiss.siblings(".content");
			if($thiss.hasClass("not_expanded")){
				$($conta).stop().slideDown(300, function(){
					$thiss.removeClass("not_expanded");
				});
			}else{
				$($conta).stop().slideUp(300, function(){
					$thiss.addClass("not_expanded");
				});
			}
		});
		
		$("ul.sitemap li").each(function(index, element) {
            $(this).has( "ul" ).addClass( "has_child_sitmap" );
			if($(this).hasClass("has_child_sitmap")){
				var num_child = $(this).find(" > ul > li").length;
				$(this).append('<span class="sitemap_count">' + num_child +'</span>');
			}
			
        });
		//-----------> Menu
		$("#nav_menu").idealtheme({});
		
		//----------> Owl Start   
		var image_menu_slide =  $(".image_menu_slide");
		var header_on_side = "header_on_side";
		var side_menu_res_a = $("body").hasClass(header_on_side) ? 1 : 4;
		var side_menu_res_b = $("body").hasClass(header_on_side) ? 1 : 5;

		image_menu_slide.owlCarousel({
			 direction: site_dir,
			 autoPlay : 3000,
			 navigation:true,
			 stopOnHover : true,
			 itemsCustom : [
				[0, 2],
				[479, 3],
				[768, 3],
				[979, side_menu_res_a],
				[1199, side_menu_res_b],
			 ],
			 itemsDesktop: false,
			 itemsDesktopSmall: false,
			 itemsTablet: false,
			 itemsTabletSmall: false,
			 itemsMobile: false,
			 navigationText: [
				"<i class='menu_img_prev ico-navigate-before'></i>",
				"<i class='menu_img_next ico-navigate-next'></i>"
			],
		});
		
		$(".has_sub_img").owlCarousel({
			 direction: site_dir,
			 singleItem:true,
			 autoPlay : 3000,
			 itemsDesktop: false,
			 itemsDesktopSmall: false,
			 itemsTablet: false,
			 itemsTabletSmall: false,
			 itemsMobile: false,
			 autoHeight : false,
			 stopOnHover : true,
			 navigation:true,
			 navigationText: [
				"<i class='menu_img_prev ico-caret-left'></i>",
				"<i class='menu_img_next ico-caret-right'></i>"
			],
		});
		
		//=====> OWL Carousel Text Slider
		$(".welcome_banner_slider").owlCarousel({
			direction: site_dir,
			slideSpeed : 400,
			autoPlay : 3000,
			itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			autoHeight : true,
			items:1,
			stopOnHover : true,
			navigation : true,
			navigationText : [
				"<span class='prev_simple'><i class='ico-arrow-back'></i></span>",
				"<span class='next_simple'><i class='ico-arrow-forward'></i></span>"
			],
			pagination : false,
		});
		
		//=====> OWL Carousel Png Slider

		if(site_dir == "ltr"){
			$(".png_slider").owlCarousel({
				direction: site_dir,
				slideSpeed : 900,
				autoPlay : 3000,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				itemsTablet: false,
				itemsTabletSmall: false,
				itemsMobile: false,
				autoHeight : true,
				items:1,
				stopOnHover : true,
				navigation : true,
				navigationText : [
					"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
					"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
				pagination : true,
				transitionStyle : "backSlide"
			});
		}else{
			$(".png_slider").owlCarousel({
				direction: site_dir,
				slideSpeed : 900,
				autoPlay : 3000,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				itemsTablet: false,
				itemsTabletSmall: false,
				itemsMobile: false,
				autoHeight : true,
				items:1,
				stopOnHover : true,
				navigation : true,
				navigationText : [
					"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
					"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
				pagination : true,
				
			});
		}
		
		$(".normal_text_slider").owlCarousel({
			direction: site_dir,
			slideSpeed : 900,
			autoPlay : 3000,
			itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			autoHeight : true,
			items:1,
			stopOnHover : true,
			navigation : true,
			navigationText : [
				"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
				"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
			pagination : false,
		});
		
		$(".our_client_slider").owlCarousel({
			direction: site_dir,
			slideSpeed : 1000,
			autoPlay : 4000,
			itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			itemsCustom : [
				[360, 2],
				[450, 2],
				[786, 3],
				[1200, 5]
			],
			stopOnHover : true,
			navigation : true,
			navigationText : [
				"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
				"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
			pagination : false,
		});
		
		var owl_news = $(".hm_new_bar_slider");
		owl_news.owlCarousel({
			direction: site_dir,
			loop:true,
			autoWidth:true,
			itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			itemsCustom : [
				[0, 1],
				[450, 2],
				[786, 3],
				[1200, 4],
				[1600, 5]
			],
			slideSpeed : 2000,
			autoPlay : 2000,
			stopOnHover : true,
		});
		$('.hm_new_bar_controll_btn').on('click', function(event){
			event.preventDefault();
			if($(this).hasClass('pause')){
				$(this).removeClass("pause").addClass("play");
				owl_news.trigger('owl.play', 2000);
			}else{
				$(this).removeClass("play").addClass("pause");	
				owl_news.trigger('owl.stop', 2000);			
			}
		});
		//--------------------------------------> Shop Sliddes
		var shop_slide_sideboxed_a = 4;
		if( $("body").hasClass("site_boxed") && $("body").hasClass("header_on_side") ){
			 shop_slide_sideboxed_a = 3;
		}
		
		$(".shop_slider").owlCarousel({
			direction: site_dir,
			slideSpeed : 1000,
			autoPlay : 4000,
			autoHeight : true,
			itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			itemsCustom : [
				[0, 1],
				[450, 2],
				[786, 3],
				[1200, shop_slide_sideboxed_a],
				[1600, 5]
			],
			stopOnHover : true,
			navigation : true,
			navigationText : [
				"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
				"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
			pagination : false,
		});
		
		if(site_dir == "ltr"){
			$(".sidebar_slider").owlCarousel({
				direction: site_dir,
				slideSpeed : 900,
				autoPlay : 4000,
				items:1,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				itemsTablet: false,
				itemsTabletSmall: false,
				itemsMobile: false,
				stopOnHover : true,
				navigation : true,
				navigationText : [
					"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
					"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
				pagination : true,
				transitionStyle : "backSlide"
			});
		}else{
			$(".sidebar_slider").owlCarousel({
				direction: site_dir,
				slideSpeed : 900,
				autoPlay : 4000,
				items:1,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				itemsTablet: false,
				itemsTabletSmall: false,
				itemsMobile: false,
				stopOnHover : true,
				navigation : true,
				navigationText : [
					"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
					"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
				pagination : true,
			});
		}
		
		
		$(".featured_slider").owlCarousel({
			direction: site_dir,
			slideSpeed : 900,
			autoPlay : 4000,
			itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			itemsCustom : [
				[0, 1],
				[450, 2],
				[786, 3],
				[1000, 4],
				[1200, 5]
			],
			autoHeight : true,
			stopOnHover : true,
			navigation : true,
			navigationText : [
				"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
				"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
			pagination : true,
		});
		
		//--------------------------------------> Single Page (Shop)
		$(".thumbs_gall_slider_con").each(function(index, element) {
			var gall_con = $(this);
            var sync1 = $(gall_con).find(".thumbs_gall_slider_larg");
			var sync2 = $(gall_con).find(".gall_thumbs");
			var transition_style = $(sync1).attr("data-transition");
			
			if (typeof transition_style !== typeof undefined && transition_style !== false) {
				sync1.owlCarousel({
					direction: site_dir,
					items:1,
					itemsDesktop: false,
					itemsDesktopSmall: false,
					itemsTablet: false,
					itemsTabletSmall: false,
					itemsMobile: false,
					slideSpeed : 1000,
					autoPlay : 4000,
					autoHeight : true,
					navigation: true,
					navigationText : [
						"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
						"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
					pagination:false,
					afterAction : syncPosition,
					responsiveRefreshRate : 200,
					//transitionStyle : transition_style //fade - fadeUp - backSlide - goDown				
				});
			}else{
				sync1.owlCarousel({
					direction: site_dir,
					items:1,
					itemsDesktop: false,
					itemsDesktopSmall: false,
					itemsTablet: false,
					itemsTabletSmall: false,
					itemsMobile: false,
					slideSpeed : 1000,
					autoPlay : 4000,
					autoHeight : true,
					navigation: true,
					navigationText : [
						"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
						"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
					pagination:false,
					afterAction : syncPosition,
					responsiveRefreshRate : 200,
				});
			}			
			
			if(gall_con.hasClass("gall_full_width")){
				sync2.owlCarousel({
					direction: site_dir,
					items : 9,
					itemsDesktop: false,
					itemsDesktopSmall: false,
					itemsTablet: false,
					itemsTabletSmall: false,
					itemsMobile: false,
					pagination:false,
					//responsiveRefreshRate : 100,
					afterInit : function(el){
						el.find(".owl-item").eq(0).addClass("current_thumb");
					}
				});
				
			}else if (gall_con.hasClass("content_thumbs_gall")){
				sync2.owlCarousel({
					direction: site_dir,
					items : 6,
					itemsDesktop: false,
					itemsDesktopSmall: false,
					itemsTablet: false,
					itemsTabletSmall: false,
					itemsMobile: false,
					pagination:false,
					//responsiveRefreshRate : 100,
					afterInit : function(el){
						el.find(".owl-item").eq(0).addClass("current_thumb");
					}
				});
			}else{
				sync2.owlCarousel({
					direction: site_dir,
					items : 4,
					itemsDesktop: false,
					itemsDesktopSmall: false,
					itemsTablet: false,
					itemsTabletSmall: false,
					itemsMobile: false,
					pagination:false,
					responsiveRefreshRate : 100,
					afterInit : function(el){
						el.find(".owl-item").eq(0).addClass("current_thumb");
					}
				});
			}
			
			function syncPosition(el){
				var current = this.currentItem;
				$(sync2).find(".owl-item").removeClass("current_thumb").eq(current).addClass("current_thumb");
				if($(sync2).data("owlCarousel") !== undefined){
					center(current);
				}
			}
			 
			$(sync2).on("click", ".owl-item", function(e){
				e.preventDefault();
				var number = $(this).data("owlItem");
				sync1.trigger("owl.goTo",number);
			});
			 
			function center(number){
				var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
				var num = number;
				var found = false;
				for(var i in sync2visible){
					if(num === sync2visible[i]){
						found = true;
					}
				}
			 
				if(found===false){
					if(num>sync2visible[sync2visible.length-1]){
						sync2.trigger("owl.goTo", num - sync2visible.length+2);
					}else{
						if(num - 1 === -1){
							num = 0;
						}
						sync2.trigger("owl.goTo", num);
					}
				} else if(num === sync2visible[sync2visible.length-1]){
					sync2.trigger("owl.goTo", sync2visible[1]);
				} else if(num === sync2visible[0]){
					sync2.trigger("owl.goTo", num-1);
				}
			}
        });
		
		$(".content_slider").owlCarousel({
			direction: site_dir,
			slideSpeed : 1000,
			autoPlay : 4000,
			itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			autoHeight : true,
			items:1,
			stopOnHover : true,
			navigation : false,
			pagination : true,
		});
		
		//=====> OWL Carousel Normal Slider and Portfolio Slider
		$(".porto_galla").owlCarousel({
			direction: site_dir,
			slideSpeed : 900,
			autoPlay : 3000,
			autoHeight : false,
			items:1,
            itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			stopOnHover : true,
			navigation : true,
			pagination : true,
			navigationText : [
				"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
				"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
		});

		$(".related_posts_con").owlCarousel({
			direction: site_dir,
			slideSpeed : 900,
			autoPlay : 3000,
			autoHeight : true,
			itemsCustom : [
				[0, 1],
				[450, 2],
				[600, 2],
				[700, 3],
				[1000, 3],
				[1200, 4],
				[1400, 4],
				[1600, 5]
			],
			itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			stopOnHover : true,
			navigation : true,
			pagination : true,
			navigationText : [
				"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
				"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
		});
		
		$(".related_slider_widget").owlCarousel({
			direction: site_dir,
			slideSpeed : 900,
			autoPlay : 3000,
			autoHeight : true,
            items:1,
			itemsDesktop: false,
			itemsDesktopSmall: false,
			itemsTablet: false,
			itemsTabletSmall: false,
			itemsMobile: false,
			stopOnHover : true,
			navigation : true,
			pagination : true, 
			navigationText : [
				"<span class='enar_owl_p'><i class='ico-angle-left'></i></span>",
				"<span class='enar_owl_n'><i class='ico-angle-right'></i></span>"],
		});
		
		if(site_dir == "ltr"){
			$(".feature_icon_slider").owlCarousel({
				direction: site_dir,
				slideSpeed : 900,
				autoPlay : 3000,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				itemsTablet: false,
				itemsTabletSmall: false,
				itemsMobile: false,
				autoHeight : true,
				items:1,
				stopOnHover : true,
				pagination : true,
				transitionStyle : "goDown" //fade - fadeUp - backSlide - goDown
			});
		}else{
			$(".feature_icon_slider").owlCarousel({
				direction: site_dir,
				slideSpeed : 900,
				autoPlay : 3000,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				itemsTablet: false,
				itemsTabletSmall: false,
				itemsMobile: false,
				autoHeight : true,
				items:1,
				stopOnHover : true,
				pagination : true,
			});
		}
		
		
		var owl = $("#enar_owl_slider");
		if(site_dir == "ltr"){
			owl.owlCarousel({
				direction: site_dir,
				slideSpeed : 900,
				autoPlay : 3000,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				itemsTablet: false,
				itemsTabletSmall: false,
				itemsMobile: false,
				autoHeight : true,
				items:1,
				afterAction : moved,
				stopOnHover : true,
				navigation : true,
				navigationText : [
					"<span class='enar_owl_p'><span></span></span>",
					"<span class='enar_owl_n'><span></span></span>"
				],
				pagination : true,
				transitionStyle : "fadeUp" //fade - fadeUp - backSlide - goDown
			});
			
		}else{
			owl.owlCarousel({
				direction: site_dir,
				slideSpeed : 900,
				autoPlay : 3000,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				itemsTablet: false,
				itemsTabletSmall: false,
				itemsMobile: false,
				autoHeight : true,
				items:1,
				afterAction : moved,
				stopOnHover : true,
				navigation : true,
				navigationText : [
					"<span class='enar_owl_p'><span></span></span>",
					"<span class='enar_owl_n'><span></span></span>"
				],
				pagination : true,
			});
		}
		
		function moved(owl) {
			var o_d = owl.data('owlCarousel');
			var sub_lenght = owl.find('.owl-item.active .owl_slider_con > span').length;
			var sub_current = owl.find('.owl-item.active .owl_slider_con > span');
			
			if(o_d){
				owl.find('.owl-item').eq(o_d.currentItem).addClass('active').siblings().removeClass('active');
				owl.find('.owl-item:not(.active) .owl_slider_con > span').removeClass('transform_owl');
				owl.find('.owl-item.active .owl_slider_con > span').each(function(index, element) {
                    setTimeout(function() {
							owl.find('.owl-item.active .owl_slider_con > span').eq(index).addClass('transform_owl');
					}, ((index+1)*200) );
                });
				
			}else{
				owl.find('.owl-item').eq(0).addClass('active').siblings().removeClass('active');
				owl.find('.owl-item.active .owl_slider_con > span').each(function(index, element) {
                    setTimeout(function() {
							owl.find('.owl-item.active .owl_slider_con > span').eq(index).addClass('transform_owl');
					}, ((index+1)*200) );
                });
			}
		}
		//----------> Owl End
	
		//-----------> Parallax 
		if ( $.isFunction($.fn.parallax) ) {
			$('.enar_parallax1').parallax("50%", 0.1);
			$('.enar_parallax2').parallax("50%", 0.2);
			$('.enar_parallax3').parallax("50%", 0.3);
			$('.enar_parallax4').parallax("50%", 0.4);
			$('.enar_parallax5').parallax("50%", 0.5);
			$('.enar_parallax6').parallax("50%", 0.6);
			$('.enar_parallax7').parallax("50%", 0.7);
			$('.enar_parallax8').parallax("50%", 0.8);
			$('.enar_parallax9').parallax("50%", 0.9);
		}
		//-----------> Tree Features
		$(".tree_features li").each(function(index, element) {
            var bg_color = $(this).attr("data-bgcolor");
			$(this).append("<span class='tree_curv'></span>");
			$(this).css({"background-color" : bg_color});
			$(this).find(".tree_curv").css({"background-color" : bg_color});
        });
		//----------------------------------> Four Boxes Slider
		if (typeof BoxesFx !== 'undefined' && $.isFunction(BoxesFx)) {
			var boxesfx_gall = new BoxesFx( document.getElementById( 'boxgallery' ) );
		}
		//----------------------------------> Wobbly Slider




		if (typeof SliderFx !== 'undefined' && $.isFunction(SliderFx)) {
			var slide_fx = new SliderFx( document.getElementById('wobbly_slide'), {
				easing : 'cubic-bezier(.8,0,.2,1)',
			} );


			$('#wobbly_slide').addClass('wobbly_slide_con');
			$('.wobbly_slide_con').each(function() {
				var $prev_img = $(this).find('nav .prev');
				var $next_img = $(this).find('nav .next');

				var slider_lenth = 0;
				var chick_it = false;
				var $li_childs = $(this).children('ul').find('li').length;

				setInterval(function(){
					if(slider_lenth == $li_childs){
						chick_it = true;
					}
					if(slider_lenth == 1){
						chick_it = false;
					}

					if(chick_it){
						slider_lenth -= 1;
						$prev_img.click();
					}
					if(!chick_it){
						slider_lenth += 1;
						$next_img.click();
					}

				}, 4000);
			});


		}
		//----------------------------------> scattered Slider
		if (typeof Photostack !== 'undefined' && $.isFunction(Photostack)) {
			// [].slice.call( document.querySelectorAll( '.photostack' ) ).forEach( function( el ) { new Photostack( el ); } );
			var photostack_a = new Photostack( document.getElementById( 'photostack-1' ), {
				callback : function( item ) {
					//console.log(item)
				}
			} );
			var photostack_b = new Photostack( document.getElementById( 'photostack-2' ), {
				callback : function( item ) {
					//console.log(item)
				}
			} );
			var photostack_c = new Photostack( document.getElementById( 'photostack-3' ), {
				callback : function( item ) {
					//console.log(item)
				}
			} );
		}
		//----------------------------------> Camera Slider
		if ( $.isFunction($.fn.camera) ) {
			$("#camera_wrap_1").each(function(){
					var c1 = $(this);
					c1.camera({
						thumbnails: true,
					});
			});
			
			$("#camera_wrap_2").each(function(){
					var c2 = $(this);
					c2.camera({
						height: '550px',
						loader: 'bar',
						loaderColor:"#1CCDCA",
						loaderBgColor:"none",
						loaderOpacity:0.7,
						loaderPadding:0,
						loaderStroke:5,
						pagination: false,
						thumbnails: true
					});
			});
		}
		//----------------------------------> Flex Slider
		if ( $.isFunction($.fn.flexslider) ) {
			var thumb_width = 120;
			if(getScreenWidth() >= 1024){
				thumb_width = 120;
			}else if(getScreenWidth() >= 766){
				thumb_width = 100;
			}else if(getScreenWidth() >= 478){
				thumb_width = 80;
			}else{
				thumb_width = 50;
			}
			
			$('#flex_thumbs').flexslider({
				animation: "slide",
				controlNav: true,
				directionNav: false,
				animationLoop: true,
				easing: "easeInOutExpo",
				useCSS: false,
				slideshow: false,
				itemWidth: thumb_width,
				itemMargin: 0,
				slideshowSpeed: 4000,
				animationSpeed: 800, 
				pauseOnHover: true,
				asNavFor: '#flex_carousel'
			 }).flexsliderManualDirectionControls({
				previousElementSelector: ".flex_previous",
				nextElementSelector: ".flex_next",
				disabledStateClassName: "flex_disabled"
			});
			$('#flex_carousel').flexslider({
				animation: "slide", //fade - slide
				controlNav: true,
				directionNav: false ,
				direction: "horizontal", //horizontal  - vertical
				animationLoop: true,
				slideshow: true, 
				easing: "easeInOutExpo",
				useCSS: false,
				slideshowSpeed: 6000,
				animationSpeed: 800, 
				pauseOnHover: true,
				sync: "#flex_thumbs",
				start: function(slider){
				  //$('body').removeClass('loading');
				}
			 }).flexsliderManualDirectionControls({
				previousElementSelector: ".flex_previous",
				nextElementSelector: ".flex_next",
				disabledStateClassName: "flex_disabled"
			});
			
			$('.flex_in_flex').flexslider({
				animation: "fade", //fade - slide
				controlNav: true,
				selector: ".flex_in_slides > li",
				directionNav: false ,
				direction: "horizontal", //horizontal  - vertical
				animationLoop: true,
				slideshow: true, 
				easing: "swing",
				//smoothHeight: true,
				slideshowSpeed: 3000,
				animationSpeed: 800, 
				pauseOnHover: false,
			 });
		}
		
		//----------------------------------> Back To Top
		var to_top_offset = 300,
		to_top_offset_opacity = 1200,
		scroll_top_duration = 900,
		$back_to_top = $('.hm_go_top');
		$(window).scroll(function(){
			if($(this).scrollTop() > to_top_offset ){
				$back_to_top.addClass('hm_go_is-visible');
			} else{
				$back_to_top.removeClass('hm_go_is-visible hm_go_fade-out');
			}
			if( $(this).scrollTop() > to_top_offset_opacity ) { 
				$back_to_top.addClass('hm_go_fade-out');
			}
			return false;
		});
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0,
				//easing : "easeOutElastic"
				}, {queue:false, duration: scroll_top_duration, easing:"easeInOutExpo"}
			);
		});
	    
		$(window).scroll(function(){
			if($(this).scrollTop() > 30 && $("body").hasClass("site_boxed") && $("body").hasClass("header_on_side") ){
				$("#side_heder").addClass("start_side_offset");
			}else{
				$("#side_heder").removeClass("start_side_offset");
			}
		});
		
		//----------------------------------> main_title icon
		$(".content_section:not(.bg_gray)").each(function(index, element) {
			var color = '';
            var section_bg = $(this).css('backgroundColor');
			var parts = section_bg.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
			if ( parts !== null ){
				delete(parts[0]);
				for (var i = 1; i <= 3; ++i) {
					parts[i] = parseInt(parts[i]).toString(16);
					if (parts[i].length == 1) parts[i] = '0' + parts[i];
				}
				color = '#' + parts.join('');
				$(this).find(".main_title .line i").css({"background-color" : color});
				$(this).find(".main_title .line .dot").css({"background-color" : color});
			}
			
        });
		//----------------------------------> Gialog Lightbox
		$("[data-dialog]").each(function(index, element) {
            var dialog_btn = element,
				dialog_name = document.getElementById( dialog_btn.getAttribute( 'data-dialog' ) ),
			    my_dlg = new DialogFx( dialog_name );
				dialog_btn.addEventListener( 'click', my_dlg.toggle.bind(my_dlg) );
        });
		
		//----------------------------------> Magnific Popup Lightbox
		if ( $.isFunction($.fn.magnificPopup) ) {
			$('.expand_image').each(function(index, element) {
				$(this).click(function() {								
					$(this).parent().siblings("a").click();
					$(this).parent().siblings(".porto_galla").find("a:first").click();
					$(this).parent().siblings(".embed-container").find("a").click();
					return false;
				});
			});
			$('.featured_slide_block').each(function(index, element) {
				var gall_con = $(this);
				var expander = $(this).find("a.expand_img");
				expander.click(function() {								
					gall_con.find("a:first").click();
					return false;
				});
			});
			$('.porto_block').each(function(index, element) {
				var gall_con = $(this);
				var expander = $(this).find("a.expand_img");
				var expander_b = $(this).find("a.icon_expand");
				expander.click(function() {								
					gall_con.find("a:first").click();
					return false;
				});
				expander_b.click(function() {								
					gall_con.find("a:first").click();
					return false;
				});
			});
			$(".magnific-popup, a[data-rel^='magnific-popup']").magnificPopup({ 
				type: 'image',
				mainClass: 'mfp-with-zoom', // this class is for CSS animation below
				
				zoom: {
					enabled: true,
					duration: 300,
					easing: 'ease-in-out',
					// The "opener" function should return the element from which popup will be zoomed in
					// and to which popup will be scaled down
					// By defailt it looks for an image tag:
					opener: function(openerElement) {
						// openerElement is the element on which popup was initialized, in this case its <a> tag
						// you don't need to add "opener" option if this code matches your needs, it's defailt one.
						return openerElement.is('img') ? openerElement : openerElement.find('img');
					}
				}
				
			});
			
			$('.magnific-gallery, .thumbs_gall_slider_larg, .porto_galla').magnificPopup({
				delegate: 'a',
				type: 'image',
				
				gallery: {
					enabled: true
				},
				removalDelay: 500,
				callbacks: {
					beforeOpen: function() {
						this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
						this.st.mainClass = /*this.st.el.attr('data-effect')*/ "mfp-zoom-in";
					}
				},
				closeOnContentClick: true,
				// allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source
				midClick: true ,	  
				retina: {
					ratio: 1,
					replaceSrc: function(item, ratio) {
					  return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; });
					} 
				}
			  
			});
			
			$('.popup-youtube, .popup-vimeo, .popup-gmaps, .vid_con').magnificPopup({
				disableOn:700,
				type:'iframe',
				mainClass:'mfp-fade',
				removalDelay:160,
				preloader:false,
				fixedContentPos:false
			});
			
			$('.ajax-popup-link').magnificPopup({
				type: 'ajax',
				removalDelay: 500,
				mainClass: 'mfp-fade',
				callbacks: {
					beforeOpen: function() {
						this.st.mainClass = "mfp-fade hm_script_loaded";
					},
					parseAjax: function(mfpResponse) {
						
					},
					ajaxContentAdded: function() {
						$(".ajax_content_container").on("click", function(event){
							var target = $(event.target);
							if (target.hasClass("mfp-close")) {
								
							}else{
								event.stopPropagation();
							}
							
						});
						$.getScript('js/functions.js', function( data, textStatus, jqxhr ) { 
							$(".hm_script_loaded .ajax_content_container").css({"opacity" : "1"});
						});
					}
				},
				
			});
			
			$('.popup-with-zoom-anim').magnificPopup({
				type:'inline',
				fixedContentPos:false,
				fixedBgPos:true,
				overflowY:'auto',
				closeBtnInside:true,
				preloader:false,
				midClick:true,
				removalDelay:300,
				mainClass:'my-mfp-zoom-in'
			});
			$('.popup-with-move-anim').magnificPopup({
				type:'inline',
				fixedContentPos:false,
				fixedBgPos:true,
				overflowY:'auto',
				closeBtnInside:true,
				preloader:false,
				midClick:true,
				removalDelay:300,
				mainClass:'my-mfp-slide-bottom'
			});
		}
		//----------------------------------> Responsive Resize
		var hm_screen_last_width = hm_screen_width();
		$(window).resize(function() { 
			  hm_screen_last_width = hm_screen_width();
			  hm_google_map_with_text();
		});
		function hm_screen_width(){
			return document.documentElement.clientWidth || document.body.clientWidth || window.innerWidth;
		}
		
		//---------------------------------------------> Hosted Video and Audio
		if ( $.isFunction($.fn.mediaelementplayer) ) {
			$("audio.hosted_audio").mediaelementplayer();
			$("video.hosted_video").mediaelementplayer({
				alwaysShowControls: true,
			});
		}
		
		//---------------------------------------------> Google map
		hm_google_map_with_text();
		function hm_google_map_with_text(){
			$(".col-md-4 .google_map, .col-md-6 .google_map, .col-md-3 .google_map, .col-md-9 .google_map").each(function(index, element) {
				  var widthy = $(this).innerWidth();
				  $(this).height(widthy/2);
			});
		}
		
		$(".google_map").each(function(index, element) {
			var main_lato = $(this).attr("data-lat");
			var main_longo = $(this).attr("data-long");
			var enable_main = $(this).attr("data-main");
			var main_texto = $(this).attr("data-text");
			
			var arr = []; var arr_con = []; var arr_text = [];
			
			var total = $(this).find(".location").length;
			$(this).find(".location").each(function(i) {
				var lato = $(this).attr("data-lat");
				var longo = $(this).attr("data-long");
				var texto = $(this).attr("data-text");
				arr_text.push( texto );
				arr = [lato,longo];
				arr_con.push( arr );
				//if (i === total - 1) {}
			});

			var map;
			if (typeof GMaps !== 'undefined') {
				map = new GMaps({
					el: element,
					scrollwheel: false,
					lat: main_lato,
					lng: main_longo,
				});
				if(total === 0 || enable_main == "yes" ){
					map.addMarker({
						lat: main_lato,
						lng: main_longo,
						icon: "images/map2.png",
						infoWindow: {
							content: main_texto
						}
					});
				}
				if (total > 0){
					map.getElevations({
						locations : arr_con,
						callback : function (result, status){
							if (status == google.maps.ElevationStatus.OK) {
								for (var i in result){
									if (result.hasOwnProperty(i)) {
										map.addMarker({
											lat: result[i].location.lat(),
											lng: result[i].location.lng(),
											icon: "images/map.png",
											//title: 'Marker with InfoWindow',
											infoWindow: {
												content: arr_text[i]
											}
										});
									}
								}
							}
						}
					});
				}
			}
		});
		
		$(".google_map").each(function(index) {
			var con_index = index + 1;
			var id_name = "map" + con_index;
			$(this).attr('id', id_name);
			
			
		});
		   
		//---------------------------------------------> Portfolio hoverdir
		
		$('.porto_full_desc .hm_filter_wrapper_con > .filter_item_block ').each( function() { 
			$(this).hoverdir({
				hoverElem : '.porto_desc'
			}); 
		});
		$('.has_hoverdir .featured_slide_block').each( function() { 
			$(this).hoverdir({
				hoverElem : '.hoverdir_con'
			}); 
		});
			
		//---------------------------------------------> Counter
		$('.counter').appear(function() {
			$(this).children('.value').countTo();
		});
		
		//---------------------------------------------> Masonry Blogs
		$(".masonry_posts.colored_masonry .blog_grid_block").each(function(index, element) {
			var bg_color = $(this).data("bg");
			$(this).find(".blog_grid_desc, .blog_grid_format i").css({ "background" : bg_color});
		});
		
		//---------------------------------------------> Animation Progress Bars
		$("[data-progress-val]").each(function() {
		
			var $this = $(this);
			
			$this.appear(function() {
				var con_width = $this.width();
				var title_width = $this.find(".title").width();
				var value_width = $this.find(".value").width();
				var fill_percent = $this.attr("data-progress-val");
				var fill_width = con_width*(fill_percent/100);
				//alert(fill_width);
				
				if(fill_width <= value_width + title_width){
					$this.find(".fill").addClass("small_line_bar");
					$this.find(".value").css({"opacity" : 0, "right" : - title_width});
				}
							
				var delay = ($this.attr("data-progress-delay") ? $this.attr("data-progress-delay") : 1);
				var animation_type = ($this.attr("data-progress-animation") ? $this.attr("data-progress-animation") : "easeOutBounce");
			    var bg_color = ($this.attr("data-progress-color") ? $this.attr("data-progress-color") : "");
				$this.find(".fill").css({"background" : bg_color});
				
				if(delay > 1) $this.css("animation-delay", delay + "ms");
				$this.find(".fill").addClass($this.attr("data-appear-animation"));
			
				setTimeout(function() {
					if(fill_width <= value_width + title_width){
						$this.find(".value").animate({ opacity: 1 });
					}
					
					$this.find(".fill").animate({
							width: $this.attr("data-progress-val")+'%',
						}, 1500, animation_type, function() {
                            if(site_dir == "ltr"){							
								$this.find(".title").animate({
									opacity: 1,
									left: 0
								}, 1500, animation_type);
							}else{
								$this.find(".title").animate({
									opacity: 1,
									right: 0
								}, 1500, animation_type);
							}
					});
					
					$this.find(".value .num").countTo({
						from: 0,
						to: $this.attr("data-progress-val"),
						speed: 1500,
						refreshInterval: 50,
					});
			
				}, delay);
												
			}, {accX: 0, accY: -50});
		
		}); 
		//---------------------------------------------> Circle Progress Bars
				
		$(".hm_circle_progressbar").each(function(index, element) {
			var $this_this = $(this);
			
			
			//if ( $.isFunction($.fn.ProgressBar) ) {
				$(this).appear(function() {
					var hm_delay = ($(this).attr("data-delay") ? $(this).attr("data-delay") : 1);
					var hm_percenty = $(this).attr("data-percentag") ? $(this).attr("data-percentag") : 100;
					var hm_startColor = $(this).attr("data-start-color") ? $(this).attr("data-start-color") : '#1CCDCA';
					var hm_endColor = $(this).attr("data-end-color") ? $(this).attr("data-end-color") : '#1CCDCA';
					var hm_animation = $(this).attr("data-animation") ? $(this).attr("data-animation") : 'easeInOut';
					var hm_days_nums = $(this).attr("data-event") ? $(this).attr("data-event") : "";
					
					//-------> Days
					function showDays(firstDate,secondDate){
						  var startDay = new Date(firstDate);
						  var endDay = new Date(secondDate);
						  var millisecondsPerDay = 1000 * 60 * 60 * 24;
						  var millisBetween = startDay.getTime() - endDay.getTime();
						  var days = millisBetween / millisecondsPerDay;
						  return Math.floor(days);
					}
					var tdate = new Date();
					var dd = tdate.getDate(); //yields day
					var MM = tdate.getMonth(); //yields month
					var yyyy = tdate.getFullYear(); //yields year
					var today_is = ( MM+1) + "/" + dd + "/" + yyyy;
					var days = showDays(hm_days_nums,today_is);
					//------->
					
					var hm_percenty_color = '#666';
					var hm_progress_type = '';
					var circle;
					var iii;
					//-------->
					if($(this).hasClass("square") && $(this).closest(".white_section").length !== 0){
						hm_percenty_color = '#fff';
					}else if(site_dark == "yes" && $(this).hasClass("style1") && $(this).closest(".white_section").length !== 0){
						hm_percenty_color = '#666';
					}else if(site_dark == "no" && $(this).hasClass("style1") && $(this).closest(".white_section").length !== 0){
						hm_percenty_color = '#666';
					}else if(site_dark == "yes" || $(this).hasClass("square") || $(this).closest(".white_section").length !== 0 ){
						hm_percenty_color = '#fff';
						
					}else {
						hm_percenty_color = '#666';
					}
					
					//-------->
					if($(this).hasClass("path")){
						var scene = document.getElementsByTagName('object');
						var lengh_heart = scene.length;
						var path = new ProgressBar.Path(scene[0].contentDocument.querySelector('.heart-path'), {
							duration: 2000,
							easing: 'easeInOut', 
							step: function(state, path) {
								
							}
						});
												
						var $path_val = $this_this.find('.path_val .num');
						$path_val.countTo({
							from: 0,
							to: hm_percenty,
							speed: 2000,
						});
						path.animate(hm_percenty / 100);
						
					}else if($(this).hasClass("square")){
							circle = new ProgressBar.Square(element , {
							color: hm_startColor,
							trailColor: 'rgba(0,0,0,.07)',
							strokeWidth: 3.5,
							duration: 2000,
							easing: hm_animation, 
							
							from: { color: hm_startColor, width: 3.5 },
							to: { color: hm_endColor, width: 3.5 },
							text: {
								value: '0',
								color: hm_percenty_color,
							},
							step: function(state, circle) {
								circle.setText((circle.value() * 100).toFixed(0) + " %");
								circle.path.setAttribute('stroke', state.color);
								circle.path.setAttribute('stroke-width', state.width);
							}
							
						});
					}else if( $this_this.hasClass("seconds") ){
						    circle = new ProgressBar.Circle(element , {
							color: hm_startColor,
							trailColor: 'rgba(255,255,255,.1)',
							strokeWidth: 10,
							trailWidth: 2,
							duration: 200,
							easing: hm_animation, 
							
							from: { color: hm_startColor, width: 2 },
							to: { color: hm_endColor, width: 2 },
							text: {
								value: ' ',
								color: hm_percenty_color,
							},
							step: function(state, circle) {
								circle.path.setAttribute('stroke', state.color);
								circle.path.setAttribute('stroke-width', state.width);
							}
							
						});
						setInterval(function() {
							var second = new Date().getSeconds();
							var second_minus = 60 - second;
							circle.animate(second_minus / 60, function() {
								if (second === 0){
									second = 60;
									circle.setText(second_minus);
								}else{
									circle.setText(second_minus);
								}
								
							});
						}, 1000);
					}else if( $this_this.hasClass("minutes") ){
						    circle = new ProgressBar.Circle(element , {
							color: hm_startColor,
							trailColor: 'rgba(255,255,255,.1)',
							strokeWidth: 10,
							trailWidth: 2,
							duration: 800,
							easing: hm_animation, 
							
							from: { color: hm_startColor, width:2 },
							to: { color: hm_endColor, width: 2 },
							text: {
								value: ' ',
								color: hm_percenty_color,
							},
							step: function(state, circle) {
								circle.path.setAttribute('stroke', state.color);
								circle.path.setAttribute('stroke-width', state.width);
							}
							
						});
						iii = 0;
						setInterval(function() {
							var minutes = new Date().getMinutes();
							var minutes_minus = 60 - minutes;
							
							var $path_val = $this_this.find('.progressbar-text');
							if(iii === 0){
								$path_val.countTo({
									from: 0,
									to: minutes_minus,
									speed: 800,
								});
							}
							iii = 1;
							
							circle.animate(minutes_minus / 60, function() {
								if (minutes === 0){
									minutes = 60;
									circle.setText(minutes_minus);
								}else{
									circle.setText(minutes_minus);
								}
							});
						}, 1000);
					}else if( $this_this.hasClass("hours") ){
							circle = new ProgressBar.Circle(element , {
							color: hm_startColor,
							trailColor: 'rgba(255,255,255,.1)',
							strokeWidth: 10,
							trailWidth: 2,
							duration: 800,
							easing: hm_animation, 
							
							from: { color: hm_startColor, width: 2 },
							to: { color: hm_endColor, width: 2 },
							text: {
								value: ' ',
								color: hm_percenty_color,
							},
							step: function(state, circle) {
								circle.path.setAttribute('stroke', state.color);
								circle.path.setAttribute('stroke-width', state.width);
							}
							
						});
						iii = 0;
						setInterval(function() {
							var hours = new Date().getHours();
							var hours_minus = 24 - hours;
							
							var $path_val = $this_this.find('.progressbar-text');
							if(iii === 0){
								$path_val.countTo({
									from: 0,
									to: hours_minus,
									speed: 800,
								});
							}
							iii = 1;
							circle.animate(hours_minus / 24, function() {
								if (hours === 0){
									hours = 24;
									circle.setText(hours_minus);
								}else{
									circle.setText(hours_minus);
								}
							});
						}, 1000);
					}else if( $this_this.hasClass("days") ){
							circle = new ProgressBar.Circle(element , {
							color: hm_startColor,
							trailColor: 'rgba(255,255,255,.1)',
							strokeWidth: 10,
							trailWidth: 2,
							duration: 800,
							easing: hm_animation, 
							
							from: { color: hm_startColor, width: 2 },
							to: { color: hm_endColor, width: 2 },
							text: {
								value: "0",
								color: hm_percenty_color,
							},
							step: function(state, circle) {
								circle.path.setAttribute('stroke', state.color);
								circle.path.setAttribute('stroke-width', state.width);
							}
							
						});
						iii = 0;
						setInterval(function() {
							var $path_val = $this_this.find('.progressbar-text');
							if(iii === 0){
								$path_val.countTo({
									from: 0,
									to: days,
									speed: 800,
								});
							}
							iii = 1;
							
							circle.animate(days / 365, function() {
								circle.setText(days);
							});
						}, 1000);
					}else{
							circle = new ProgressBar.Circle(element , {
							color: hm_startColor,
							trailColor: 'rgba(0,0,0,.07)',
							strokeWidth: 10,
							trailWidth: 3,
							duration: 2000,
							easing: hm_animation, 
							
							from: { color: hm_startColor, width: 3 },
							to: { color: hm_endColor, width: 3 },
							text: {
								value: '0',
								color: hm_percenty_color,
							},
							step: function(state, circle) {
								circle.setText((circle.value() * 100).toFixed(0) + " %");
								circle.path.setAttribute('stroke', state.color);
								circle.path.setAttribute('stroke-width', state.width);
							}
							
						});
					}
					
					setTimeout(function() {
						$this_this.animate({
									opacity: 1,
						}, 1000 );
						
						$this_this.find(".progressbar-text").animate({
									opacity: 1,
						}, hm_delay);
						if($this_this.hasClass("path")){ 
						
						}else if ($this_this.hasClass("seconds") || $this_this.hasClass("minutes") || $this_this.hasClass("hours") || $this_this.hasClass("days") ){
							
						} else{
							circle.animate(hm_percenty / 100, function() {
								
							});
						}
						
					}, hm_delay);
				});
			//}
		});
		
		//---------------------------------------------> Team Boxes 3
		$('.team_block3').each(function() {
			var num = 0;
            $('.team-col').each(function(index) {
				var bg_color = $(this).attr("data-color");
				num += 1;
				if(num == 3 || num == 4){
					$(this).addClass("team_col_on_right");
				}
				if(num == 4 ){
					num = 0;
				}
				//---------------------------------------------> Set Background Color
				if (typeof bg_color !== typeof undefined && bg_color !== false) {
					$(this).css({ "background" : bg_color});
					$(this).find(".arrow").css({ "background" : bg_color});
				}
			});
        });
		
		//---------------------------------------------> Youtube Background Video
		if ( $.isFunction($.fn.YTPlayer) ) {
			$(".youtube_bg_video").each(function(index, element) {
				var $vid_vid = $(this);
				var $vid_controlls = $vid_vid.parent().find('.play_video_btn');
                $vid_vid.YTPlayer();
				
				$($vid_controlls).on('click', function(event){
					event.preventDefault();
					if($vid_controlls.hasClass('play_video')){
						$vid_controlls.removeClass('play_video').addClass('pause_video');
						$vid_controlls.find('i').removeClass().addClass('ico-pause2');
						$vid_vid.playYTP();
						$vid_vid.removeClass('now_pausing').addClass('now_playing');
					}else{
						$vid_controlls.removeClass('pause_video').addClass('play_video');
						$vid_controlls.find('i').removeClass().addClass('ico-play5');
						$vid_vid.pauseYTP();				
					}
				});
				
            });
		}
		//---------------------------------------------> HTML5 Video Background 
		$('.html_video_background').each(function(index, element) {
			var mp4 = $(this).attr("data-mp");
			var webm = $(this).attr("data-webm");
			var ogg = $(this).attr("data-ogg");
			var poster = $(this).attr("data-poster");
			var controll_pos = $(this).parent().find(".video_frame_bl");
			var resize_to = $(this).parent();
			
            $(this).videobackground({
				videoSource: [
				    [mp4, 'video/mp4'],
					[webm, 'video/webm'], 
					[ogg, 'video/ogg']
				], 
				controlPosition: controll_pos,
				poster: poster,
				loadedCallback: function() {
					$(this).videobackground('mute');
				},
				loop: true,
				controlText : [
					['<span class="html5_video_play"><i class="ico-play3"></i></span>'],
					['<span class="html5_video_pause"><i class="ico-pause2"></i></span>'],
					['<span class="html5_video_pause"><i class="ico-sound4"></i></span>'],
					['<span class="html5_video_pause"><i class="ico-sound-mute"></i></span>']
				],
				resizeTo: '.html_video_background'
			});
        });
		
		//---------------------------------------------> Cart Rating
		$('.your_rate').each(function(index, element) {
            var score = $(this).find('.outline_stars').data('rate');
			$(this).find('.outline_stars').css({width : score+'%'});
        });
		
		//---------------------------------------------> Price Filters
		if ( $.isFunction($.fn.noUiSlider) ) {
			$('#shop_price_slider').noUiSlider({
				start: [ 200, 800 ],
				step: 1,
				snap: false,
				connect: true,			
				range: {
					'min': 0,
					'max': 1000
				},
				format: {
				  to: function ( value ) {
					return value + ',-';
				  },
				  from: function ( value ) {
					return value.replace(',-', '');
				  }
				}
			});
			$('#shop_price_slider').Link('lower').to($('#shop_price_slider_lower'), null, wNumb({
				prefix: '$',
			}));	
			$('#shop_price_slider').Link('lower').to($('#min_price'), null, wNumb({}));	
			
			$('#shop_price_slider').Link('upper').to($('#shop_price_slider_upper'), null, wNumb({
				prefix: '$',
			}));
			$('#shop_price_slider').Link('upper').to($('#max_price'), null, wNumb({}));
		}
		
	    //---------------------------------------------> Animated
		$('.animated').appear(function() {
			var elem = $(this);
			var animation = elem.data('animation');
			if ( !elem.hasClass('visible') ) {
				var animationDelay = elem.data('animation-delay');
				if ( animationDelay ) {
	
					setTimeout(function(){
						elem.addClass( animation + " visible" );
						elem.removeClass('hiding');
					}, animationDelay);
	
				} else {
					elem.addClass( animation + " visible" );
					elem.removeClass('hiding');
				}
			}
		});
		
		//---------------------------------------------> Scroll Easing
		$('.scroll').on('click', function(event) {
			var $anchor = $(this);
			var headerH = $('#navigation_bar').outerHeight();
			var my_offset = 0;
			
			if($(this).hasClass("reviews_navigate")){
				var rev_tab = $("a[data-content='reviews']");
				$(rev_tab).click(); 
			}
			if($(this).hasClass("onepage")){
				my_offset = headerH - 2;
			}
			$('html, body').stop().animate({
				scrollTop : $($anchor.attr('href')).offset().top - my_offset + "px"
			}, 1200, 'easeInOutExpo');
			event.preventDefault();
		});
		
		//--------------------------------------> Single Product Number Of Items
		$(".quantity_controll").on("click", function() {
			
			var $button = $(this);
			var oldValue = $button.siblings('.input-text').val();
			var newVal;
			
			if ($button.hasClass('plus')) {
				newVal = parseFloat(oldValue) + 1;
			} else {
				if (oldValue > 1) {
			  		newVal = parseFloat(oldValue) - 1;
					
				} else {
			  		newVal = 1;
				}
			}
			$button.siblings('.input-text').val(newVal);
		});
		
		$('.comment-form-rating .stars a').on("click", function() {
			var data_rel = $(this).attr("data-rate");
        	$(this).addClass('active').siblings().removeClass('active');
			$("select#rating").val(data_rel);
			return false;
        });	
			
		$('a.remove').on("click", function() {
        	$(this).closest('tr').fadeOut();
			return false;
        });	
		//=====> End Single Product

		$(window).resize(function() {
			hmtabswidth();
		});
		hmtabswidth();
		function hmtabswidth(){
			$('.hm-tabs').each(function(index) {
				var $allparent = $(this);
				var all_width = $allparent.width();
				var all_lis = 0;
				$allparent.find(".tabs-navi > li").each(function(index, element) {
                    var li_width = $(this).outerWidth();
					all_lis += li_width;
                });
				if(all_lis >= all_width){
					$allparent.addClass("tabs_mobile");
				}else{
					$allparent.removeClass("tabs_mobile");
				}
			});
			$('.sort_options').each(function(index) {
				var $allparent = $(this);
				var all_width = $allparent.width();
				var all_lis = 0;
				$allparent.find("#filter-by > li").each(function(index, element) {
                    var li_width = $(this).outerWidth();
					all_lis += li_width;
                });
				if(all_lis >= all_width){
					$allparent.addClass("filter_by_mobile");
				}else{
					$allparent.removeClass("filter_by_mobile");
				}
			});
		}

		
		//=====> Tabs
		$('.hm-tabs').each(function(index) {
			var allparent = $(this);
			var all_width = allparent.width();
						
			var tabItems = allparent.find('.tabs-navi a'),
			tabContentWrapper = allparent.find('.tabs-body');
	        
			tabItems.on('click', function(event){
				event.preventDefault();
				
				var selectedItem = $(this);
				var parentlist = selectedItem.parent();
				
				if(parentlist.index() === 0){
				    selectedItem.parent().siblings("li").removeClass('prev_selected');
				}else{
					selectedItem.parent().prev().addClass('prev_selected').siblings("li").removeClass('prev_selected');
				}
				
				if( !selectedItem.hasClass('selected') ) {
					var selectedTab = selectedItem.data('content'),
						selectedContent = tabContentWrapper.find('li[data-content="'+selectedTab+'"]'),
						slectedContentHeight = selectedContent.innerHeight();
					
					tabItems.removeClass('selected');
					selectedItem.addClass('selected');
					selectedContent.addClass('selected').siblings('li').removeClass('selected');
					//animate tabContentWrapper height when content changes 
					tabContentWrapper.animate({
						'height': slectedContentHeight
					}, 200);
				}
			});
		
			//hide the .hm-tabs::after element when tabbed navigation has scrolled to the end (mobile version)
			checkScrolling($('.hm-tabs nav'));
			$(window).on('resize', function(){
				checkScrolling($('.hm-tabs nav'));
				tabContentWrapper.css('height', 'auto');
			});
			$('.hm-tabs nav').on('scroll', function(){ 
				checkScrolling($(this));
			});
			
			function checkScrolling(tabs){
				var totalTabWidth = parseInt(tabs.children('.tabs-navi').width()),
					tabsViewport = parseInt(tabs.width());
				if( tabs.scrollLeft() >= totalTabWidth - tabsViewport) {
					tabs.parent('.hm-tabs').addClass('is-ended');
				} else {
					tabs.parent('.hm-tabs').removeClass('is-ended');
				}
			}
		
		});
		
		//======> Isotope Filter
		$( function() {
			$(window).load(function(){
				
				$(".hm_filter_wrapper").each(function(index, element) {
					var main_parent = $(this);
					var filter_buttons  = main_parent.find('#filter-by');
					var filtered_parent  = main_parent.find('.hm_filter_wrapper_con');
					
					var col_width = main_parent.hasClass("masonry_porto") ? 1 : 0;
					
                    main_parent.find("#filter-by li a").each(function(index, element) {
						var get_class = $(this).attr("data-option-value");
						var lenghty = main_parent.find(".hm_filter_wrapper_con > "+get_class).length;
						$(this).find(".num").html(lenghty);
					});
					main_parent.find(".sort_list a.sort_selecter").click(function(){
						return false;
					});
					
					main_parent.find(".porto_nums > span.like i").click(function(){
						var par = $(this).parent();
						par.addClass('added');
						
						var sib = $(this).siblings(".like_counter");
						var sib_int = parseInt($(this).siblings(".like_counter").text(), 10);
						++sib_int;
						sib.html(sib_int);
					});
					
					main_parent.find("#sort-by li a").click(function(){
						var this_a = $(this);
						var $asc_desc = this_a.closest('.sort_list').siblings("#sort-direction");
						$asc_desc.css({"opacity":"1"});
						var this_text = this_a.find('.text').text();
						var writed = this_a.closest('.sort_list').find('a.sort_selecter .text');
						writed.html(this_text);
					});
					
					var $container = main_parent.find('.hm_filter_wrapper_con');
					var col_width_mobile = 0;
					
					if(getScreenWidth() >= 1022){
						col_width_mobile = 5;
					}else if(getScreenWidth() >= 766){
						col_width_mobile = 4;
					}else if(getScreenWidth() >= 478){
						col_width_mobile = 2;
					}else{
						col_width_mobile = 1;
					}
					
					if (!main_parent.hasClass('content_filter')) { //-------------->
					    if (main_parent.hasClass('masonry_porto')) {
							$container.isotope({
								itemSelector : '.filter_item_block',
								layoutMode: 'masonry',
								resizable: false, // disable normal resizing
								masonry: {
								  columnWidth: $container.width() / col_width_mobile,
								},
								getSortData : {
									name: '.name',
									like_counter: '.like_counter parseInt',
									number: '.number parseInt',
									comm_counter: '.comm_counter parseInt',
								},						
							});
							$(window).resize(function(){
								var col_width_mobile = 0;
								if(getScreenWidth() >= 1022){
									col_width_mobile = 5;
								}else if(getScreenWidth() >= 766){
									col_width_mobile = 4;
								}else if(getScreenWidth() >= 478){
									col_width_mobile = 2;
								}else{
									col_width_mobile = 1;
								}
								  $container.isotope({
									masonry: { columnWidth: $container.width() / col_width_mobile }
								  });
							});
						}else{
							$container.isotope({
								itemSelector : '.filter_item_block',
								layoutMode: 'masonry',
								resizable: false, // disable normal resizing
								masonry: {
								  columnWidth: col_width,
								},
								getSortData : {
									name: '.name',
									like_counter: '.like_counter parseInt',
									number: '.number parseInt',
									comm_counter: '.comm_counter parseInt',
								},						
							});
						}
						
						var $optionSets = main_parent.find('#options .option-set'),
						$optionLinks = $optionSets.find('a');
						
						$optionLinks.click(function(){
							var $this = $(this);
							// don't proceed if already selected
							if ( $this.hasClass('selected') ) {
								return false;
							}
							var $optionSet = $this.parents('.option-set');
							$optionSet.find('.selected').removeClass('selected');
							$this.addClass('selected');
						
							// make option object dynamically, i.e. { filter: '.my-filter-class' }
							var options = {},
							key = $optionSet.attr('data-option-key'),
							value = $this.attr('data-option-value');
							// parse 'false' as false boolean
							value = value === 'false' ? false : value;
							options[ key ] = value;
							if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
								// changes in layout modes need extra logic
								changeLayoutMode( $this, options );
							} else {
								// otherwise, apply new options
								$container.isotope( options );
							}
						
							return false;
						});
					} else { //------------------------------------------------------------->
					      filtered_parent.find('.content_filter_item').each(function(index, element) {
							  var filtered_parent_item = $(this);
							  var item_height = filtered_parent_item.find('.enar_accordion').outerHeight();
							  
							  filtered_parent_item.animate({
								   height : item_height+10+'px',
							  }, 300 );
						  });
						  
						  filter_buttons.find('li a').click(function(event){
							  var i_sel = $(this).attr('data-option-value');
							  event.preventDefault();
							  
							  if (!$(this).hasClass('selected')) {
								  filter_buttons.find('li a').removeClass('selected');
								  $(this).addClass('selected');
								
								  filtered_parent.children().not(i_sel).each(function(index, element) {
									  var this_occy = $(this);
									  var child_occ = this_occy.find(".enar_occ_container");
									  
									  this_occy.animate({ height : 0 }).addClass('content_hidden');
									  
									  child_occ.removeClass("occ_expanded");
									  child_occ.find(".enar_occ_content").stop(true, true).animate({
										   height : '0px',
									  }, 300 );
                                      
                                  });
								  
								  filtered_parent.children(i_sel).each(function(index, element) {
									  var this_occy = $(this);
									  var heighty = $(this).find(".enar_accordion").outerHeight()+ 10;
									  this_occy.animate({ height : heighty+'px' }).removeClass('content_hidden');
                                  });
								
							  }
						});
					} //------------------------------------------------------------->
					
					
                });
				//=====> Each
			});
		
		});

		//=====> Top Cart
		$('.top_add_card').on('click', function(event){ 
		    var parent = $(this).parent();
			event.preventDefault();
			event.stopPropagation();
			
			if(parent.hasClass('active')){
				parent.removeClass('active');
			}else{
				parent.addClass('active');
			}
			
			$('.top_cart_con').fadeIn(function(){
				$('.top_cart_con').on("click touchstart", function(e){
					e.stopPropagation();
				});
				$(document).on("click touchstart", function(e){
				   $('.top_cart_con').fadeOut();
				   parent.removeClass('active');
				});
			});
		});
	});	
	
    //========> Menu
	$.fn.idealtheme = function(options){
		var whatTheLastWidth = getScreenWidth();
		var ifisdescktop = false;
		var MqL = 1170;
		
		var settings = {
			 duration: 300,
			 delayOpen: 0,
			 menuType: "horizontal", // horizontal - vertical 
			 position: "right", // right - left
			 parentArrow: true,
			 hideClickOut: true,
			 submenuTrigger: "hover",
			 backText: "Back to ",
			 clickToltipText: "Click",
		};
		$.extend( settings, options );	
		var nav_con = $(this);
		var $nav_con_parent = nav_con.parent("#main_nav");	
		var menu = $(this).find('#navy');
		
		//=====> Mega Menu Top Space
		function megaMenuTop(){
			$(menu).find('.has_mega_menu').each(function() {
                var top_space = $(this).parent('li').outerHeight();
				$(this).find(' > .mega_menu').css({"top" : top_space+"px", "width" : "100%"});
            });
		}
		megaMenuTop();
		
		//=====> Vertical and Horizontal	
		if(settings.menuType == "vertical"){
			$(menu).addClass("vertical_menu");
			if(settings.position == "right"){
				$(menu).addClass("position_right");
			}else{
				$(menu).addClass("position_left");
			}
		}else{
			$(menu).addClass("horizontal_menu");
		}
		
		//=====> Add Arrows To Parent li
		if(settings.parentArrow === true){
			$(menu).find("li.normal_menu li, li.has_image_menu").each(function(){
				if($(this).children("ul").length > 0){
					$(this).children("a").append("<span class='parent_arrow normal_menu_arrow'></span>");
				}
			});
			
			$(menu).find("ul.mega_menu li ul li, .tab_menu_list > li").each(function(){
				if($(this).children("ul").length > 0){
					$(this).children("a").append("<span class='parent_arrow mega_arrow'></span>");
				}
			});
		}
		
		function TopSearchFunc(){
			$(".top_search").each(function(index, element) {
				var top_search = $(this);
				top_search.submit(function(event){
					event.stopPropagation();
					if(top_search.hasClass("small_top_search")){
						top_search.removeClass("small_top_search");
						top_search.addClass("large_top_search");
						if(getScreenWidth() <= 315 ){
							top_search.siblings("#top_cart").animate({opacity: 0});
						}
						top_search.siblings("#nav_menu:not(.mobile_menu), .logo_container").animate({opacity: 0});
						return false;
					}
					
				});
				$(top_search).on("click touchstart", function(e){
					e.stopPropagation();
				});
				$(document).on("click touchstart", function(e){
					if(top_search.hasClass("large_top_search")){
						top_search.removeClass("large_top_search");
						top_search.addClass("small_top_search");
						if(getScreenWidth() <= 315 ){
							top_search.siblings("#top_cart").animate({opacity: 1});
						}
						top_search.siblings("#nav_menu:not(.mobile_menu), .logo_container").animate({opacity: 1});
					}
				});
			});
			if(getScreenWidth() < 1190){
				$("#navigation_bar").find(".top_search").addClass("small_top_search");
			}else{
				$("#navigation_bar").find(".top_search").removeClass("small_top_search");
			}
		}
		var top_search_func = new TopSearchFunc();
		
		$(window).resize(function() {
			top_search_func = new TopSearchFunc();
			megaMenuTop();
			if( whatTheLastWidth > 992 && getScreenWidth() <= 992 && $("body").hasClass("header_on_side")){
				$(menu).slideUp();
			}
			if( whatTheLastWidth <= 992 && getScreenWidth() > 992 && $("body").hasClass("header_on_side")){
				$(menu).slideDown();
			}
			
			if(whatTheLastWidth <= 992 && getScreenWidth() > 992 && !$("body").hasClass("header_on_side") ){
				resizeTabsMenu();
				removeTrigger();
                playMenuEvents();
			}
			if(whatTheLastWidth > 992 && getScreenWidth() <= 992){
				releaseTrigger();
				playMobileEvents();
				resizeTabsMenu();
				$(menu).slideUp();
			} 
			whatTheLastWidth = getScreenWidth(); 
			return false;
		});
		
		//======> After Refresh
		function ActionAfterRefresh(){
			if(getScreenWidth() <= 992 || $("body").hasClass("header_on_side") ){
				releaseTrigger();
				playMobileEvents();
				resizeTabsMenu();
				
			} else {
				resizeTabsMenu();
				removeTrigger();
                playMenuEvents();
			}
		}
		
		var action_after_ref = new ActionAfterRefresh();
		
		//======> Mobile Menu
		function playMobileEvents(){
			$(".nav_trigger").removeClass("nav-is-visible");
			$(menu).find("li, a").unbind();
			if($(nav_con).hasClass("mobile_menu")){
				$(nav_con).find("li.normal_menu").each(function(){
					if($(this).children("ul").length > 0){
						$(this).children("a").not(':has(.parent_arrow)').append("<span class='parent_arrow normal_menu_arrow'></span>");
					}
				});
			}
			megaMenuEvents();
		    			
			$(menu).find("li:not(.has-children):not(.go-back)").each(function(){
				$(this).removeClass("opened_menu");
				if($(this).children("ul").length > 0){
					var $li_li_li = $(this);
					$(this).children("a").on("click", function(event){
						var curr_act = $(this);

						if(!$(this).parent().hasClass("opened_menu")){
							$(this).parent().addClass("opened_menu");
							$(this).parent().siblings("li").removeClass("opened_menu");
							if($(this).parent().hasClass("tab_menu_item")){
								$(this).parent().addClass("active");
								$(this).parent().siblings("li").removeClass("active");
							}
							$(this).siblings("ul").slideDown(settings.duration);
							$(this).parent("li").siblings("li").children("ul").slideUp(settings.duration);
							setTimeout(function(){ 
								var curr_position = curr_act.offset().top;
								$('body,html').animate({
									//scrollTop: curr_position ,
									}, {queue:false, duration: 900, easing:"easeInOutExpo"}
								);
							}, settings.duration);
							
							return false;
						}
						else{
							$(this).parent().removeClass("opened_menu");
							$(this).siblings("ul").slideUp(settings.duration);
							if($li_li_li.hasClass("mobile_menu_toggle") || $li_li_li.hasClass("tab_menu_item")){
								return false;
							}
						}
					});
				}
			});
		}
	
		function megaMenuEvents(){
			$(menu).find('li.has_mega_menu ul').removeClass("moves-out");
			$(menu).find('.go-back, .mega_toltip').remove();
			$(menu).find('li.has_mega_menu > ul').hover(function() {
				
				$(this).find(".mega_menu_in ul").each(function(index, element) {
					var $mega_ul = $(this);
                    var its_height = 0;
										
					$mega_ul.children('li').each(function(index, element) {
						var ul_li_num = $(this).innerHeight();
						its_height += ul_li_num;
					});
					$mega_ul.attr("data-height", its_height);
                });
			});
			$(menu).find('ul.mega_menu li li').each(function(index, element) {
                var $mega_element = $(this);
				if($mega_element.children('ul').length > 0){
					$mega_element.addClass("has-children");
					$mega_element.children('ul').addClass("is-hidden");
				}
			});
			$(menu).find('ul.mega_menu li.has-children').children('ul').each(function(index, element) {
				var $mega_ul = $(this);
				var its_height = 0;
				$mega_ul.children('li').each(function(index, element) {
					var ul_li_num = $(this).innerHeight();
					its_height += ul_li_num;
				});
                $mega_ul.attr("data-height", its_height);
				
				var $mega_link = $mega_ul.parent('li').children('a');
				var $mega_title = $mega_ul.parent('li').children('a').text();
				$("<span class='mega_toltip'>" + settings.clickToltipText +"</span>").prependTo($mega_link);
				
				if(!$mega_link.find('.go-back').length){
					$("<li class='go-back'><a href='#'>" + settings.backText + $mega_title +"</a></li>").prependTo($mega_ul);
				}
				
			});
			
			$(menu).find('ul.mega_menu li.has-children').children('a').on('click', function(event){
                event.preventDefault();
				var selected = $(this);
				
				if( selected.next('ul').hasClass('is-hidden') ) {
					var ul_height = parseInt(selected.next('ul').attr("data-height"));
					var link_height = parseInt(selected.innerHeight());
					var all_height = ul_height + link_height;
					
					selected.addClass('selected').next('ul').removeClass('is-hidden').end().parent('.has-children').parent('ul').addClass('moves-out');
					selected.closest('.mega_menu_in').animate({height: all_height});
					
					selected.parent('.has-children').siblings('.has-children').children('ul').addClass('is-hidden').end().children('a').removeClass('selected');
					//====> if is mobile
					if(selected.closest('#nav_menu').hasClass("mobile_menu")){
						selected.parent('.has-children').removeClass("mega_parent_hidden").prevAll('li').slideUp(settings.duration);
					}
					
				}
				
			});
			
			//submenu items - go back link
			$('.go-back').on('click', function(){
				var link_height = parseInt($(this).parent("ul").parent("li").parent("ul").attr("data-height"));
					
				$(this).parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('moves-out');
				$(this).closest('.mega_menu_in').animate({height: link_height});
				//====> if is mobile
				if($(this).closest('#nav_menu').hasClass("mobile_menu")){
					$(this).parent('ul').parent('li').removeClass("mega_parent_hidden").prevAll('li').slideDown(settings.duration);
				}
				
                return false;
			});
		}
		
		
		//======> Desktop Menu
		function playMenuEvents(){
			$(menu).children('li').children('ul').hide(0);
			$(menu).find("li, a").unbind();
			$(menu).slideDown(settings.duration);
			$(menu).find('ul.tab_menu_list').each(function(index, element) {
				var tab_link = $(this).children('li').children('a');
				$("<span class='mega_toltip'>" + settings.clickToltipText +"</span>").prependTo(tab_link);
                $(this).children('li').on('mouseover', function(){
					if(!$(this).hasClass('active')){
						$(this).children('ul').stop().fadeIn();
						$(this).siblings().children('ul').stop().fadeOut();
						$(this).addClass('active');
						$(this).siblings().removeClass('active');
					}
				});
			});
			
			megaMenuEvents();
			
			$(menu).find('li.normal_menu, > li').hover(function() {
				var li_link = $(this).children('a');
				$(this).children('ul').stop().fadeIn(settings.duration);
			}, function() {
				$(this).children('ul').stop().fadeOut(settings.duration);
			});
		}
		
		//======> Trigger Button Mobile Menu
		function releaseTrigger(){
			$(nav_con).find(".nav_trigger").unbind();
			$(nav_con).addClass('mobile_menu');
			$nav_con_parent.addClass('has_mobile_menu');
			
			$(nav_con).find('.nav_trigger').each(function(index, element) {
				var $trigger_mob = $(this);
                $trigger_mob.on('click touchstart', function(e){
					e.preventDefault();
					if($(this).hasClass('nav-is-visible')){
						$(this).removeClass('nav-is-visible');
						$(menu).slideUp(settings.duration);
						
					}else{
						$(this).addClass('nav-is-visible');
						$(document).unbind("click");
						$(document).unbind("touchstart");
						$(menu).slideDown(settings.duration, function(){
							$(menu).on("click touchstart", function(event){
								event.stopPropagation();
							});
							$(document).on('click touchstart', function(event){
								if($trigger_mob.hasClass('nav-is-visible') && getScreenWidth() <= 992){
									$trigger_mob.removeClass('nav-is-visible');
									$(menu).slideUp(settings.duration);
								}
							});
							
						});
					}
				});
				
            });
			
		}
		
		//=====> get tabs menu height
		function resizeTabsMenu(){	
			function thisHeight(){
				return $(this).outerHeight();
			}
		    $.fn.sandbox = function(fn) {
				var element = $(this).clone(), result;
				element.css({visibility: 'hidden', display: 'block'}).insertAfter(this);
				element.attr('style', element.attr('style').replace('block', 'block !important'));
				var thisULMax = Math.max.apply(Math, $(element).find("ul:not(.image_menu)").map(thisHeight));
				result = fn.apply(element);
				element.remove();
				return thisULMax;
			};
		    $(".tab_menu").each(function() {
				$(this).css({"height" : "inherit"});
				if(!$(nav_con).hasClass("mobile_menu")){
					var height = $(this).sandbox(function(){ return this.height(); });
					$(this).height(height);
				}
				
			});		
		}
		resizeTabsMenu();
		//=====> End get tabs menu height
		
		function removeTrigger(){
			$(nav_con).removeClass('mobile_menu');
			$nav_con_parent.removeClass('has_mobile_menu');
		}
		
		//----------> sticky menu
		enar_sticky();
		
	};
	
	var offset_header = "";	
	get_header_offset();	
	ideal_accordion();
	
	$(window).on("resize", function(){		
		get_header_offset();
		ideal_accordion();
		enar_sticky();
	});
	
	function get_header_offset(){		
		offset_header = "";
		if(getScreenWidth() <= 992){
			offset_header = "";
		}else{
			offset_header = "#site_header";
		}
	}
	
	//-----------------> My Acoordion
	function ideal_accordion(resize_occ){
		$(".enar_accordion").each(function(index, element) {
            var its_type = $(this).attr("data-type");
			var its_item = $(this).find(".enar_occ_container");
			var its_item_lenth = its_item.length;
			
			its_item.each(function(index, element) {
				var item_item = $(this);				
				var item_item_title = $(this).find(".enar_occ_title");
				var item_title_height = $(this).find(".enar_occ_title").outerHeight();
                var item_expanded = item_item.attr("data-expanded");  //false - true
				var item_item_content = $(this).find(".enar_occ_content");
				var item_item_height = item_item_content.find(".acc_content").outerHeight();
				
				if(item_expanded == "true"){//occ_expanded
					item_item.addClass("occ_expanded");
					item_item_content.stop(true, true).animate({
					   height : item_item_height+'px',
					}, 300 );
				}
				item_item_title.unbind();
				item_item_title.click(function(event){
					if(item_item.hasClass("occ_expanded")){
						item_item.removeClass("occ_expanded");
						item_item_content.stop(true, true).animate({
						   height : '0px',
					  	}, 300 );
						item_item_content.closest('.content_filter_item').stop(true, true).animate({
						   height : item_title_height+10+'px',
					  	}, 300 );
						
					}else{
						item_item.addClass("occ_expanded");
						item_item_content.stop(true, true).animate({
						   height : item_item_height+'px',
					  	}, 300 );
						item_item_content.closest('.content_filter_item').stop(true, true).animate({
						   height : item_item_height+item_title_height+10+'px',
					  	}, 300 );
						//--------> Accordion Type
						if(its_type == "accordion"){
							item_item.siblings().removeClass("occ_expanded");
							item_item.siblings().find(".enar_occ_content").stop(true, true).animate({
							   height : '0px',
							}, 300 );
						}
					}
				});
				
            });

        });
	}
	//----------> sticky menu	
	function enar_sticky(){
		if ( $.isFunction($.fn.sticky) ) {
			var $navigation_bar = $("#navigation_bar");
			$navigation_bar.unstick();
			var mobile_menu_len = $navigation_bar.find(".mobile_menu").length;
			var side_header = $(".header_on_side").length;
			if( mobile_menu_len === 0 && side_header === 0){
				$navigation_bar.sticky({
					topSpacing : 0,
					className : "sticky_menu",
					getWidthFrom : "body"
				});
			}else{
				$navigation_bar.unstick();
			}
		}
	}
	
	function getScreenWidth(){
		return document.documentElement.clientWidth || document.body.clientWidth || window.innerWidth;
	}
		
	//-------------------------------> Revolution Slider - Fullscreen
	if ( $.isFunction($.fn.revolution) ) {
		$('.tp-banner-fullscreen').show().revolution({
				dottedOverlay:"none",
				delay:16000,
				startwidth:1170,
				startheight:700,
				hideThumbs:200,
				hideTimerBar:"on",
				thumbWidth:100,
				thumbHeight:50,
				thumbAmount:5,
				spinned:"spinner4", //"spinner1" , "spinner2", "spinner3" , "spinner4", "spinner5"
				navigationType:"bullet",
				navigationArrows:"solo",
				navigationStyle:"preview4",
				
				touchenabled:"on",
				onHoverStop:"on",
				lazyLoad:"on",
				
				swipe_velocity: 0.7,
				swipe_min_touches: 1,
				swipe_max_touches: 1,
				drag_block_vertical: false,
										
				parallax:"scroll",
				parallaxBgFreeze:"on",
				parallaxLevels:[10,20,30,40,50,60,70,80,90,100],
										
				keyboardNavigation:"off",
				
				navigationHAlign:"center",
				navigationVAlign:"bottom",
				navigationHOffset:0,
				navigationVOffset:20,
	
				soloArrowLeftHalign:"left",
				soloArrowLeftValign:"center",
				soloArrowLeftHOffset:20,
				soloArrowLeftVOffset:0,
	
				soloArrowRightHalign:"right",
				soloArrowRightValign:"center",
				soloArrowRightHOffset:20,
				soloArrowRightVOffset:0,
						
				shadow:0, //0,1,2,3  (0 == no Shadow, 1,2,3 - Different Shadow Types)
				fullWidth:"off",
				fullScreen:"on",
	
				spinner:"spinner4",
				
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
	
				shuffle:"off",
				
				autoHeight:"off",						
				forceFullWidth:"off",						
										
				hideThumbsOnMobile:"off",
				hideNavDelayOnMobile:1500,						
				hideBulletsOnMobile:"off",
				hideArrowsOnMobile:"off",
				hideThumbsUnderResolution:0,
				
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				startWithSlide:0,
				fullScreenOffsetContainer: offset_header	
		});
		//-------------------------------> Revolution Slider - Fullwidth
		$('.tp-banner-fullwidth').show().revolution({
				dottedOverlay:"none",
				delay:16000,
				startwidth:1170,
				startheight:700,
				hideThumbs:200,
				hideTimerBar:"off",
				thumbWidth:100,
				thumbHeight:50,
				thumbAmount:5,
				spinned:"spinner4", //"spinner1" , "spinner2", "spinner3" , "spinner4", "spinner5"
				navigationType:"bullet",
				navigationArrows:"solo",
				navigationStyle:"preview4",
				
				touchenabled:"on",
				onHoverStop:"on",
				lazyLoad:"on",
				
				swipe_velocity: 0.7,
				swipe_min_touches: 1,
				swipe_max_touches: 1,
				drag_block_vertical: false,
										
				parallax:"scroll",
				parallaxBgFreeze:"off",
				parallaxLevels:[10,20,30,40,50,60,70,80,90,100],
										
				keyboardNavigation:"off",
				
				navigationHAlign:"center",
				navigationVAlign:"bottom",
				navigationHOffset:0,
				navigationVOffset:20,
	
				soloArrowLeftHalign:"left",
				soloArrowLeftValign:"center",
				soloArrowLeftHOffset:20,
				soloArrowLeftVOffset:0,
	
				soloArrowRightHalign:"right",
				soloArrowRightValign:"center",
				soloArrowRightHOffset:20,
				soloArrowRightVOffset:0,
						
				shadow:0, //0,1,2,3  (0 == no Shadow, 1,2,3 - Different Shadow Types)
				fullWidth:"off",
				fullScreen:"on",
	
				spinner:"spinner4",
				
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
	
				shuffle:"off",
				
				autoHeight:"off",						
				forceFullWidth:"off",						
										
				hideThumbsOnMobile:"off",
				hideNavDelayOnMobile:1500,						
				hideBulletsOnMobile:"off",
				hideArrowsOnMobile:"off",
				hideThumbsUnderResolution:0,
				
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				startWithSlide:0,
				fullScreenOffsetContainer: ""	
		});
		
		//-------------------------------> Revolution Slider - Boxedwidth
		$('.tp-banner-boxedwidth').show().revolution({
				dottedOverlay:"none",
				delay:16000,
				startwidth:1170,
				startheight:700,
				hideThumbs:200,
	
				thumbWidth:100,
				thumbHeight:50,
				thumbAmount:5,
	
				navigationType:"bullet",
				navigationArrows:"solo",
				navigationStyle:"preview1",
	
				touchenabled:"on",
				onHoverStop:"on",
				lazyLoad:"on",
	
				swipe_velocity: 0.7,
				swipe_min_touches: 1,
				swipe_max_touches: 1,
				drag_block_vertical: false,
	
										parallax:"scroll",
				parallaxBgFreeze:"off",
				parallaxLevels:[10,20,30,40,50,60,70,80,90,100],
	
				keyboardNavigation:"off",
	
				navigationHAlign:"center",
				navigationVAlign:"bottom",
				navigationHOffset:0,
				navigationVOffset:20,
	
				soloArrowLeftHalign:"left",
				soloArrowLeftValign:"center",
				soloArrowLeftHOffset:20,
				soloArrowLeftVOffset:0,
	
				soloArrowRightHalign:"right",
				soloArrowRightValign:"center",
				soloArrowRightHOffset:20,
				soloArrowRightVOffset:0,
	
				shadow:0,
				fullWidth:"on",
				fullScreen:"off",
	
				spinner:"spinner4",
	
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
	
				shuffle:"off",
	
				autoHeight:"off",
				forceFullWidth:"off",
	
	
	
				hideThumbsOnMobile:"off",
				hideNavDelayOnMobile:1500,
				hideBulletsOnMobile:"off",
				hideArrowsOnMobile:"off",
				hideThumbsUnderResolution:0,
	
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				startWithSlide:0,
				fullScreenOffsetContainer: ""
		});	
		//-------------------------------> Revolution Slider - boxed full screen
		$('.tp-banner-boxedfullscreen').show().revolution({
				dottedOverlay:"none",
				delay:16000,
				startwidth:1170,
				startheight:700,
				hideThumbs:200,
	
				thumbWidth:100,
				thumbHeight:50,
				thumbAmount:5,
	
				navigationType:"bullet",
				navigationArrows:"solo",
				navigationStyle:"preview1",
	
				touchenabled:"on",
				onHoverStop:"on",
				lazyLoad:"on",
	
				swipe_velocity: 0.7,
				swipe_min_touches: 1,
				swipe_max_touches: 1,
				drag_block_vertical: false,
	
										parallax:"scroll",
				parallaxBgFreeze:"on",
				parallaxLevels:[10,20,30,40,50,60,70,80,90,100],
	
				keyboardNavigation:"off",
	
				navigationHAlign:"center",
				navigationVAlign:"bottom",
				navigationHOffset:0,
				navigationVOffset:20,
	
				soloArrowLeftHalign:"left",
				soloArrowLeftValign:"center",
				soloArrowLeftHOffset:20,
				soloArrowLeftVOffset:0,
	
				soloArrowRightHalign:"right",
				soloArrowRightValign:"center",
				soloArrowRightHOffset:20,
				soloArrowRightVOffset:0,
	
				shadow:0,
				fullWidth:"on",
				fullScreen:"on",
	
				spinner:"spinner4",
	
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
	
				shuffle:"off",
				autoHeight:"off",
				forceFullWidth:"off",
	
				hideThumbsOnMobile:"off",
				hideNavDelayOnMobile:1500,
				hideBulletsOnMobile:"off",
				hideArrowsOnMobile:"off",
				hideThumbsUnderResolution:0,
	
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				startWithSlide:0,
				fullScreenOffsetContainer: offset_header
		});
		
		//-------------------------------> Revolution Slider - Panzoom fullscreen
		$('.tp-banner-panzoom-fullscreen').show().revolution({
				dottedOverlay:"none",
				delay:16000,
				startwidth:1170,
				startheight:700,
				hideThumbs:200,
				
				thumbWidth:100,
				thumbHeight:50,
				thumbAmount:5,
				
				navigationType:"bullet",
				navigationArrows:"solo",
				navigationStyle:"preview4",
				
				touchenabled:"on",
				onHoverStop:"on",
				lazyLoad:"on",
				
				swipe_velocity: 0.7,
				swipe_min_touches: 1,
				swipe_max_touches: 1,
				drag_block_vertical: false,
										
										parallax:"scroll",
				parallaxBgFreeze:"on",
				parallaxLevels:[10,20,30,40,50,60,70,80,90,100],
										
				keyboardNavigation:"off",
				
				navigationHAlign:"center",
				navigationVAlign:"bottom",
				navigationHOffset:0,
				navigationVOffset:20,
	
				soloArrowLeftHalign:"left",
				soloArrowLeftValign:"center",
				soloArrowLeftHOffset:20,
				soloArrowLeftVOffset:0,
	
				soloArrowRightHalign:"right",
				soloArrowRightValign:"center",
				soloArrowRightHOffset:20,
				soloArrowRightVOffset:0,
						
				shadow:0,
				fullWidth:"off",
				fullScreen:"on",
	
				spinner:"spinner4",
				
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
	
				shuffle:"off",
				
				autoHeight:"off",						
				forceFullWidth:"off",						
										
				hideThumbsOnMobile:"off",
				hideNavDelayOnMobile:1500,						
				hideBulletsOnMobile:"off",
				hideArrowsOnMobile:"off",
				hideThumbsUnderResolution:0,
				
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				startWithSlide:0,
				fullScreenOffsetContainer: offset_header	
		});
		
		//-------------------------------> Revolution Slider - Panzoom fullwidth
		$('.tp-banner-panzoom-fullwidth').show().revolution({
				dottedOverlay:"none",
				delay:16000,
				startwidth:1170,
				startheight:700,
				hideThumbs:200,
				
				thumbWidth:100,
				thumbHeight:50,
				thumbAmount:5,
				
				navigationType:"bullet",
				navigationArrows:"solo",
				navigationStyle:"preview4",
				
				touchenabled:"on",
				onHoverStop:"on",
				lazyLoad:"on",
				
				swipe_velocity: 0.7,
				swipe_min_touches: 1,
				swipe_max_touches: 1,
				drag_block_vertical: false,
										
				parallax:"scroll",
				parallaxBgFreeze:"off",
				parallaxLevels:[10,20,30,40,50,60,70,80,90,100],
										
				keyboardNavigation:"off",
				
				navigationHAlign:"center",
				navigationVAlign:"bottom",
				navigationHOffset:0,
				navigationVOffset:20,
	
				soloArrowLeftHalign:"left",
				soloArrowLeftValign:"center",
				soloArrowLeftHOffset:20,
				soloArrowLeftVOffset:0,
	
				soloArrowRightHalign:"right",
				soloArrowRightValign:"center",
				soloArrowRightHOffset:20,
				soloArrowRightVOffset:0,
						
				shadow:0,
				fullWidth:"off",
				fullScreen:"off",
	
				spinner:"spinner4",
				
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
	
				shuffle:"off",
				
				autoHeight:"off",						
				forceFullWidth:"off",						
										
				hideThumbsOnMobile:"off",
				hideNavDelayOnMobile:1500,						
				hideBulletsOnMobile:"off",
				hideArrowsOnMobile:"off",
				hideThumbsUnderResolution:0,
				
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				startWithSlide:0,
				fullScreenOffsetContainer: offset_header	
		});
		
		//-------------------------------> Revolution Slider - HTML5 fullwidth
		$('.tp-banner-video-fullwidth').show().revolution({
				dottedOverlay:"none",
				delay:16000,
				startwidth:1170,
				startheight:700,
				hideThumbs:200,
				hideTimerBar:"off",
				thumbWidth:100,
				thumbHeight:50,
				thumbAmount:5,
				spinned:"spinner4", //"spinner1" , "spinner2", "spinner3" , "spinner4", "spinner5"
				navigationType:"bullet",
				navigationArrows:"solo",
				navigationStyle:"preview4",
				
				touchenabled:"on",
				onHoverStop:"on",
				lazyLoad:"on",
				
				swipe_velocity: 0.7,
				swipe_min_touches: 1,
				swipe_max_touches: 1,
				drag_block_vertical: false,
										
				parallax:"scroll",
				parallaxBgFreeze:"off",
				parallaxLevels:[10,20,30,40,50,60,70,80,90,100],
										
				keyboardNavigation:"off",
				
				navigationHAlign:"center",
				navigationVAlign:"bottom",
				navigationHOffset:0,
				navigationVOffset:20,
	
				soloArrowLeftHalign:"left",
				soloArrowLeftValign:"center",
				soloArrowLeftHOffset:20,
				soloArrowLeftVOffset:0,
	
				soloArrowRightHalign:"right",
				soloArrowRightValign:"center",
				soloArrowRightHOffset:20,
				soloArrowRightVOffset:0,
						
				shadow:0, //0,1,2,3  (0 == no Shadow, 1,2,3 - Different Shadow Types)
				fullWidth:"on",
				fullScreen:"off",
	
				spinner:"spinner4",
				
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
	
				shuffle:"off",
				
				autoHeight:"off",						
				forceFullWidth:"off",						
										
				hideThumbsOnMobile:"off",
				hideNavDelayOnMobile:1500,						
				hideBulletsOnMobile:"off",
				hideArrowsOnMobile:"off",
				hideThumbsUnderResolution:0,
				
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				startWithSlide:0,
				fullScreenOffsetContainer: offset_header	
		});
		
		//-------------------------------> Revolution Slider - HTML5 fullscreen
		$('.tp-banner-video-fullscreen').show().revolution({
				dottedOverlay:"none",
				delay:16000,
				startwidth:1170,
				startheight:700,
				hideThumbs:200,
				hideTimerBar:"off",
				thumbWidth:100,
				thumbHeight:50,
				thumbAmount:5,
				spinned:"spinner4", //"spinner1" , "spinner2", "spinner3" , "spinner4", "spinner5"
				navigationType:"bullet",
				navigationArrows:"solo",
				navigationStyle:"preview4",
				
				touchenabled:"on",
				onHoverStop:"on",
				lazyLoad:"on",
				
				swipe_velocity: 0.7,
				swipe_min_touches: 1,
				swipe_max_touches: 1,
				drag_block_vertical: false,
										
				parallax:"scroll",
				parallaxBgFreeze:"off",
				parallaxLevels:[10,20,30,40,50,60,70,80,90,100],
										
				keyboardNavigation:"off",
				
				navigationHAlign:"center",
				navigationVAlign:"bottom",
				navigationHOffset:0,
				navigationVOffset:20,
	
				soloArrowLeftHalign:"left",
				soloArrowLeftValign:"center",
				soloArrowLeftHOffset:20,
				soloArrowLeftVOffset:0,
	
				soloArrowRightHalign:"right",
				soloArrowRightValign:"center",
				soloArrowRightHOffset:20,
				soloArrowRightVOffset:0,
						
				shadow:0, //0,1,2,3  (0 == no Shadow, 1,2,3 - Different Shadow Types)
				fullWidth:"on",
				fullScreen:"on",
	
				spinner:"spinner4",
				
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
	
				shuffle:"off",
				
				autoHeight:"off",						
				forceFullWidth:"off",						
										
				hideThumbsOnMobile:"off",
				hideNavDelayOnMobile:1500,						
				hideBulletsOnMobile:"off",
				hideArrowsOnMobile:"off",
				hideThumbsUnderResolution:0,
				
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				startWithSlide:0,
				fullScreenOffsetContainer: offset_header	
		});
	};
	
})(window.jQuery);