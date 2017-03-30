$(document).ready(function(){

	var dropZone = document.querySelectorAll('div[class$="innerItem"]'),
		$dropZone = $('div[class$="innerItem"]'),
		maxFileSize = 1000000;

	// if (typeof(window.FileReader) == 'undefined') {
	// 	dropZone.addClass('error');
	// }
	

  for (var i = 0; i < dropZone.length; i++) {
    	dropZone[i].ondragover = function() {
			dropZone[i].classList.add('hover');
		}

		dropZone[i].ondragleave = function() {
			dropZone[i].classList.remove('hover');
		}
  }




		
	

});