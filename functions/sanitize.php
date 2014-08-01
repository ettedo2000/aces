<?php
//sanatzing escaping strings comming in 

function escape($string) {
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
?>