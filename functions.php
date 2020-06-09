<?php 
	
	function username_exists($username, $link)
	{
		$result = mysqli_query($link,"SELECT id FROM users WHERE username='$username'");
		
		if(mysqli_num_rows($result) == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	
	