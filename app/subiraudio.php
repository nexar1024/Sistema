<?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
  
  	include_once("config.php");
  	  	   date_default_timezone_set('America/Guayaquil');
       // $id_entrevista = $_POST['id_entrevista'];
       $id_entrevista = 10;
        $originalImgName= date('dmYHis') ."-". $_FILES['filename']['name'];
        $tempName= $_FILES['filename']['tmp_name'];
        $folder="uploadedFiles/";
        $url = "/uploadedFiles/".$originalImgName; //update path as per your directory structure 
        
        if(move_uploaded_file($tempName,$folder.$originalImgName)){
                $query = "INSERT INTO  resultadosentrevista(id_entrevista,audio) VALUES ('$id_entrevista', '$url')";
                if(mysqli_query($con,$query)){
                
                	 $query= "SELECT * FROM resultadosentrevista WHERE audio='$url'";
	                 $result= mysqli_query($con, $query);
	                 $emparray = array();
	                     if(mysqli_num_rows($result) > 0){  
	                     while ($row = mysqli_fetch_assoc($result)) {
                                     $emparray[] = $row;
                                   }
                                   echo json_encode(array( "status" => "true","message" => "Successfully file added!" , "data" => $emparray) );
                                   
	                     }else{
	                     		echo json_encode(array( "status" => "false","message" => "Failed!") );
	                     }
			   
                }else{
                	echo json_encode(array( "status" => "false","message" => "Failed!") );
                }
        	
        }else{
        	echo json_encode(array( "status" => "false","message" => "Failed!") );
        }
  }
?>