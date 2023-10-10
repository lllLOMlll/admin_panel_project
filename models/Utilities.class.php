<?php
class Utilities {
	
	public function unsetSessionVariable ($sessionVariable) {
		if (isset($_SESSION[$sessionVariable])) {
			unset($_SESSION[$sessionVariable]);  
		} 
	}




}
?>