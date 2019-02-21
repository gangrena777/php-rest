 <?php
	
include('db.php');
 session_start();

      /////get all deal /////
     if(isset($_GET['todolist']) && $_GET['todolist'] == 'all'){
          
          $sql = "SELECT  * FROM todolist";
          $res = mysqli_query($link, $sql);

          if(mysqli_num_rows($res)>0) 
          {
          	 //$row = mysqli_fetch_assoc($res);
            $row = mysqli_fetch_array($res);
            $list= array();

/*             
          	  $id = array();
          	  $text = array();
          	  $date = array();
          	  $status = array();
          	  */
          	   do{
           /*   array_push($id, $row['id']);
              array_push($text, $row['text']);
              array_push($date, $row['date']);
              array_push($status, $row['status']);
               
              */
              $list[] = $row;
                  } 
                while($row = mysqli_fetch_array($res));
              //  $cd_result = array($id, $text, $date, $status);
              //  $cd_answer = json_encode($cd_result);
             //  echo $cd_answer ; // encode in json format
                 $cd = json_encode($list);

             echo $cd;
         }
          else {
          	$mess = "db is empty";
          	echo  $mess;
          }


     }


     /// ////////////////////////
    
       /// add begin/////
	if(isset($_GET['new_todo']) && $_GET['new_todo'] !==''){

		$deal = htmlspecialchars($_GET['new_todo']);
		$date = date("Y-m-d/h:i:s");
		

		$sqll = "INSERT INTO todolist (`text`, `date`) VALUES ('".$deal."', '".$date."')";
		
		$ress = mysqli_query($link, $sqll);
		if($ress){
			$_SESSION['flash'] =[ 
                           'text' =>'New deal was seccessfuly add',
                           'status' =>'success'
                           ];
                            // header ('Location: ./');
	                       // die();
                          
		}
		else{
			$_SESSION['flash'] =[ 
                           'text' =>'Problem adding data',
                           'status' =>'danger'
                           ];;
		}
	
	
	}
	////// add end /////
	////edit begin /////
if((isset($_GET['edit_todo']) && $_GET['edit_todo'] !=='')&&(isset($_GET['id']) && $_GET['id'] !=='')){
        $id = $_GET['id'];
		$deal = htmlspecialchars($_GET['edit_todo']);
		$date = date("Y-m-d/h:i:s");
		           if(isset($_GET['status']) && $_GET['status'] !=='')
		            {
		                 $status =$_GET['status'];
	                }
	                else $status ='0';

		$sqll = "UPDATE todolist SET `text` ='$deal', `date` ='$date', status='$status' WHERE id ='$id' ";

		
		$ress = mysqli_query($link, $sqll);
		if($ress){
			$_SESSION['flash'] =[ 
                           'text' =>'New deal was seccessfuly edit',
                           'status' =>'success'
                           ];
                            // header ('Location: ./');
	                       // die();
                          
		}
		else{
			$_SESSION['flash'] =[ 
                           'text' =>'Problem editing data',
                           'status' =>'danger'
                           ];;
		}
	
	
	}

	/////edit end /////

	//////del begin /////
     
	    if(isset($_GET['del_id']) && $_GET['del_id'] !==''){
              $id = $_GET['del_id'];
	         $sqll = "DELETE FROM todolist  WHERE id ='$id'";
           $ress = mysqli_query($link, $sqll);
		   if($ress){
			      $_SESSION['flash'] =[ 
                                         'text' =>'Deal was seccessfuly delete',
                                       'status' =>'success'
                                      ];
                                   // header ('Location: ./');
	                              // die();
                    }
		  else{
			  $_SESSION['flash'] =[ 
                           'text' =>'Problem editing data',
                           'status' =>'danger'
                           ];
		       }
	
	
	}
	/////del end//////

?>