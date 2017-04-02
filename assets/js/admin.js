$(document).ready(function(){

	$('<div class="dropZone">Drop for download</div>').prependTo('div[class*="innerItem"]');
	
	$(document).on(
		'dragover', '.dropZone', function(e) {
			e.preventDefault();
			$(this).addClass('dropHover');
			$(this).css({
				'line-height': $(this).height() + 'px'
			});
			$(this).text('Drop for download');

			// if ($(this).hasClass('drop')) {
			// 	$(this).addClass('dropHover');
			// }
		}
	).on(
		'dragleave', '.dropZone', function(e) {
			e.preventDefault();
			$(this).removeClass('dropHover');

			// if ($(this).hasClass('drop')) {
			// 	$(this).removeClass('dropHover');
			// 	$(this).text('Dropped');
			// }
		}
	).on(
		'drop', '.dropZone', function(e) {
			e.preventDefault();
    		// $(this).addClass('drop');
			$(this).removeClass('dropHover');
			// $(this).text('Dropped');
       		var files = event.dataTransfer.files;

       		loadInView(files);
		}
	);

	/* -------------------------------------------------------------------------------
	----------------------------------------------------------------------------------*/
	var dataArray = [];
	var filesLength;
	var FReventTarget;


	// Функция загрузки изображений на предпросмотр
   function loadInView(files) {
      // Для каждого файла
		$.each(files, function(index, file) {
			if (files[index].type.match('image.*')) {

	            var eventTarget = event.target;

	         	// Создаем новый экземпляра FileReader
	        	var fileReader = new FileReader();

	        	fileReader.eventTarget = eventTarget;

	            // Инициируем функцию FileReader
	        	fileReader.onload = (function(file) {
	               
					return function(e) {
						// Помещаем URI изображения в массив
						dataArray.push({name : file.name, value : this.result});
						filesLength = files.length;
						FReventTarget = fileReader.eventTarget;

						addImage((dataArray.length-1), filesLength, FReventTarget);
					}; 
	                  
	        	})(files[index]);
				// Производим чтение картинки по URI
				fileReader.readAsDataURL(file);
			}

		});
      	return false;
   }

   // Процедура добавления эскизов на страницу
	function addImage(ind, filesLength, FReventTarget) {
		if (filesLength == 1) {
			if (ind < 0 ) { 
				start = 0; end = dataArray.length; 
			} else {
				// иначе только определенное изображение 
				start = ind; end = ind+1;
			} 
			// Цикл для каждого элемента массива
			for (i = start; i < end; i++) {
				// размещаем загруженные изображения
				var className = $(FReventTarget).parent().find('img').attr('class');
				$(FReventTarget).parent().find('img').parent().html('<img src="' + dataArray[i].value + '" class="' + className + '">');
			}
			return false;
		}
	}



	// var xhr = new XMLHttpRequest();
	// xhr.upload.addEventListener('progress', uploadProgress, false);
	// xhr.onreadystatechange = stateChange;
	// xhr.open('POST', '/handler.php');
	// xhr.setRequestHeader('X-FILE-NAME', file.name);
	// xhr.send(file);

	// console.log(xhr);
	
	
	$('div[class*="innerItem"]').bind({
		dragover: function(e) {
			if (e.target == this) {
         			return;
    		}
			$(this).addClass('hover');
		},
		dragleave: function(e) {
			if (e.target == this) {
         			return;
    		}
			$(this).removeClass('hover');
		}
	});
});