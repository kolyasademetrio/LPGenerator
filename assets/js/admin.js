$(document).ready(function(){

	$('<div class="drop__zone">Drop for download</div>').prependTo('div[class*="innerItem"]');
	
	$(document).on(
		'dragover', '.drop__zone', function(e) {
			e.preventDefault();
			$(this).addClass('drop__hover');
			$(this).css({
				'line-height': $(this).height() + 'px'
			});
			$(this).text('Drop for download');

			// if ($(this).hasClass('drop')) {
			// 	$(this).addClass('dropHover');
			// }
		}
	).on(
		'dragleave', '.drop__zone', function(e) {
			e.preventDefault();
			$(this).removeClass('drop__hover');
			// if ($(this).hasClass('drop')) {
			// 	$(this).removeClass('dropHover');
			// 	$(this).text('Dropped');
			// }
		}
	).on(
		'drop', '.drop__zone', function(e) {
			e.preventDefault();
			
    		// $(this).addClass('drop');
			$(this).removeClass('drop__hover');
			// $(this).text('Dropped');
			
			// e.dataTransfer = e.originalEvent.dataTransfer;
			e.dataTransfer = e.originalEvent.dataTransfer;
			
			// $.event.props.push('dataTransfer');
       		var files = e.dataTransfer.files;

       		loadInView(e,files);

       		var xhr = new XMLHttpRequest();
			$this = $(this);
			xhr.upload.addEventListener('progress', uploadProgress.bind(null, $this), false);
			//xhr.this = $(this);
			// xhr.onreadystatechange = stateChange;
			xhr.open('POST', '/handler.php');
			xhr.setRequestHeader('X-FILE-NAME', files.name);
			xhr.send(files);
		}
	);

	/* -------------------------------------------------------------------------------
	----------------------------------------------------------------------------------*/
	var dataArray = [];
	var filesLength;
	var FReventTarget;


	// Функция загрузки изображений на предпросмотр
   function loadInView(event, files) {

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

	function uploadProgress($this, event) {
	    var percent = parseInt(event.loaded / event.total * 100);
	    $this.text('Загрузка: ' + percent + '%').addClass('download__result');
	}

	function stateChange(event) {
	    if (event.target.readyState == 4) {
	        if (event.target.status == 200) {
	            dropZone.text('Загрузка успешно завершена!');
	        } else {
	            dropZone.text('Произошла ошибка!');
	            dropZone.addClass('error');
	        }
	    }
	}

});