$(window).load(function() {
    $('.partnerReviews__flexslider').flexslider({
		animation: "slide",
		controlNav: true,
		directionNav: true,
		prevText: "",
		nextText: "",
		smoothHeight: true,
		startAt: 0,
		slideshow: false,
		slideshowSpeed: 2000,
		pauseOnAction: true,
    });
});


//flexslider initialization
(function() {

	// store the slider in a local variable
	var $window = $(window),
	flexslider = { vars:{} };

	// tiny helper function to add breakpoints
	function getGridSize() {
		return (window.innerWidth < 479) ? 1 :
			(window.innerWidth < 768) ? 2 :
			(window.innerWidth < 992) ? 3 :
			(window.innerWidth < 1200) ? 4 : 5;
	}

	$window.load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			controlNav: false,
			directionNav: true,
			slideshow: false,
			slideshowSpeed: 5000,
			pauseOnAction: true,
			startAt: 0,
			prevText: "",
			nextText: "",
			// minItems: 1,
			maxItems: 5,
			itemWidth: 150,
			animationLoop: true,
			move: 1,
			minItems: getGridSize(), // use function to pull in initial value
			maxItems: getGridSize(), // use function to pull in initial value
			start: function (slider) {
				flexslider = slider; //Initializing flexslider here.
			}
		});
	});

	// check grid size on resize event
	$window.resize(function() {
		var gridSize = getGridSize();

		flexslider.vars.minItems = gridSize;
		flexslider.vars.maxItems = gridSize;
	});
}());

$(document).ready(function() {
	$('.weProduce__orderBtn').magnificPopup({
		type:'inline',
		removalDelay: 500,
		mainClass: 'mfp-fade popup_inline',
		showCloseBtn: true,
		closeMarkup: '<div class="mfp-close">x</div>',
		closeBtnInside: true,
		closeOnContentClick: false,
		closeOnBgClick: true,
		alignTop: false,
		fixedContentPos: true
	});

	$('.gallery__link').magnificPopup({
		type: 'image',
		removalDelay: 500,
		mainClass: 'mfp-fade popup_image',
		showCloseBtn: true,
		closeMarkup: '<div class="mfp-close">x</div>',
		closeBtnInside: true,
		closeOnContentClick: false,
		closeOnBgClick: true,
		alignTop: false,
		fixedContentPos: true,
		gallery: {
			enabled: true
		}
	});

	// $('.wrapper').each(function() {
	// 	$(this).magnificPopup({
	// 		delegate: '.link',
	// 		type: 'image',
	// 		removalDelay: 500,
	// 		mainClass: 'mfp-fade popup_image',
	// 		showCloseBtn: true,
	// 		closeMarkup: '<div class="mfp-close">x</div>',
	// 		closeBtnInside: true,
	// 		closeOnContentClick: false,
	// 		closeOnBgClick: true,
	// 		alignTop: false,
	// 		fixedContentPos: true,
	// 		gallery: {
	// 			enabled:true
	// 		}  
	// 	});
	// });

});

