
<?php
 
 include('layout.php');

if ($_SESSION["user"] == "1"  && $_SESSION['row']['role_id'] == 1) {

	 $conn = conncection('localhost','root','','login_db');


}else

{
	header('location:../index.php');
}

if (isset($_POST['btnSubmit'])) {
	 
	 $id = $_GET['id'];
	 $title = $_POST['title'];
	 $deadline = $_POST['deadline'];
	 $asigen_to = $_POST['user'];
	 $status = $_POST['status'];
	 $details = $_POST['details'];

   if ($status=='Open') {
     
     $updete_query ="update tickets set title = '$title',deadline='$deadline',user='$asigen_to',status='$status',details='$details' , in_time='0' where id= '$id' ";
   }else
   {
     $updete_query ="update tickets set title = '$title',deadline='$deadline',user='$asigen_to',status='$status',details='$details' where id= '$id' ";
   }

	 
	 $result_of_query = mysqli_query($conn,$updete_query);
}

?>


<style type="text/css">
		
.contact-form{
    background: #fff;
    margin-top: 5%;
    margin-bottom: 5%;
    width: 70%;
}
.contact-form .form-control{
    border-radius:1rem;
}
.contact-image{
    text-align: center;
}
.contact-image img{
    border-radius: 6rem;
    width: 11%;
    margin-top: -3%;
    transform: rotate(29deg);
}
.contact-form form{
    padding: 14%;
}
.contact-form form .row{
    margin-bottom: -7%;
}
.contact-form h3{
    margin-bottom: 8%;
    margin-top: -10%;
    text-align: center;
    color: #0062cc;
}
.contact-form .btnContact {
    width: 50%;
    border: none;
    border-radius: 1rem;
    padding: 1.5%;
    background: #dc3545;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
}

.button5 {border-radius: 10px;

    width: 100px;
    height: 30px; 
    text-align: center;

}

</style>



<div class="container contact-form">

            <form method="post" >
                <h3>Edit Ticket</h3>
               <div class="row">
                    <div class="col-md-6">
                    	<?php
                                    $id = $_GET['id'];
                                     $sql = "select * from tickets where id = $id ";
                                     $result = mysqli_query($conn,$sql);
                                      
                                      if(mysqli_num_rows($result)>0)
                                      {	
                                       while($row = mysqli_fetch_assoc($result))
                                       {                    	

                       echo  '<div class="form-group">';
                        echo '<input type="text" name="title" class="form-control"   value="'.$row['title'].'"  required="" />';
                       echo  '</div>
                        <div class="form-group">
                            <input type="text" name="deadline" class="form-control"  value="'.$row['deadline'].'"  required="" />
                        </div>'; 

                                          }
                                      }
                        ?>                       
                        <div class="form-group">
                            
                            <select name ="user" class="form-control" >

                            	<?php
                            	     $id = $_GET['id'];
                                     $sql_selected = "select * from tickets where id = $id ";
                                     $selected = '';
                                     $result_selected = mysqli_query($conn,$sql_selected);
                                      
                                      if(mysqli_num_rows($result_selected)>0)
                                      {	
                                       while($row = mysqli_fetch_assoc($result_selected))
                                       {   
                                       	 $selected = $row['user'];
                            	          echo '<option>'.$row['user'].'</option>';


                            	     }
                            	    }
                            	 
                                     $sql = "select * from users";
                                     $result = mysqli_query($conn,$sql);
                                      
                                      if(mysqli_num_rows($result)>0)
                                      {	
                                       while($row = mysqli_fetch_assoc($result))
                                       {
                                       	if($row['username']!=$selected)
                                       	{
                                       			echo '<option>'.$row['username'].'</option>';
                                       	}
                                       
                                       }
                                   }
                            	?>   
                            </select>
                        </div>
                        <div class="form-group">
                            <select name ="status" class="form-control">

                            	<?php
                            	     $id = $_GET['id'];
                                     $sql_selected = "select * from tickets where id = $id ";
                                     $selected = '';
                                     $result_selected = mysqli_query($conn,$sql_selected);
                                      
                                      if(mysqli_num_rows($result_selected)>0)
                                      {	
                                       while($row = mysqli_fetch_assoc($result_selected))
                                       {   
                                       	 $selected = $row['status'];
                            	          echo '<option>'.$row['status'].'</option>';

                                           if ($selected == 'Open') {
                                           	
                                           	 echo '<option>Closed</option>';
                                           }
                                           elseif($selected == 'Closed' )
                                           {
                                                    echo '<option>Open</option>';
                                           }elseif( $selected == 'Done')
                                           {
                                           	  echo '<option>Open</option>';
                                           	   echo '<option>Closed</option>';
                                           }
                            	     }
                            	    }
                            	 

                            	?>

                            	
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btnContact" value="Edit" />
                            <a  href="../dashboard.php" name="btnSubmit" class=" btn btn-info button5" value="" >Back</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">

                        	<?php
                                  
                                     $id = $_GET['id'];
                                     $sql = "select * from tickets where id = $id ";
                                     $result = mysqli_query($conn,$sql);
                                      
                                      if(mysqli_num_rows($result)>0)
                                      {	
                                       while($row = mysqli_fetch_assoc($result))
                                       {    

                                       	   echo '<textarea name="details" class="form-control"  style="width: 100%; height: 150px;" required="">'.$row['details'].'</textarea>';

                                       	}
                                       	}                            

                        	?>

                        </div>
                    </div>
                </div>
            </form>
</div>