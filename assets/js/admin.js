$(document).ready(function(){


// сделать проверку на наличие картинки внутри!!!!!!!!!!!!!!!!!!!!!!!!++атрибут for для каждого input
	// $('<label for="sect_1" class="drop__zone">Drop for download</label>').prependTo('div[class*="innerItem"]');
	



$('.container').each(function(){
	var className = $(this).parent().attr('class');
	if ($(this).find('img').length > 0) {
		$(this).find('div[class*="innerItem"]').each(function(index, elem){
			var attrFor = className + '_' + ++index;
			$('<label for="' + attrFor + '" class="drop__zone">Drop for download</label>').prependTo(elem);
		});
	}
});









	// var count = 1;
	// $('div[class*="innerItem"]').each(function(){
	// 	var img = $(this).find('img');

	// 	if(img.length > 0){

	// 		$('<label for="partners_' + count + '" class="drop__zone">Drop for download</label>').prependTo( $(this) );

	// 	}

	// 	count++;
	// })

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
			
			$(this).removeClass('drop__hover');
			
			e.dataTransfer = e.originalEvent.dataTransfer;
			
			// $.event.props.push('dataTransfer');
       		var files = e.dataTransfer.files;

       		loadInView(e,files);

   //     		var xhr = new XMLHttpRequest();
			// $this = $(this);
			// xhr.upload.addEventListener('progress', uploadProgress.bind(null, $this), false);

			// xhr.open('POST', 'handler.php');
			// xhr.setRequestHeader('X-FILE-NAME', files.name);
			// xhr.send(files);

			var parentIndex = $(this).parent().index();

			$(this).parents('.container').parent().next('.container').find('.input_file_type').eq(parentIndex).find("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);

			// $(this).parents('.container').parent().next('.container').find("input[type='file']").prop("files", e.originalEvent.dataTransfer.files).closest("form").submit();
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
		// console.log(event.target.readyState);
	    if (event.target.readyState == 4) {
	        if (event.target.status == 200) {
	            dropZone.text('Загрузка успешно завершена!');
	        } else {
	            dropZone.text('Произошла ошибка!');
	            dropZone.addClass('error');
	        }
	    }
	}

	// скрыть-показать поле input[type="text"][name="section_name"]
	var toggled = true;
	$('.section_name_hide_btn').on('click', function(e){
		e.preventDefault();
		
		$('.section_name_input_wrap').slideToggle();
		$(this).text(toggled ? 'Скрыть дополнительное поле' : 'Показать дополнительное поле');
		toggled = !toggled;
	});


});/* $(document).ready(function(){ End */