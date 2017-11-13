<?php

		$mysqli = NEW  MySQLi('localhost', 'root', 'root' , 'hmr_db') ;

		$result = $mysqli->query("SELECT t_name from teacher where t_dept='IT' ") ;
		
		//list having all teachers name of IT
		$all_teacher_name= [] ;
		$it_teacher_time_table =[[[]]] ; 

		$index = 0;
		while($row = mysqli_fetch_assoc($result)){ // loop to store the data in an associative array.
     			$all_teacher_name[$index] = $row['t_name'];
     			$name = $row['t_name'] ;
     			//echo "-".$name."-";
     			for($t_day =0 ; $t_day<5 ; $t_day++)
				{
					//loop for oterating over lecture of each day of each teacher
					for($t_lctr=0 ; $t_lctr<8 ; $t_lctr++)
					{
							$it_teacher_time_table[$name][$t_day][$t_lctr] = "0" ;
					}
				}


     			$index++;
		}
		
		
		

		

		// upto here we have created a matrix for storing teacher's time table and initially they are all empty . As we will traverse through class time tables we will be filling teacher time table ; 

		// this  php file will be included in all the scripts of class time table 
		

?>
	
