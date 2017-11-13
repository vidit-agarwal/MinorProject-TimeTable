<?php

 //initialising the teacehr time table of the IT department with value 0 in database ;


$mysqli = NEW  MySQLi('localhost', 'root', 'root' , '') ;

$query = $mysqli->query("SELECT table_name from  information_schema.tables where table_schema='teacher_tt'; ");

if($query)
{
	echo "Table  Names : " ;

	while($row = mysqli_fetch_assoc($query)){ // loop to store the data in an associative array.
     			echo $row['table_name'] ;
     			$table = $row['table_name'] ;

     			for($i=0 ; $i<5 ; $i++)
     			{

				$result = $mysqli->query(" INSERT into teacher_tt.$table (lctr1 , lctr2 , lctr3 , lctr4 , lctr5 , lctr6 , lctr7, lctr8) values ('0','0','0','0','0','0','0','0') ;");     

				if($result)
					echo "Insert" ;
				else
					echo $mysqli->error ;			
				}

				
				echo "Initialised" ;
				echo "<br>" ;


     		
		}

}

else
		echo "fail" ;
     


?>