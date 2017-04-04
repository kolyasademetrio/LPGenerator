<div class="section_name_form">
	<form action="handler.php" name="section_name_form" method="POST">
		<div class="section_name_btn_wrap text-center">
			<a href="#" class="section_name_hide_btn">Показать дополнительное поле</a>
		</div>
		<div class="section_name_input_wrap text-center">
			<input type="text" name="<?php echo ${$global_arr}['$section_name']; ?>" placeholder="<?php echo ${$global_arr}['$section_name']; ?>">

			<input name="id" hidden="hidden" value="<?php echo ${$global_arr}['id']; ?>">
			<input type="submit" value="Изменить класс контейнера" name="mysubmit">
		</div>
	</form>
</div><!-- .section_name_form -->