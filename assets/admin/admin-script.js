$(document).ready(function(){

	function() {
					$popupId.find('form').ajaxSubmit(function(){
						var $formContent = $popupId.find('.popup__inner').html(),
							fd = new FormData();
						if ($popupId.find('input[name="name"]').length > 0) {
							fd.append('name', $popupId.find('input[name="name"]').val());
						}
						
						if ($popupId.find('input[name="phone"]').length > 0) {
							fd.append('phone', $popupId.find('input[name="phone"]').val());
						}

						if ($popupId.find('input[name="email"]').length > 0) {
							fd.append('email', $popupId.find('input[name="email"]').val());
						}

						if ($popupId.find('.popup__title').length > 0) {
							fd.append( 'popup__title', $popupId.find('.popup__title').text() );
						}
						
						$.ajax({
							type: "POST",
							url: "handler.php",
							data: fd,
							contentType: false,
							cache: false,
							processData: false,
							success: function(data){
								$popupId.find('.popup__inner').html(data);
								$popupId.find('.popup__close').on('click', function(){
									$popupId.find('.popup__inner').html($formContent);
								});
							},
							beforeSend: function(){
									// alert($('.popup__title').text());
							}
		       			})
					});
				}
			

});