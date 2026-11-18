<?php
if(isset($cities) && is_array($cities)) {
	echo '<option value="" selected="selected" >--Select City--</option>';
	foreach($cities as $key=>$value)
	{		
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
}
?>