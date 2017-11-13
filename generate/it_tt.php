<?php
session_start();
if(!isset($_SESSION['userlog']))
{ 
	/*session_start();*/
	echo '<script type="text/javascript">
                    alert("Please Login To continue !");
                    window.location="../index.php";
                    </script> ';
	
}
else
{
	
}


?>

<?php

	 $mysqli = NEW  MySQLi('localhost', 'root', 'root' , 'it_time_table') ;
    


?>



<?php
/*
require_once("../generate/gen_it/it_first.php") ;
require_once("../generate/gen_it/it_second.php") ;
require_once("../generate/gen_it/it_third.php") ;
require_once("../generate/gen_it/it_final.php") ;
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>IT TIME TABLE</title>
	<link href="../image/download.png" rel="icon"> 
    <link rel="stylesheet" href="../css/generate_it.css">
    

</head>
<body>
	<div class="time_table" >


		<h1>
			Time Table 
		</h1>	
	</div>
	<div class="first_year" style="background-color: #f9f9f9 ; " >
		<h2>
			First Year Time Table :
		</h2>
		
		<h3>
			It - 1 yr - Section : A
		</h3>

		<table border="2" cellspacing="3" align="center">


			<tr>
				 <td align="center">	</td>
				 <td align="center">1</td>
				 <td align="center">2</td>
				 <td align="center">	</td>
				 <td align="center">3</td>
				 <td align="center">4</td>
				 <td align="center">	</td>
				 <td align="center">5</td>
				 <td align="center">6</td>
				 <td align="center">	</td>
				 <td align="center">7</td>
				 <td align="center">8</td>
			</tr>
			<tr>
				 <td align="center">
				 <td>8:30 -9:20</td>
				 <td>9:20-10:10</td>
				 <td>10:10-10:25</td>
				 <td>10:25-11:15</td>
				 <td>11:15-12:05</td>
				 <td>12:05-12:15</td>
				 <td>12:15-1:05</td>
				 <td>1:05-1:55</td>
				 <td>1:55-2:25</td>
				 <td>2:25-3:15</td>
				 <td>3:15-4:00</td>
			</tr>

			<?php

				$get_data = $mysqli->query("SELECT * FROM it_first_sem ");
				$ans= [[]] ;
				$index=0 ;
				
				while($row= mysqli_fetch_array($get_data))
				{
					$ans[$index][0]=$row['lctr1'] ;
					$ans[$index][1]= $row['lctr2'] ;
					$ans[$index][2]=$row['lctr3'] ;
					$ans[$index][3]=$row['lctr4'] ;
					$ans[$index][4]=$row['lctr5'] ;
					$ans[$index][5]=$row['lctr6'] ;
					$ans[$index][6]=$row['lctr7'] ;
					$ans[$index][7]=$row['lctr8'] ;
					$index ++;

					
						
				}
				

	?>
		
			
			<tr>
			 <td align='center'>MONDAY</td>
			 <td align="center"><font color="blue"><?php echo $ans[0][0] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[0][1] ; ?><br></font></td>
			
			
			 <td rowspan="6" align="center">L<br>U<br>N<br>C<br>H</td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[0][2] ;echo "    ".$ans[0][3] ; ?><br></font></td>
			
			
			 <td rowspan="6"align="center">L<br>U<br>N<br>C<br>H</td>
			 <td align="center"><font color="green"><?php echo $ans[0][4] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[0][5] ; ?><br></font></td>
			 <td rowspan="6"align="center">L<br>U<br>N<br>C<br>H</td>
			 <td align="center"><font color="blue"><?php echo $ans[0][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[0][7] ; ?><br></font></td>

			</tr>
			<tr>
			 <td align='center'>TUESDAY</td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[1][0] ; echo "   ". $ans[1][1] ; ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[1][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][3] ; ?><br></font></td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[1][4] ; echo "    ".$ans[1][5] ; ?><br></font></td>
			
			 <td align="center"><font color="blue"><?php echo $ans[1][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][7] ; ?><br></font></td>

			</tr>
			<tr>
			 <td align='center'>WEDNESDAY</td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[2][0] ; echo "    ".$ans[2][1] ; ?><br></font></td>
			
			 <td align="center"><font color="blue"><?php echo $ans[2][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[2][3] ; ?><br></font></td>
			 <td colspan="2" align="center"><font color="#c9972c"><?php echo "Activity"   ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[2][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[2][7] ; ?><br></font></td>

			</tr>
			<tr>
			 <td align='center'>THURSDAY</td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[3][0] ; echo "    ".$ans[3][1] ; ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[3][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[3][3] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[3][4] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[3][5] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[3][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[3][7] ; ?><br></font></td>

			</tr>
			<tr>
			 <td align='center'>FRIDAY</td>
			 <td align="center"><font color="blue"><?php echo $ans[4][0] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[4][1] ; ?><br></font></td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[4][2] ;echo "    ".$ans[4][3] ; ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[4][4] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[4][5] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[4][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[4][7] ; ?><br></font></td>

			</tr>
			
		</table>


	</div>


	<div class="second_year">
		<h2>
			Second Year Time Table :
		</h2>
		
		<h3>
			It - 2 yr - Section : A
		</h3>

		<table border="2" cellspacing="3" align="center">
			
			<tr>
				 <td align="center">	</td>
				 <td align="center">1</td>
				 <td align="center">2</td>
				 <td align="center">	</td>
				 <td align="center">3</td>
				 <td align="center">4</td>
				 <td align="center">	</td>
				 <td align="center">5</td>
				 <td align="center">6</td>
				 <td align="center">	</td>
				 <td align="center">7</td>
				 <td align="center">8</td>
			</tr>
			<tr>
				 <td align="center">
				 <td>8:30 -9:20</td>
				 <td>9:20-10:10</td>
				 <td>10:10-10:25</td>
				 <td>10:25-11:15</td>
				 <td>11:15-12:05</td>
				 <td>12:05-12:15</td>
				 <td>12:15-1:05</td>
				 <td>1:05-1:55</td>
				 <td>1:55-2:25</td>
				 <td>2:25-3:15</td>
				 <td>3:15-4:00</td>
			</tr>

			<?php

				$get_data = $mysqli->query("SELECT * FROM it_third_sem ");
				$ans= [[]] ;
				$index=0 ;
				
				while($row= mysqli_fetch_array($get_data))
				{
					$ans[$index][0]=$row['lctr1'] ;
					$ans[$index][1]= $row['lctr2'] ;
					$ans[$index][2]=$row['lctr3'] ;
					$ans[$index][3]=$row['lctr4'] ;
					$ans[$index][4]=$row['lctr5'] ;
					$ans[$index][5]=$row['lctr6'] ;
					$ans[$index][6]=$row['lctr7'] ;
					$ans[$index][7]=$row['lctr8'] ;
					$index ++;

					
						
				}
				

	?>
			<tr>
				 <td align='center'>MONDAY</td>
				 <td align="center"><font color="blue"><?php echo $ans[0][0] ; ?><br></font></td>
				 <td align="center"><font color="blue"><?php echo $ans[0][1] ; ?><br></font></td>
				
				
				 <td rowspan="6" align="center">L<br>U<br>N<br>C<br>H</td>
				 <td  align="center"><font color="blue"><?php echo $ans[0][2] ;?><br></font></td>
				<td  align="center"><font color="blue"><?php echo $ans[0][3] ;?><br></font></td>
				
				 <td rowspan="6"align="center">L<br>U<br>N<br>C<br>H</td>
				 <td align="center"><font color="green"><?php echo $ans[0][4] ; ?><br></font></td>
				 <td align="center"><font color="blue"><?php echo $ans[0][5] ; ?><br></font></td>
				 <td rowspan="6"align="center">L<br>U<br>N<br>C<br>H</td>
				 <td colspan="2" align="center"><font color="red"><?php echo $ans[0][6] ; echo "    ".$ans[0][7] ; ?><br></font></td>
				 

			</tr>
			<tr>
			 <td align='center'>TUESDAY</td>
			 <td  align="center"><font color="blue"><?php echo $ans[1][0] ; ?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo "   ". $ans[1][1] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][3] ; ?><br></font></td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[1][4] ; echo "    ".$ans[1][5] ; ?><br></font></td>
			
			 <td align="center"><font color="blue"><?php echo $ans[1][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][7] ; ?><br></font></td>

			</tr>
			<tr>
			 <td align='center'>WEDNESDAY</td>
			 <td  align="center"><font color="blue"><?php echo $ans[2][0] ; ?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo $ans[2][1] ; ?><br></font></td>
			
			 <td align="center"><font color="blue"><?php echo $ans[2][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[2][3] ; ?><br></font></td>
			 <td colspan="2" align="center"><font color="#c9972c"><?php echo "Activity"   ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[2][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[2][7] ; ?><br></font></td>

			</tr>
			<tr>
			 <td align='center'>THURSDAY</td>
			 <td  align="center"><font color="blue"><?php echo $ans[3][0] ; ?><br></font></td>
			  <td  align="center"><font color="blue"><?php echo $ans[3][1] ; ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[3][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[3][3] ; ?><br></font></td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[3][4] ;echo "    ".$ans[3][4] ; ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[3][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[3][7] ; ?><br></font></td>

			</tr>
			<tr>
			 <td align='center'>FRIDAY</td>
			 <td align="center"><font color="blue"><?php echo $ans[4][0] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[4][1] ; ?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo $ans[4][2] ; ?><br></font></td>
			  <td  align="center"><font color="blue"><?php echo $ans[4][3] ; ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[4][4] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[4][5] ; ?><br></font></td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[4][6] ; echo "    ".$ans[4][7] ;  ?><br></font></td>
			

			</tr>
			
		</table>


	</div>

	<div class="third_year" style="background-color: #f9f9f9 ;">
		<h2>
			Third Year Time Table :
		</h2>
		
		<h3>
			It - 3 yr - Section : A
		</h3>

		<table border="2" cellspacing="3" align="center">
			
			<tr>
				 <td align="center">	</td>
				 <td align="center">1</td>
				 <td align="center">2</td>
				 <td align="center">	</td>
				 <td align="center">3</td>
				 <td align="center">4</td>
				 <td align="center">	</td>
				 <td align="center">5</td>
				 <td align="center">6</td>
				 <td align="center">	</td>
				 <td align="center">7</td>
				 <td align="center">8</td>
			</tr>
			<tr>
				 <td align="center">
				 <td>8:30 -9:20</td>
				 <td>9:20-10:10</td>
				 <td>10:10-10:25</td>
				 <td>10:25-11:15</td>
				 <td>11:15-12:05</td>
				 <td>12:05-12:15</td>
				 <td>12:15-1:05</td>
				 <td>1:05-1:55</td>
				 <td>1:55-2:25</td>
				 <td>2:25-3:15</td>
				 <td>3:15-4:00</td>
			</tr>

<?php

				$get_data = $mysqli->query("SELECT * FROM it_fifth_sem ");
				$ans= [[]] ;
				$index=0 ;
				
				while($row= mysqli_fetch_array($get_data))
				{
					$ans[$index][0]=$row['lctr1'] ;
					$ans[$index][1]= $row['lctr2'] ;
					$ans[$index][2]=$row['lctr3'] ;
					$ans[$index][3]=$row['lctr4'] ;
					$ans[$index][4]=$row['lctr5'] ;
					$ans[$index][5]=$row['lctr6'] ;
					$ans[$index][6]=$row['lctr7'] ;
					$ans[$index][7]=$row['lctr8'] ;
					$index ++;

					
						
				}
				

	?>


			<tr>
				 <td align='center'>MONDAY</td>
				 <td align="center"><font color="blue"><?php echo $ans[0][0] ; ?><br></font></td>
				 <td align="center"><font color="blue"><?php echo $ans[0][1] ; ?><br></font></td>
				
				
				 <td rowspan="6" align="center">L<br>U<br>N<br>C<br>H</td>
				 <td  colspan="2" align="center"><font color="red"><?php echo $ans[0][2] ;   echo "    ".$ans[0][3] ;?><br></font></td>
				
				 <td rowspan="6"align="center">L<br>U<br>N<br>C<br>H</td>
				 <td align="center"><font color="green"><?php echo $ans[0][4] ; ?><br></font></td>
				 <td align="center"><font color="blue"><?php echo $ans[0][5] ; ?><br></font></td>
				 <td rowspan="6"align="center">L<br>U<br>N<br>C<br>H</td>
				 <td  colspan="2" align="center"><font color="#c9972c"><?php echo "Activity" ?><br></font></td>

				 

			</tr>
			<tr>
			 <td align='center'>TUESDAY</td>
			 <td  align="center"><font color="blue"><?php echo $ans[1][0] ; ?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo "   ". $ans[1][1] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][3] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][4] ; ?><br></font></td>
			<td align="center"><font color="blue"><?php echo $ans[1][5] ; ?><br></font></td>			
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[1][6] ;echo "    ".$ans[1][7] ; ?><br></font></td>
			

			</tr>
			<tr>
			 <td align='center'>WEDNESDAY</td>
			 <td  align="center"><font color="blue"><?php echo $ans[2][0] ; ?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo $ans[2][1] ; ?><br></font></td>
			
			 <td align="center"><font color="blue"><?php echo $ans[2][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[2][3] ; ?><br></font></td>
			 <td colspan="2" align="center"><font color="red"><?php echo  $ans[2][4] ; echo "    ".$ans[2][5]  ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[2][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[2][7] ; ?><br></font></td>

			</tr>
			<tr>
			 <td align='center'>THURSDAY</td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[3][0] ;  echo "    ".$ans[3][1] ; ?><br></font></td>
			  
			 
			 <td align="center"><font color="blue"><?php echo $ans[3][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[3][3] ; ?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo $ans[3][4] ;?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo $ans[3][5] ; ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[3][6] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[3][7] ; ?><br></font></td>

			</tr>
			<tr>
			 <td align='center'>FRIDAY</td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[4][0] ;echo "    ".$ans[4][1] ; ?><br></font></td>
			
			 <td  align="center"><font color="blue"><?php echo $ans[4][2] ; ?><br></font></td>
			  <td  align="center"><font color="blue"><?php echo $ans[4][3] ; ?><br></font></td>
			 
			 <td align="center"><font color="blue"><?php echo $ans[4][4] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[4][5] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[4][6] ;  ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[4][7] ;  ?><br></font></td>
			

			</tr>
			
		</table>


	</div>
	
	<div class="final_year">
		<h2>
			Final Year Time Table :
		</h2>
		
		<h3>
			It - 4 yr - Section : A
		</h3>

		<table border="2" cellspacing="3" align="center">
			
			<tr>
				 <td align="center">	</td>
				 <td align="center">1</td>
				 <td align="center">2</td>
				 <td align="center">	</td>
				 <td align="center">3</td>
				 <td align="center">4</td>
				 <td align="center">	</td>
				 <td align="center">5</td>
				 <td align="center">6</td>
				 <td align="center">	</td>
				 <td align="center">7</td>
				 <td align="center">8</td>
			</tr>
			<tr>
				 <td align="center">
				 <td>8:30 -9:20</td>
				 <td>9:20-10:10</td>
				 <td>10:10-10:25</td>
				 <td>10:25-11:15</td>
				 <td>11:15-12:05</td>
				 <td>12:05-12:15</td>
				 <td>12:15-1:05</td>
				 <td>1:05-1:55</td>
				 <td>1:55-2:25</td>
				 <td>2:25-3:15</td>
				 <td>3:15-4:00</td>
			</tr>

<?php

				$get_data = $mysqli->query("SELECT * FROM it_seventh_sem ");
				$ans= [[]] ;
				$index=0 ;
				
				while($row= mysqli_fetch_array($get_data))
				{
					$ans[$index][0]=$row['lctr1'] ;
					$ans[$index][1]= $row['lctr2'] ;
					$ans[$index][2]=$row['lctr3'] ;
					$ans[$index][3]=$row['lctr4'] ;
					$ans[$index][4]=$row['lctr5'] ;
					$ans[$index][5]=$row['lctr6'] ;
					$ans[$index][6]=$row['lctr7'] ;
					$ans[$index][7]=$row['lctr8'] ;
					$index ++;

					
						
				}
				

	?>


			<tr>
				 <td align='center'>MONDAY</td>
				 <td  colspan="2" align="center"><font color="red"><?php echo $ans[0][0] ; echo "    ".$ans[0][1] ; ?><br></font></td>
				 
				
				
				 <td rowspan="6" align="center">L<br>U<br>N<br>C<br>H</td>
				 <td   align="center"><font color="blue"><?php echo $ans[0][2] ; ?><br></font></td>
				 <td   align="center"><font color="blue"><?php echo $ans[0][3] ; ?><br></font></td>
				
				 <td rowspan="6"align="center">L<br>U<br>N<br>C<br>H</td>
				 <td align="center"><font color="green"><?php echo $ans[0][4] ; ?><br></font></td>
				 <td align="center"><font color="blue"><?php echo $ans[0][5] ; ?><br></font></td>
				 <td rowspan="6"align="center">L<br>U<br>N<br>C<br>H</td>
				 <td   align="center"><font color="blue"><?php echo $ans[0][6] ; ?><br></font></td>
				 <td   align="center"><font color="blue"><?php echo $ans[0][7] ; ?><br></font></td>

				 

			</tr>
			<tr>
			 <td align='center'>TUESDAY</td>
			 <td  align="center"><font color="blue"><?php echo $ans[1][0] ; ?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo $ans[1][1] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][2] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[1][3] ; ?><br></font></td>
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[1][4]     ; echo "    ".$ans[1][5] ; ?><br></font></td>
				
			 
			 <td  align="center"><font color="blue"><?php echo $ans[1][6] ;?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo $ans[1][7] ;?><br></font></td>
			

			</tr>
			<tr>
			 <td align='center'>WEDNESDAY</td>
			 <td  colspan="2" align="center"><font color="red"><?php echo $ans[2][0] ; echo "    ".$ans[2][1] ; ?><br></font></td>
			 <td  align="center"><font color="blue"><?php echo $ans[2][2] ; ?><br></font></td>
			
			 <td align="center"><font color="blue"><?php echo $ans[2][3] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo $ans[2][4] ; ?><br></font></td>
			 <td align="center"><font color="blue"><?php echo  $ans[2][5] ;  ?><br></font></td>

			 
			 <td colspan="2" align="center"><font color="red"><?php echo $ans[2][6] ; echo "    ".$ans[2][7] ;?><br></font></td>
			 

			</tr>
			
			
		</table>


	</div>
</body>
</html>