<?php
if(isset($notices) && is_array($notices)) {
	echo '<option value="all" selected="selected" >All Vacancies</option>';
	foreach($notices as $key=>$value)
	{		
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
}
?>