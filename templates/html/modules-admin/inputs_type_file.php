<div class="inputs_type_file row">
<?php for ($i = 0, $y = 1; $i < ${$global_arr}['count_col']; $i++,$y++) : ?>
	<div class="col-xs-<?php echo ${$global_arr}['col_lg']; ?> input_file_type">
	 	<input type="file" name="input_type_file_<?php echo ${$global_arr}['section_name'] . '_' . $y ?>" id="input_type_file_<?php echo ${$global_arr}['section_name'] . '_' . $y ?>">
 	</div>
<?php endfor; ?>
</div>