
<?php
	// an array for time tab;e
	$time_table_final = [[]] ;

	//initialise the time table 
	for($i=0 ; $i<3 ; $i++)
			for($j=0 ;$j<8 ; $j++ )
					$time_table_final[$i][$j]="0";



	$teacher_list_sub= array() ;
	$teacher_list_lab= array() ;

	//setting the values of the choice filling  from the database ;
	//subject 

	$teacher_list_sub= array(
		array("ACN" , "Mr_Shafique") ,
		array("CC" , "Mrs_Vedika") , 
 		array("CNS" , "Mr_DK_Mishra" ),
 		array("WC" , "Mr_Anupam") ,
		array("DBA" , "Mrs_Vedika")  
		) ;
	
	


	$total_sub_final_year = count($teacher_list_sub) ;
	
	//labs 

	$teacher_list_lab= array(
		
		array("ACN-L",  "Mr_Atul")	,  // bca shafique sir has choosen theory foc 	
		array("CNS-L" , "Mr_DK _Mishra") ,
		array("WC-L" , "Mr_Anupam"),
		array("CC-L" , "Mrs_Vedika" )
		
		
		) ;


	$total_lab_final_year = count($teacher_list_lab) ;

	$total_working_days = 3 ;
	

	//divide the class into twio groups acc to lab ;

	$lab_grp = [[]] ;

	// following code to make lab grp 
	for($lab_day=0 ; $lab_day<$total_lab_final_year ; $lab_day++){

		for($grp =0 ; $grp<2 ; $grp++){

			if($grp==0){
				$lab_grp[$lab_day][$grp]=$teacher_list_lab[$lab_day][0];
			}
			elseif($lab_day==0 && $grp==1){
				$lab_grp[$lab_day][$grp]= $teacher_list_lab[$total_lab_final_year-1][0] ;
			}
			elseif($grp==1){
				$lab_grp[$lab_day][$grp]= $lab_grp[$lab_day-1][0] ;
			}
		}
	}

	//now first make dept meeting lctr fix ;

	//$time_table_final[3][3]="CS" ;
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
	


		if ($time_table_final[$i][$lctr]=="0"  && $time_table_final[$i][$lctr+1] =="0" ) // means that lctr is free
		{
			$time_table_final[$i][$lctr] = $lab_grp[$k][0];
			$time_table_final[$i][$lctr+1] = $lab_grp[$k][1] ;
			$k++;

		} 		
		else{
				goto up ;
		}
	
	} 
	//$total_load = $total_lab_second_year*2 ;
	
	//now we have to check that  if any lab is left or not ;
	if($total_lab_final_year>$total_working_days)  // means labs are 6 and days are 5
	{
		for($i= 2 ; $i<=($total_lab_final_year-$total_working_days)+1 ; $i++){ // add extra lab on tuesday

			re_up : 
			do {
				$lctr = mt_rand(0,6) ;	
			} while( $lctr %2 !=0) ;
			
			//	echo $lctr ;


				if ($time_table_final[$i][$lctr]=="0"  && $time_table_final[$i][$lctr+1] =="0" ) // means that lctr is free
				{	
					if($time_table_final[$i][$lctr-2]=="0"  &&  $time_table_final[$i][$lctr+2] =="0") // to check that previous 2 lctr and after 2 lctr shou;d not have labs
					{
						$time_table_final[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table_final[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;

					}
					elseif($lctr==0  &&  $time_table_final[$i][2] =="0")
					{
						$time_table_final[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table_final[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;
					}
					elseif($lctr==6  &&  $time_table_final[$i][4] =="0")
					{
						$time_table_final[$i][$lctr] = $lab_grp[$total_working_days][0];
						$time_table_final[$i][$lctr+1] = $lab_grp[$total_working_days][1] ;
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

	

	// project free lctr fit


	for($i=0 ; $i<$total_working_days ; $i++){
	
		if($time_table_final[$i][4] == "0" ) {
			$time_table_final[$i][4]= "PROJECT" ;
			$lib_day = $i ;
			break;
		}
		elseif($time_table_final[$i][5] == "0" ) {
			$time_table_final[$i][5]= "PROJECT" ;
			$lib_day = $i ;
			break;
		}
	}
	
	
	// now lctr fitting 
	// for $teacher_list_sub[1] ;
	//acn
	for($i=0 ; $i<$total_working_days ; $i++)
	{
			start : 
			$day = mt_rand(0,7) ;
			if($time_table_final[$i][$day]=="0")
				{
					$time_table_final[$i][$day]= $teacher_list_sub[0][0] ;
				}
			else{
				goto start ;
			}
		

	}
	
	//for cns
	for($i=0 ; $i<$total_working_days ; $i++)
	{
			cns : 
			$day = mt_rand(0,7) ;
			if($time_table_final[$i][$day]=="0")
				{
					$time_table_final[$i][$day]= $teacher_list_sub[1][0] ;
				}
			else{
				goto cns ;
			}
		

	}

	//java
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		
			wc : 
			$day = mt_rand(0,7) ;
			if($time_table_final[$i][$day]=="0")
				{
					$time_table_final[$i][$day]= $teacher_list_sub[2][0] ;
				}
			else{
				goto wc ;
			}
		

	}	
	
	//cc
	for($i=0 ; $i<$total_working_days ; $i++)
	{
		cc :
			$day = mt_rand(0,7) ;
			if($time_table_final[$i][$day]=="0")
				{
					$time_table_final[$i][$day]= $teacher_list_sub[3][0] ;
				}
			else{
				goto cc ;
			}
		

	}	
	//dba
	for($i=0 ; $i<$total_working_days-1 ; $i++)
	{
		for($j=0 ; $j<8 ; $j++){
			if($time_table_final[$i][$j]=="0")
				{
					$time_table_final[$i][$j]= $teacher_list_sub[4][0] ;
				}
		}
		

	}	

	
	






	//display code


	for($row =0 ; $row<5 ; $row++){
		for($col=0 ; $col<8 ; $col++){
			echo $time_table_final[$row][$col] ;
			echo "\t\t" ;
		}
		echo "<br>" ;
		
	}

	$mysqli = NEW  MySQLi('localhost', 'root', 'root' , 'it_time_table') ;

     //traverse all the values 

	for($row =0 ; $row<5 ; $row++){
		
				
				//here insert the value ;
		
			
		$insert =$mysqli->query("INSERT INTO it_seventh_sem (lctr1 , lctr2,lctr3,lctr4,lctr5,lctr6,lctr7,lctr8) 
			VALUES ('{$time_table_final[$row][0]}','{$time_table_final[$row][1]}','{$time_table_final[$row][2]}','{$time_table_final[$row][3]}','{$time_table_final[$row][4]}', 
				'{$time_table_final[$row][5]}', '{$time_table_final[$row][6]}','{$time_table_final[$row][7]}')");			


		
		
	}

	

?>
