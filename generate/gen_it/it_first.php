<?php
	// an array for time tab;e
	//include("teacher_time_table.php") ;

	
	session_start() ;


	include 'teacher_time_table.php';
	$time_table = [[]] ;

	//initialise the time table 
	for($i=0 ; $i<5 ; $i++)
			for($j=0 ;$j<8 ; $j++ )
					$time_table[$i][$j]="0";



	$teacher_list_sub= array() ;
	$teacher_list_lab= array() ;

	//setting the values of the choice filling  from the database ;
	//subject 

	$teacher_list_sub= array(
		array("AM1" , "Mrs_Geeta") ,
		array("AP1" , "Dr_Padmaja Panda" ) ,
		array("AC" , "Dr_Teena") ,
		array("FOC",  "Dr_Shafiqul_Abidin") ,
		array("MP" , "Mr_Abhishek"),
		array("ET" , "Mr_Sachin" ),
		array("HVPE" , "Dr_Taruna Sharma")
				
		) ;
	
	


	$total_sub_first_year = count($teacher_list_sub) ;
	
	//labs 

	$teacher_list_lab= array(
		
		array("AP-L" , "Dr_Padmaja Panda" ) ,
		array("AC-L" , "Dr_Teena") ,
		array("MP-L" , "Mr_Abhishek"),
		array("ET-L" , "Mr_Sachin" ),
		array("FOC-L",  "Ms_Lisha")	,  // bcz shafique sir has choosen theory foc 	
		array("EG-L" , "Mr_Abhishek")
		) ;


	$total_lab_first_year = count($teacher_list_lab) ;

	$total_working_days = 5 ;
	$total_working_load_class = 40 ;

	//divide the class into twio groups acc to lab ;

	$lab_grp = [[]] ;

	// following code to make lab grp 
	for($lab_day=0 ; $lab_day<$total_lab_first_year ; $lab_day++){

		for($grp =0 ; $grp<2 ; $grp++){

			if($grp==0){
				$lab_grp[$lab_day][$grp]=$teacher_list_lab[$lab_day][0];
			}
			elseif($lab_day==0 && $grp==1){
				$lab_grp[$lab_day][$grp]= $teacher_list_lab[$total_lab_first_year-1][0] ;
			}
			elseif($grp==1){
				$lab_grp[$lab_day][$grp]= $lab_grp[$lab_day-1][0] ;
			}
		}
	}

	//now first make dept meeting lctr fix ;

	$time_table[3][3]="HVPE" ;
	// following is the code for the lab fitting ;


	//arguements - 
	/*
			$timetable matrix ,
			 number of labs = $total_first_year_labs
			  number of working days = $total_working_days ,
			  	$lab_grp 

	*/

	// future reference create array of this random so that u cant get same value again and again
	for($i=0 ; $i<$total_working_days ; $i++){
		up : 
		do {
			$lctr = mt_rand(0,6) ;	
		} while( $lctr %2 !=0) ;

		//$lctr represents the lctr in which lab will be there : $lctr , $lctr+1
	


		if ($time_table[$i][$lctr]=="0"  && $time_table[$i][$lctr+1] =="0" ) // means that lctr is free
		{
			$time_table[$i][$lctr] = $lab_grp[$i][0];
			$time_table[$i][$lctr+1] = $lab_grp[$i][1] ;
		} 		
		else{
				goto up ;
		}

	} 
	
	//now we have to check that  if any lab is left or not ;
	if($total_lab_first_year>$total_working_days)  // means labs are 6 and days are 5
	{
		for($i= 1 ; $i<=($total_lab_first_year-$total_working_days) ; $i++){ // add extra lab on tuesday

			re_up : 
			do {
				$lctr = mt_rand(0,6) ;	
			} while( $lctr %2 !=0) ;
			
			//	echo $lctr ;


				if ($time_table[$i][$lctr]=="0"  && $time_table[$i][$lctr+1] =="0" ) // means that lctr is free
				{	
					if($time_table[$i][$lctr-2]=="0"  &&  $time_table[$i][$lctr+2] =="0")
					{
						$time_table[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;

					}
					elseif($lctr==0  &&  $time_table[$i][2] =="0")
					{
						$time_table[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;
					}
					elseif($lctr==6  &&  $time_table[$i][4] =="0")
					{
						$time_table[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;
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
		if($time_table[$i][2] == "0" ) {
			$time_table[$i][2] = "LIB" ;
			$lib_day = $i ;
			break;
		}
		elseif($time_table[$i][3] == "0" ) {
			$time_table[$i][3]= "LIB" ;
			$lib_day = $i ;
			break;
		}
		elseif($time_table[$i][4] == "0" ) {
			$time_table[$i][4]= "LIB" ;
			$lib_day = $i ;
			break;
		}
		elseif($time_table[$i][5] == "0" ) {
			$time_table[$i][5]= "LIB" ;
			$lib_day = $i ;
			break;
		}
	}

	// For BUSINESS CLUB 
	// future ref : check that lib and bc does not clash for all day : 
	for($i=0 ; $i<$total_working_days ; $i++){

		if ( ($lib_day != $i ) && ($i != 1) ) {
			if($time_table[$i][4] == "0" ) {
				$time_table[$i][4] = "BC" ;
				$time_table[$i][5] = "BC" ;

				break;
			}
		}
		
		
	}	
	// future ref : if nothing is free :: 

	// now lctr fitting 
	// for $teacher_list_sub[1] ;
	//am
	for($i=0 ; $i<$total_working_days ; $i++)
	{
			start : 
			$day = mt_rand(0,7) ;
			if($time_table[$i][$day]=="0")
				{
					$time_table[$i][$day]= $teacher_list_sub[0][0] ;
				}
			else{
				goto start ;
			}
		

	}
	
	//for ap
	for($i=1 ; $i<$total_working_days ; $i++)
	{
			ap : 
			$day = mt_rand(0,7) ;
			if($time_table[$i][$day]=="0")
				{
					$time_table[$i][$day]= $teacher_list_sub[1][0] ;
				}
			else{
				goto ap ;
			}
		

	}

	//applied chem
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		if($i!=1) {
			ac : 
			$day = mt_rand(0,7) ;
			if($time_table[$i][$day]=="0")
				{
					$time_table[$i][$day]= $teacher_list_sub[2][0] ;
				}
			else{
				goto ac ;
			}
		}

	}	
	
	//foc 
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		if($i!=2) {
			foc : 
			$day = mt_rand(0,7) ;
			if($time_table[$i][$day]=="0")
				{
					$time_table[$i][$day]= $teacher_list_sub[3][0] ;
				}
			else{
				goto foc ;
			}
		}

	}	
	//et
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		if($i!=1) {
			et : 
			$day = mt_rand(0,7) ;
			if($time_table[$i][$day]=="0")
				{
					$time_table[$i][$day]= $teacher_list_sub[5][0] ;
				}
			else{
				goto et ;
			}
		}

	}	
	//mp
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		if($i!=2 && $i!=3 ) {
			mp : 
			$day = mt_rand(0,7) ;
			if($time_table[$i][$day]=="0")
				{
					$time_table[$i][$day]= $teacher_list_sub[4][0] ;
				}
			else{
				goto mp ;
			}
		}

	}	

	
	//display the generted time table on page

	echo "Time Table : " ;
	echo "<br>" ; 
	for($row =0 ; $row<5 ; $row++){
		for($col=0 ; $col<8 ; $col++){
			echo $time_table[$row][$col] ;
			echo "\t\t" ;	
		}
		echo "<br>" ;
		
	}


	//Saving  THE  generated TIME TABLE OF THE FIRST YEAR INTO DATABASE :

	/*$mysqli = NEW  MySQLi('localhost', 'root', 'root' , 'it_time_table') ;

     //traverse all the values 

	for($row =0 ; $row<5 ; $row++){
		
				
				//here insert the value ;
		
			
		$insert =$mysqli->query("INSERT INTO it_first_sem (lctr1 , lctr2,lctr3,lctr4,lctr5,lctr6,lctr7,lctr8) 
			VALUES ('{$time_table[$row][0]}','{$time_table[$row][1]}','{$time_table[$row][2]}','{$time_table[$row][3]}','{$time_table[$row][4]}', 
				'{$time_table[$row][5]}', '{$time_table[$row][6]}','{$time_table[$row][7]}')");			


		
		
	}   */


	// -- new changes -- 
	

	//NOW WE WILL GENERATE TEACHER TIME TABLE : 
	//Approach used : generate class time table first -> match with teacher because initially all are empty and we are starting with IT , So, this approach is best here. 

	for($i=0 ; $i< count($teacher_list_sub) ; $i++)
	{
		$get_val = array_search( $teacher_list_sub[$i][1] ,  $all_teacher_name ,true); // here $all_teacher_name comes from the different file 
		//here it return index of found wlwmwnt in $all_teacher_name starting from 0 ;
		if (!( strlen($get_val) == 0 && !is_null($get_val) )) {
		if($get_val>=0 && $get_val<=7)   // this means that teacher is found and is of IT dept 
		{   
				
				for($j=0 ; $j<5 ; $j++)
				{
					for($k=0 ; $k<8 ; $k++)
					{
						if($time_table[$j][$k]== $teacher_list_sub[$i][0]) // checking that the sub is of teacher found in the class
						{
							$it_teacher_time_table[$teacher_list_sub[$i][1]][$j][$k] = $time_table[$j][$k] ;
						}
						else{
								$it_teacher_time_table[$teacher_list_sub[$i][1]][$j][$k]="0" ;	
						}   
					}
				}
		}
	}	
	}


	// now we will loop through all lab time table 

	for($i=0 ; $i< count($teacher_list_lab) ; $i++)
	{
		$get_val = array_search( $teacher_list_lab[$i][1] ,  $all_teacher_name ,true);
		if (! ( strlen($get_val) == 0 && !is_null($get_val) )) {
		if($get_val>=0 && $get_val<=7)   // this means that teacher is found and is of IT dept 
		{
				
				for($j=0 ; $j<5 ; $j++)
				{
					for($k=0 ; $k<8 ; $k++)
					{
						if($time_table[$j][$k]== $teacher_list_lab[$i][0]) // checking that the sub is of teacher found in the class
						{
							
							if($k%2==0)
							{
								$it_teacher_time_table[$teacher_list_lab[$i][1]][$j][$k] = $time_table[$j][$k] ;
								$it_teacher_time_table[$teacher_list_lab[$i][1]][$j][$k+1] = $time_table[$j][$k] ;	
							}	
							else
							{
								$it_teacher_time_table[$teacher_list_lab[$i][1]][$j][$k] = $time_table[$j][$k] ;
								$it_teacher_time_table[$teacher_list_lab[$i][1]][$j][$k-1] = $time_table[$j][$k] ;

							}



							
						}   
						else {
							if ( empty($it_teacher_time_table[$teacher_list_lab[$i][1]][$j][$k]) )
							{
									$it_teacher_time_table[$teacher_list_lab[$i][1]][$j][$k]= "0" ;
							}	
						}
					}
				}
		}
		}
	}

	//store the it teacher time table array in session 
	$_SESSION['it_teacher_time_table'] = $it_teacher_time_table ;


	//lets display teacher time table 



		//display the session variable 
	foreach ($_SESSION['it_teacher_time_table'] as $key => $value) {

			echo "Teacher Name : ";
			echo $key ;
			echo "<br />";
						echo "timetable :"; echo "<br>";
			for($i=0 ; $i<5 ; $i++)
			{
				for($j=0 ; $j<8 ; $j++)
				{
						echo $value[$i][$j] ;

						echo "\t\t" ;
				}

				echo "<br>" ;
			}
			
			echo "<br>" ;
	}

	
/*
	
	echo "Insert into the databse" ;

	$mysqli = NEW  MySQLi('localhost', 'root', 'root' , 'teacher_tt') ;

     //traverse all the values 

	for($row =0 ; $row<5 ; $row++){
		
				
				//here insert the value ;
		
			
		$insert =$mysqli->query("INSERT INTO teacher_tt.Dr_Shafiqul_Abidin (lctr1 , lctr2,lctr3,lctr4,lctr5,lctr6,lctr7,lctr8) 
			VALUES ('{$it_teacher_time_table["Dr_Shafiqul_Abidin"][$row][0]}','{$it_teacher_time_table["Dr_Shafiqul_Abidin"][$row][1]}','{$it_teacher_time_table["Dr_Shafiqul_Abidin"][$row][2]}','{$it_teacher_time_table["Dr_Shafiqul_Abidin"][$row][3]}','{$it_teacher_time_table["Dr_Shafiqul_Abidin"][$row][4]}', 
				'{$it_teacher_time_table["Dr_Shafiqul_Abidin"][$row][5]}', '{$it_teacher_time_table["Dr_Shafiqul_Abidin"][$row][6]}','{$it_teacher_time_table["Dr_Shafiqul_Abidin"][$row][7]}')");			


		
		
	}   */



?>