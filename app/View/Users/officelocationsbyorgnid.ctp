<?php
if(isset($officeLocations) && is_array($officeLocations)) {
	echo '<option value="" selected="selected" >--Select Office Location--</option>';
	foreach($officeLocations as $key=>$value)
	{		
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
}
?>