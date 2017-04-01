$(document).ready(function(){

	$('<div class="dropZone">Drop for download</div>').prependTo('div[class*="innerItem"]');
	
	$(document).on(
		'dragover', '.dropZone', function(e) {
			$(this).addClass('hover');
			$(this).css({
				'line-height': $(this).height() + 'px'
			});
		}
	);
	
	$(document).on(
		'dragleave', '.dropZone', function(e) {
			$(this).removeClass('hover');

		}
	);
	
	// $('div[class*="innerItem"]').bind({
	// 	dragover: function(e) {
	// 		if (e.target == this) {
 //         			return;
 //    		}
	// 		$(this).addClass('hover');
	// 	},
	// 	dragleave: function(e) {
	// 		if (e.target == this) {
 //         			return;
 //    		}
	// 		$(this).removeClass('hover');
	// 	}
	// });
	


	// var $dropZone = $('div[class*="innerItem"]'); 
  
 //    $dropZone.bind({
	// 	    dragover: function(e) {
	// 	    	if (e.target == this) {
 //         			return;
 //    			}
	// 		    $(this).addClass('hover');
	// 	    },
	// 	    dragleave: function(e) {
	// 	    	if (e.target == this) {
 //         			return;
 //    			}
	// 		    $(this).removeClass('hover');
	// 	    }
	// }); 






		
	

});