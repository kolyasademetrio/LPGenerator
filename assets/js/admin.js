$(document).ready(function(){

	// перемещение контейнеров с шаблоном вверх/вниз
    $(".up").click(function(){
        var psect = $(this).parent('section');
        psect.insertBefore(psect.prev());


        $('section.section').each(function(index){
        	var sect_index = ++index;
        	$(this).attr('index', sect_index);
        });

        return false
    });
    $(".down").click(function(){
        var psect = $(this).parent('section');
        psect.insertAfter(psect.next());

        $('section.section').each(function(index){
        	var sect_index = ++index;
        	$(this).attr('index', sect_index);
        });

        return false
    });


	// добавляет тег label для открытие окна выбора файла по клику на картинке
	$('.container').each(function(){
		var className = $(this).parent().attr('class');
		if ($(this).find('img').length > 0) {
			$(this).find('div[class*="innerItem"]').each(function(index, elem){
				var attrFor = 'input_type_file_' + className + '_' + ++index;
				$(elem).find('img').parent().prepend('<label for="' + attrFor + '" class="drop__zone">Drop for download</label>');
				$(elem).find('img').parent().css({'position':'relative'});
			});
		}
	});

	// вывести загруженное фото в аттрибут src тега img
	$('input[type="file"]').change(function(event){
		if ( event.target.files[0].type.match('image.*') ) {
			var file = event.target.files[0];
			var attrName = $(this).attr('name');
		
			var reader = new FileReader();
  			reader.onload = function(event) {
    			$('label[for="' + attrName + '"]').next('img').attr('src', event.target.result);
 		 	};
  			reader.readAsDataURL(file);
		}
	});

	// по клику на надпись и input[type="checkbox"] делаем клик на input[type="checkbox"] в форме которая формирует страницу
	$('.block_selected_label').on('click', function(){
		var forAttrValue = $(this).attr('for');
		$(this).next('.block_selected_checkbox').click();
	});

	$('.block_selected_checkbox').on('click', function(){
		var forAttrValue = $(this).siblings('span').attr('for');
		$('#' + forAttrValue).click();
	});


	// скрыть-показать поле input[type="text"][name="section_name"]
	// var toggled = true;
	// $('.section_name_hide_btn').on('click', function(e){
	// 	e.preventDefault();
		
	// 	$('.section_name_input_wrap').slideToggle();
	// 	$(this).text(toggled ? 'Скрыть дополнительное поле' : 'Показать дополнительное поле');
	// 	toggled = !toggled;
	// });

	// $(document).on(
	// 	'dragover', '.drop__zone', function(e) {
	// 		e.preventDefault();
	// 		$(this).addClass('drop__hover');
	// 		$(this).css({
	// 			'line-height': $(this).height() + 'px'
	// 		});
	// 		$(this).text('Drop for download');
	// 	}
	// ).on(
	// 	'dragleave', '.drop__zone', function(e) {
	// 		e.preventDefault();
	// 		$(this).removeClass('drop__hover');
	// 	}
	// ).on(
	// 	'drop', '.drop__zone', function(e) {
	// 		e.preventDefault();
			
	// 		$(this).removeClass('drop__hover');
			
	// 		e.dataTransfer = e.originalEvent.dataTransfer;
			
 //       		var files = e.dataTransfer.files;

 //       		loadInView(e,files);

 //   			// var xhr = new XMLHttpRequest();
	// 		// $this = $(this);
	// 		// xhr.upload.addEventListener('progress', uploadProgress.bind(null, $this), false);

	// 		// xhr.open('POST', 'handler.php');
	// 		// xhr.setRequestHeader('X-FILE-NAME', files.name);
	// 		// xhr.send(files);

	// 		var parentIndex = $(this).parent().index();

	// 		$(this).parents('.container').parent().next('.container').find('.input_file_type').eq(parentIndex).find("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);
	// 	}
	// );

	/* -------------------------------------------------------------------------------
	----------------------------------------------------------------------------------*/
	// var dataArray = [];
	// var filesLength;
	// var FReventTarget;


	// Функция загрузки изображений на предпросмотр
  //  function loadInView(event, files) {

		// $.each(files, function(index, file) {

		// 	if (files[index].type.match('image.*')) {

	 //            var eventTarget = event.target;

	 //        	var fileReader = new FileReader();

	 //        	fileReader.eventTarget = eventTarget;

	 //        	fileReader.onload = (function(file) {
	               
		// 			return function(e) {
		// 				dataArray.push({name : file.name, value : this.result});
		// 				filesLength = files.length;
		// 				FReventTarget = fileReader.eventTarget;

		// 				addImage((dataArray.length-1), filesLength, FReventTarget);
		// 			}; 
	                  
	 //        	})(files[index]);
		// 		fileReader.readAsDataURL(file);
		// 	}

		// });
  //     	return false;
  //  }

   // Процедура добавления эскизов на страницу
	// function addImage(ind, filesLength, FReventTarget) {
	// 	if (filesLength == 1) {
	// 		if (ind < 0 ) { 
	// 			start = 0; end = dataArray.length; 
	// 		} else {
	// 			start = ind; end = ind+1;
	// 		} 
	// 		for (i = start; i < end; i++) {
	// 			var className = $(FReventTarget).parent().find('img').attr('class');
	// 			$(FReventTarget).parent().find('img').parent().html('<img src="' + dataArray[i].value + '" class="' + className + '">');
	// 		}
	// 		return false;
	// 	}
	// }

	// function uploadProgress($this, event) {
	//     var percent = parseInt(event.loaded / event.total * 100);
	//     $this.text('Загрузка: ' + percent + '%').addClass('download__result');
	// }

	// function stateChange(event) {
	//     if (event.target.readyState == 4) {
	//         if (event.target.status == 200) {
	//             dropZone.text('Загрузка успешно завершена!');
	//         } else {
	//             dropZone.text('Произошла ошибка!');
	//             dropZone.addClass('error');
	//         }
	//     }
	// }

	



});/* $(document).ready(function(){ End */