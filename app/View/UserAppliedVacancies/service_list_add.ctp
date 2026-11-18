<?php
if(isset($notices) && is_array($notices)) {
	//echo '<option value="" selected="selected">--Select Port--</option>';
	//pr($notices);
	echo '<option value="" selected="selected">--select--</option>';
	foreach($notices as $key=>$value)
	{		
		echo '<option  value="'.$value['Notice']['id'].'" id="advertise">'.$value['Notice']['advt_number'].'</option>';
	}
}
?>