<?php
session_start() ;
include 'teacher_time_table.php';

?>
<?php
	// an array for time tab;e
	$time_table_2yr = [[]] ;

	//initialise the time table 
	for($i=0 ; $i<5 ; $i++)
			for($j=0 ;$j<8 ; $j++ )
					$time_table_2yr[$i][$j]="0";



	$teacher_list_sub_2yr= array() ;
	$teacher_list_lab_2yr= array() ;

	//setting the values of the choice filling  from the database ;
	//subject 

	$teacher_list_sub_2yr= array(
		array("AM3" , "Ms_Gunjan_Gupta") , //outer
		array("DS" , "Ms_Lisha" ),
		array("FCS" , "Mr_Anupam_Sharma") ,
		array("CG" , "Ms_Samrity_Khurana") ,
		array("STLD",  "Ms_Archana") ,
		array("C&S" , "Mr_Aditya")  //outer dept  subject
		) ;
	
	


	$total_sub_second_year = count($teacher_list_sub_2yr) ;
	
	//labs 

	$teacher_list_lab_2yr= array(
		
		array("DS-L",  "Ms_Lisha")	,  // bca shafique sir has choosen theory foc 	
		array("CG-L" , "Ms_Samrity_Khurana") ,
		array("STLD-L" , "Ms_Archana"),
		array("C&S-L" , "Mr_Aditya" )
		
		) ;


	$total_lab_second_year = count($teacher_list_lab_2yr) ;

	$total_working_days = 5 ;
	

	//divide the class into twio groups acc to lab ;

	$lab_grp = [[]] ;

	// following code to make lab grp 
	for($lab_day=0 ; $lab_day<$total_lab_second_year ; $lab_day++){

		for($grp =0 ; $grp<2 ; $grp++){

			if($grp==0){
				$lab_grp[$lab_day][$grp]=$teacher_list_lab_2yr[$lab_day][0];
			}
			elseif($lab_day==0 && $grp==1){
				$lab_grp[$lab_day][$grp]= $teacher_list_lab_2yr[$total_lab_second_year-1][0] ;
			}
			elseif($grp==1){
				$lab_grp[$lab_day][$grp]= $lab_grp[$lab_day-1][0] ;
			}
		}
	}

	//now first make dept meeting lctr fix ;

	$time_table_2yr[3][3]="C&S" ;
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

		if($i!=2) {
		up : 
		do {
			$lctr = mt_rand(0,6) ;	
		} while( $lctr %2 !=0) ;

		//$lctr represents the lctr in which lab will be there : $lctr , $lctr+1
	


		if ($time_table_2yr[$i][$lctr]=="0"  && $time_table_2yr[$i][$lctr+1] =="0" ) // means that lctr is free
		{
			$time_table_2yr[$i][$lctr] = $lab_grp[$k][0];
			$time_table_2yr[$i][$lctr+1] = $lab_grp[$k][1] ;
			$k++;

		} 		
		else{
				goto up ;
		}
	}
	} 
	$total_load = $total_lab_second_year*2 ;
	
	//now we have to check that  if any lab is left or not ;
	if($total_lab_second_year>$total_working_days)  // means labs are 6 and days are 5
	{
		for($i= 1 ; $i<=($total_lab_second_year-$total_working_days) ; $i++){ // add extra lab on tuesday

			re_up : 
			do {
				$lctr = mt_rand(0,6) ;	
			} while( $lctr %2 !=0) ;
			
			//	echo $lctr ;


				if ($time_table_2yr[$i][$lctr]=="0"  && $time_table_2yr[$i][$lctr+1] =="0" ) // means that lctr is free
				{	
					if($time_table_2yr[$i][$lctr-2]=="0"  &&  $time_table_2yr[$i][$lctr+2] =="0")
					{
						$time_table_2yr[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table_2yr[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;

					}
					elseif($lctr==0  &&  $time_table_2yr[$i][2] =="0")
					{
						$time_table_2yr[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table_2yr[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;
					}
					elseif($lctr==6  &&  $time_table_2yr[$i][4] =="0")
					{
						$time_table_2yr[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table_2yr[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;
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
	
		if($time_table_2yr[$i][4] == "0" ) {
			$time_table_2yr[$i][4]= "LIB" ;
			$lib_day = $i ;
			break;
		}
		elseif($time_table_2yr[$i][5] == "0" ) {
			$time_table_2yr[$i][5]= "LIB" ;
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
			if($time_table_2yr[2][$day] == "0" ) {
				$time_table_2yr[2][$day] = "AC" ;
				$time_table_2yr[2][$day+1] = "AC" ;

				break;
			}
		}
		else{
			goto act_up;
		}
		
		
	}	

	$total_load+=2 ;

	
	// now lctr fitting 
	// for $teacher_list_sub_2yr[1] ;
	//am
	for($i=0 ; $i<$total_working_days ; $i++)
	{
			start : 
			$day = mt_rand(0,7) ;
			if($time_table_2yr[$i][$day]=="0")
				{
					$time_table_2yr[$i][$day]= $teacher_list_sub_2yr[0][0] ;
				}
			else{
				goto start ;
			}
		

	}
	
	//for ds
	for($i=0 ; $i<$total_working_days ; $i++)
	{
			ds : 
			$day = mt_rand(0,7) ;
			if($time_table_2yr[$i][$day]=="0")
				{
					$time_table_2yr[$i][$day]= $teacher_list_sub_2yr[1][0] ;
				}
			else{
				goto ds ;
			}
		

	}

	//fcs
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		
			fcs : 
			$day = mt_rand(0,7) ;
			if($time_table_2yr[$i][$day]=="0")
				{
					$time_table_2yr[$i][$day]= $teacher_list_sub_2yr[2][0] ;
				}
			else{
				goto fcs ;
			}
		

	}	
	
	//cg
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		cg :
			$day = mt_rand(0,7) ;
			if($time_table_2yr[$i][$day]=="0")
				{
					$time_table_2yr[$i][$day]= $teacher_list_sub_2yr[3][0] ;
				}
			else{
				goto cg ;
			}
		

	}	

	//stld
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		stld : 
			$day = mt_rand(0,7) ;
			if($time_table_2yr[$i][$day]=="0")
				{
					$time_table_2yr[$i][$day]= $teacher_list_sub_2yr[4][0] ;
				}
			else{
				goto stld ;
			}
		

	}	
	
	//cs
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		if($i!=0 && $i!=3 ) {
			c_s : 
			$day = mt_rand(0,7) ;
			if($time_table_2yr[$i][$day]=="0")
				{
					$time_table_2yr[$i][$day]= $teacher_list_sub_2yr[5][0] ;
				}
			else{
				goto c_s ;
			}
		}

	}	

	









	//display code


	for($row =0 ; $row<5 ; $row++){
		for($col=0 ; $col<8 ; $col++){
			echo $time_table_2yr[$row][$col] ;
			echo "\t\t" ;
		}
		echo "<br>" ;
		
	}

	/*

	//inserting into the database ;
	$mysqli = NEW  MySQLi('localhost', 'root', 'root' , 'it_time_table') ;

     //traverse all the values 

	for($row =0 ; $row<5 ; $row++){
		
				
				//here insert the value ;
		
			
		$insert =$mysqli->query("INSERT INTO it_third_sem (lctr1 , lctr2,lctr3,lctr4,lctr5,lctr6,lctr7,lctr8) 
			VALUES ('{$time_table_2yr[$row][0]}','{$time_table_2yr[$row][1]}','{$time_table_2yr[$row][2]}','{$time_table_2yr[$row][3]}','{$time_table_2yr[$row][4]}', 
				'{$time_table_2yr[$row][5]}', '{$time_table_2yr[$row][6]}','{$time_table_2yr[$row][7]}')");			


		
		
	}*/


	//NOW WE WILL GENERATE TEACHER TIME TABLE : 
	//Approach used : generate class time table first -> match with teacher because initially all are empty and we are starting with IT , So, this approach is best here. 

	$it_teacher_time_table_2 = $_SESSION['it_teacher_time_table'] ;

	
	
	for($i=0 ; $i< count($teacher_list_sub_2yr) ; $i++)
	{	
		$get_val = array_search( $teacher_list_sub_2yr[$i][1] ,  $all_teacher_name ,true); // here $all_teacher_name comes from the different file 
		//here it return index of found  in $all_teacher_name starting from 0 ;
		
		if (!( strlen($get_val) == 0 && !is_null($get_val) )) {
		if($get_val>=0 && $get_val<=7)   // this means that teacher is found and is of IT dept 
		{   

				for($j=0 ; $j<5 ; $j++)
				{
					for($k=0 ; $k<8 ; $k++)
					{
						if($time_table_2yr[$j][$k]== $teacher_list_sub_2yr[$i][0]) // checking that the sub is of teacher found in the class
						{
							$it_teacher_time_table_2[$teacher_list_sub_2yr[$i][1]][$j][$k] = $time_table_2yr[$j][$k] ;
						}
						  
					}
				}
		

		} }
		
	}

	
	// now we will loop through all lab time table 

	for($i=0 ; $i< count($teacher_list_lab_2yr) ; $i++)
	{
		$get_val = array_search( $teacher_list_lab_2yr[$i][1] ,  $all_teacher_name ,true);
		if (!( strlen($get_val) == 0 && !is_null($get_val) )) {
		if($get_val>=0 && $get_val<=7)   // this means that teacher is found and is of IT dept 
		{
				
				for($j=0 ; $j<5 ; $j++)
				{
					for($k=0 ; $k<8 ; $k++)
					{
						if($time_table_2yr[$j][$k]== $teacher_list_lab_2yr[$i][0]) // checking that the sub is of teacher found in the class
						{
							
							if($k%2==0)
							{
								$it_teacher_time_table_2[$teacher_list_lab_2yr[$i][1]][$j][$k] = $time_table_2yr[$j][$k] ;
								$it_teacher_time_table_2[$teacher_list_lab_2yr[$i][1]][$j][$k+1] = $time_table_2yr[$j][$k] ;	
							}	
							else
							{
								$it_teacher_time_table_2[$teacher_list_lab_2yr[$i][1]][$j][$k] = $time_table_2yr[$j][$k] ;
								$it_teacher_time_table_2[$teacher_list_lab_2yr[$i][1]][$j][$k-1] = $time_table_2yr[$j][$k] ;

							}



							
						}   
						
						}
					}
				}
		}
		
	}

	$_SESSION['it_teacher_time_table'] = $it_teacher_time_table_2 ;

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
 

?>
