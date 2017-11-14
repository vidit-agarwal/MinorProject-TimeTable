
<?php
	session_start() ;
	// an array for time table
	$time_table_3yr = [[]] ;

	//initialise the time table 
	for($i=0 ; $i<5 ; $i++)
			for($j=0 ;$j<8 ; $j++ )
					$time_table_3yr[$i][$j]="0";



	$teacher_list_sub= array() ;
	$teacher_list_lab= array() ;

	//setting the values of the choice filling  from the database ;
	//subject 

	$teacher_list_sub= array(
		array("ADA" , "Mr_DK_Mishra") ,
		array("SE" , "Ms_Samrity_Khurana" ),
		array("JAVA" , "Mr_Atul") ,
		array("IM" , "Mr_Prakash") , // outer dept sub
 		array("CS",  "Ms_Mukti") , // outer dept sub
		array("CSP" , "Dr_Taruna")  //outer dept  subject
		) ;
	
	


	$total_sub_third_year = count($teacher_list_sub) ;
	
	//labs 

	$teacher_list_lab= array(
		
		array("ADA-L",  "Mr_DK_Mishra")	,  // bca shafique sir has choosen theory foc 	
		array("SE-L" , "Ms_Samrity_Khurana") ,
		array("JAVA-L" , "Mr_Atul"),
		array("CS-L" , "Ms_Mukti" ),
		array("CSP-L", "Dr_Taruna")
		
		) ;


	$total_lab_third_year = count($teacher_list_lab) ;

	$total_working_days = 5 ;
	

	//divide the class into twio groups acc to lab ;

	$lab_grp = [[]] ;

	// following code to make lab grp 
	for($lab_day=0 ; $lab_day<$total_lab_third_year ; $lab_day++){

		for($grp =0 ; $grp<2 ; $grp++){

			if($grp==0){
				$lab_grp[$lab_day][$grp]=$teacher_list_lab[$lab_day][0];
			}
			elseif($lab_day==0 && $grp==1){
				$lab_grp[$lab_day][$grp]= $teacher_list_lab[$total_lab_third_year-1][0] ;
			}
			elseif($grp==1){
				$lab_grp[$lab_day][$grp]= $lab_grp[$lab_day-1][0] ;
			}
		}
	}

	//now first make dept meeting lctr fix ;

	$time_table_3yr[3][3]="CS" ;
	// following is the code for the lab fitting ;


	//arguements - 
	/*
			$timetable matrix ,
			 number of labs = $total_first_year_labs
			  number of working days = $total_working_days ,
			  	$lab_grp 

	*/

	// future reference create array of this random so that u cant get same value again and again
	//lab fitting 
			  	$k=0 ;
    
	for($i=0 ; $i<$total_working_days ; $i++){

		
		up : 
		do {
			$lctr = mt_rand(0,6) ;	
		} while( $lctr %2 !=0) ;

		//$lctr represents the lctr in which lab will be there : $lctr , $lctr+1
	


		if ($time_table_3yr[$i][$lctr]=="0"  && $time_table_3yr[$i][$lctr+1] =="0" ) // means that lctr is free
		{
			$time_table_3yr[$i][$lctr] = $lab_grp[$k][0];
			$time_table_3yr[$i][$lctr+1] = $lab_grp[$k][1] ;
			$k++;

		} 		
		else{
				goto up ;
		}
	
	} 
	//$total_load = $total_lab_second_year*2 ;
	
	//now we have to check that  if any lab is left or not ;
	if($total_lab_third_year>$total_working_days)  // means labs are 6 and days are 5
	{
		for($i= 1 ; $i<=($total_lab_third_year-$total_working_days) ; $i++){ // add extra lab on tuesday

			re_up : 
			do {
				$lctr = mt_rand(0,6) ;	
			} while( $lctr %2 !=0) ;
			
			//	echo $lctr ;


				if ($time_table_3yr[$i][$lctr]=="0"  && $time_table_3yr[$i][$lctr+1] =="0" ) // means that lctr is free
				{	
					if($time_table_3yr[$i][$lctr-2]=="0"  &&  $time_table_3yr[$i][$lctr+2] =="0")
					{
						$time_table_3yr[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table_3yr[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;

					}
					elseif($lctr==0  &&  $time_table_3yr[$i][2] =="0")
					{
						$time_table_3yr[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table_3yr[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;
					}
					elseif($lctr==6  &&  $time_table_3yr[$i][4] =="0")
					{
						$time_table_3yr[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table_3yr[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;
					}
					else{
						goto re_up ;
					}
				} 		
				else{
						goto re_up ;
				}
			
			
		}
	}

	// now fit free lectures in first year i.e. business club

	// library fit


	for($i=0 ; $i<$total_working_days ; $i++){
	
		if($time_table_3yr[$i][4] == "0" ) {
			$time_table_3yr[$i][4]= "LIB" ;
			$lib_day = $i ;
			break;
		}
		elseif($time_table_3yr[$i][5] == "0" ) {
			$time_table_3yr[$i][5]= "LIB" ;
			$lib_day = $i ;
			break;
		}
	}
	$total_load+=1;
	// FIR ACTIVITY CLass : for second year - it will be on wednesday 

	for($i=0 ; $i<8 ; $i++){
		act_up :
		$day = mt_rand(2,6) ;
		if ( $day%2==0 ) {
			if($time_table_3yr[0][$day] == "0" ) {
				$time_table_3yr[0][$day] = "AC" ;
				$time_table_3yr[0][$day+1] = "AC" ;

				break;
			}
		}
		else{
			goto act_up;
		}
		
		
	}	

	$total_load+=2 ;

	
	// now lctr fitting 
	// for $teacher_list_sub[1] ;
	//ada
	for($i=0 ; $i<$total_working_days ; $i++)
	{
			start : 
			$day = mt_rand(0,7) ;
			if($time_table_3yr[$i][$day]=="0")
				{
					$time_table_3yr[$i][$day]= $teacher_list_sub[0][0] ;
				}
			else{
				goto start ;
			}
		

	}
	
	//for se
	for($i=0 ; $i<$total_working_days ; $i++)
	{
			se : 
			$day = mt_rand(0,7) ;
			if($time_table_3yr[$i][$day]=="0")
				{
					$time_table_3yr[$i][$day]= $teacher_list_sub[1][0] ;
				}
			else{
				goto se ;
			}
		

	}

	//java
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		
			java : 
			$day = mt_rand(0,7) ;
			if($time_table_3yr[$i][$day]=="0")
				{
					$time_table_3yr[$i][$day]= $teacher_list_sub[2][0] ;
				}
			else{
				goto java ;
			}
		

	}	
	
	//im
	for($i=1 ; $i<$total_working_days ; $i++)
	{
		im :
			$day = mt_rand(0,7) ;
			if($time_table_3yr[$i][$day]=="0")
				{
					$time_table_3yr[$i][$day]= $teacher_list_sub[3][0] ;
				}
			else{
				goto im ;
			}
		

	}	

	//cs
	for($i=1 ; $i<$total_working_days ; $i++)
	{
		if($i!=3) {
		cs : 
			$day = mt_rand(0,7) ;
			if($time_table_3yr[$i][$day]=="0")
				{
					$time_table_3yr[$i][$day]= $teacher_list_sub[4][0] ;
				}
			else{
				goto cs ;
			}
		
} 
	}	
	
	//csp
	for($i=1 ; $i<$total_working_days ; $i++)
	{
		csp :
			$day = mt_rand(0,7) ;
			if($time_table_3yr[$i][$day]=="0")
				{
					$time_table_3yr[$i][$day]= $teacher_list_sub[5][0] ;
				}
			else{
				goto csp ;
			}
		

	}	










	//display code


	for($row =0 ; $row<5 ; $row++){
		for($col=0 ; $col<8 ; $col++){
			echo $time_table_3yr[$row][$col] ;
			echo "\t\t" ;
		}
		echo "<br>" ;
		
	}
	/*
	//inserting into the database
	$mysqli = NEW  MySQLi('localhost', 'root', 'root' , 'it_time_table') ;

     //traverse all the values 

	for($row =0 ; $row<5 ; $row++){
		
				
				//here insert the value ;
		
			
		$insert =$mysqli->query("INSERT INTO it_fifth_sem (lctr1 , lctr2,lctr3,lctr4,lctr5,lctr6,lctr7,lctr8) 
			VALUES ('{$time_table_3yr[$row][0]}','{$time_table_3yr[$row][1]}','{$time_table_3yr[$row][2]}','{$time_table_3yr[$row][3]}','{$time_table_3yr[$row][4]}', 
				'{$time_table_3yr[$row][5]}', '{$time_table_3yr[$row][6]}','{$time_table_3yr[$row][7]}')");			


		
		
	}

	*/

	//creating teacher time table here
	$it_teacher_time_table_3 = $_SESSION['it_teacher_time_table'] ;

	for($i=0 ; $i< count($teacher_list_sub) ; $i++)
	{	
		$get_val = array_search( $teacher_list_sub[$i][1] ,  $all_teacher_name ,true); // here $all_teacher_name comes from the different file 
		//here it return index of found  in $all_teacher_name starting from 0 ;
		
		if (!( strlen($get_val) == 0 && !is_null($get_val) )) {
		if($get_val>=0 && $get_val<=7)   // this means that teacher is found and is of IT dept 
		{   

				for($j=0 ; $j<5 ; $j++)
				{
					for($k=0 ; $k<8 ; $k++)
					{
						if($time_table_3yr[$j][$k]== $teacher_list_sub[$i][0]) // checking that the sub is of teacher found in the class
						{
							$it_teacher_time_table_3[$teacher_list_sub[$i][1]][$j][$k] = $time_table_3yr[$j][$k] ;
						}
						  
					}
				}
		

		} }
		
	}


	// now we will loop through all lab time table 

	for($i=0 ; $i< count($teacher_list_lab) ; $i++)
	{
		$get_val = array_search( $teacher_list_lab[$i][1] ,  $all_teacher_name ,true);
		if (!( strlen($get_val) == 0 && !is_null($get_val) )) {
		if($get_val>=0 && $get_val<=7)   // this means that teacher is found and is of IT dept 
		{
				
				for($j=0 ; $j<5 ; $j++)
				{
					for($k=0 ; $k<8 ; $k++)
					{
						if($time_table_3yr[$j][$k]== $teacher_list_lab[$i][0]) // checking that the sub is of teacher found in the class
						{
							
							if($k%2==0)
							{
								$it_teacher_time_table_3[$teacher_list_lab[$i][1]][$j][$k] = $time_table_3yr[$j][$k] ;
								$it_teacher_time_table_3[$teacher_list_lab[$i][1]][$j][$k+1] = $time_table_3yr[$j][$k] ;	
							}	
							else
							{
								$it_teacher_time_table_3[$teacher_list_lab[$i][1]][$j][$k] = $time_table_3yr[$j][$k] ;
								$it_teacher_time_table_3[$teacher_list_lab[$i][1]][$j][$k-1] = $time_table_3yr[$j][$k] ;

							}



							
						}   
						
						}
					}
				}
		}
		
	}

	

?>
