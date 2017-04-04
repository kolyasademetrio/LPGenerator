<div class="bootstrap_classes">
<?php
$select_options = array(
		'col_lg'     => 'больше 1200',
		'col_md'     => 'больше 992',
		'col_sm'     => 'больше 768',
		'col_xs_768' => 'меньше 768',
		'col_xs_479' => 'меньше 479',
		'col_xs_380' => 'меньше 380',
	);

foreach ($select_options as $attr_name => $lable_text) {
?>	
	<div class="bootstrap_classes_item">
		<label>Кол-во колонок для разрешения <?php echo $lable_text ?>px:
			<select name="<?php echo $attr_name; ?>">
				<option value="">Выбрать</option>
				<option value="12">Одна</option>
				<option value="6">Две</option>
				<option value="4">Три</option>
				<option value="3">Четыре</option>
				<option value="20per">Пять</option>
				<option value="2">Шесть</option>
				<option value="1">Двенадцать</option>      
			</select>
		</label>
	</div><!-- .bootstrap_classes_item -->
<?php	
}
?>
</div><!-- bootstrap_classes -->
