<?php 

function check_csrf($csrf){
	$csrf = preg_replace('/[^0-9a-f]/','', $csrf);
	return $csrf == $_SESSION['csrf'];
}
function generate_csrf(){
	$refrence_string = "tcxn0z2fvpydbwuqo7ils1hagjrk34e69m58";
	$csrf = '';
	for($i=0; $i<9; $i++){
		$idx = mt_rand($i,35);
		$csrf.= $refrence_string[$idx];
	}
	return sha1($csrf);
}
?>