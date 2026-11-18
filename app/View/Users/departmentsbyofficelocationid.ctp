<?php
if(isset($departments) && is_array($departments)) {
	echo '<option value="" selected="selected" >--Select Department--</option>';
	foreach($departments as $key=>$value)
	{		
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
}
?>