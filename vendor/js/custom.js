$(document).ready(function() {	


	$(".fa-search").click(function(){
		$("#global_search").focus();
	});

	$(".add_to_wishlist").click(function() {  
		$(".cabin_count").addClass("highlighted");
		setTimeout(function () {
            $('.cabin_count').removeClass('highlighted');
        }, 1000);
	 });
		 
  
	//sticky header
	var hHeight = $('.header').outerHeight(true);
	$(window).scroll(function() {
		
		if ($(window).scrollTop() >= hHeight) {
			$('.header').addClass('stickyheader');
		}
		else {
			$('.header').removeClass('stickyheader');
		}		
	});
	if (!$('body').hasClass('pageheadoverlay')) {
		$('body').css('padding-top', hHeight);
	}

	//Drawer Menu
	$(".navtrigger").on("click", function(e) {
		$(".navigation").addClass("active");
		e.stopPropagation()
	});
	$(document).on("click", function(e) {
		if ($(e.target).is(".navigation, .navigation * ") === false || $(e.target).is(".closenav img") === true) {
			$(".navigation").removeClass("active");
		}
	});

	//Header Searchbar
	$(".searchtrigger").on("click", function() {
		$(".headersearch").addClass("active");
	});
	$(".btn-search").on("click", function() {
		$(".headersearch").removeClass("active");
	});

	//Header Searchbar
	$(".searchtrigger").on("click", function() {
		$(".headersearch").addClass("active");
	});
	$(".btn-search").on("click", function() {
		$(".headersearch").removeClass("active");
	});

	// Owl Carousels
	var owl = $('.owl-carousel-1');
	owl.owlCarousel({
		stagePadding: 10,
		margin: 10,
		nav: true,
		loop: true,
		dots: false,
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 2
			},
			992: {
				items: 3
			},
			1200: {
				items: 4
			}
		}
	});

	var owl = $('.owl-carousel-producer');
	owl.owlCarousel({
		stagePadding: 10,
		margin: 10,
		nav: true,
		loop: true,
		dots: false,
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 2
			},
			992: {
				items: 3
			},
			1200: {
				items: 4
			}
		}
	});
	
	var owl = $('.owl-carousel-2');
	owl.owlCarousel({
		stagePadding: 10,
		margin: 10,
		nav: true,
		loop: true,
		dots: false,
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});

	var owl = $('.owl-carousel-cabin');
	owl.owlCarousel({
		stagePadding: 10,
		margin: 10,
		autoplay: true,
		nav: true,
		loop: true,
		dots: false,
		responsive: {
			0: {
				items: 2
			},
			576: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});
	
	var owl = $('.carousel-cabinimg');
	owl.owlCarousel({
		margin: 0,
		nav: false,
		loop: true,
		dots: true,
		responsive: {
			0: {
				items: 1
			}
		}
	});

	//Carousel Cabin Profile
	if ( $(window).width() < 768 ) {
		startCarousel();
	} else {
		$('.carousel-cabprofile').addClass('off');
	}
	$(window).resize(function() {
		if ( $(window).width() < 768 ) {
			startCarousel();
		} else {
			stopCarousel();
		}
	});
	function startCarousel(){
		$(".carousel-cabprofile").owlCarousel({
			margin:0,
			nav:false,
			loop:true,
			dots: true,
			responsive: {
				0: {
					items: 1
				}
			}
		});
	}
	function stopCarousel() {
		var owl = $('.carousel-cabprofile');
		owl.trigger('destroy.owl.carousel');
		owl.addClass('off');
	}

	//Range Slider
	$('body').bootstrapMaterialDesign();

	//Tooltip
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});

	//Datatables
	$('#datatable').DataTable({
		// "paging": false
	});

// scroll back to top
	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
	// scroll body to 0px on click
	$('#back-to-top').click(function () {
		$('#back-to-top').tooltip('hide');
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	
	$('#back-to-top').tooltip('show');


});
