<?php

include('layout.php');

if ($_SESSION["user"] == "1" && $_SESSION['row']['role_id'] == 1) {

}else

{
	header('location:../index.php');
}




 $conn = conncection('localhost','root','','login_db');


if (isset($_POST['btnSubmit'])) {

	 if (!empty($_POST['title']) and ($_POST['user']!=='user') and ($_POST['status']!=='Status') and  (!empty($_POST['details']))) {
	 	
	 		$title = $_POST['title'];
	        $user = $_POST['user'];
	        $created_at = date('Y-m-d H:i:s');
	        $created_by=$_SESSION['row']['username'];
	        $status=$_POST['status'];
	        echo $details = $_POST['details'];
            $deadline = $_POST['deadline'];
	
	        $query= "insert into tickets (title,user,created_at,created_by,status,details,deadline) values('$title','$user','$created_at','$created_by','$status','". $_POST['details'] ."','$deadline')";

	        $result = mysqli_query($conn,$query);
            echo $result;
            
            if($result>0)

            {
            	header('location:success.php');
            }


	 } else
	    {
	    	echo '<div class="alert alert-danger" role="alert">
                 Please fill all data
</div>';
	    }


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
.btnContactSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    color: #fff;
    
    border: none;
    cursor: pointer;
}
</style>



<div class="container contact-form">

                        
            <form method="post" >
                <h3>Create Ticket</h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Title *" value=""  required="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="deadline" class="form-control" placeholder="Deadline *" value=""  required="" />
                        </div>                        
                        <div class="form-group">
                            
                            <select name ="user" class="form-control" >
                            	<option>Asign To</option>
                            	<?php 
                                     $sql = "select * from users";
                                     $result = mysqli_query($conn,$sql);
                                      
                                      if(mysqli_num_rows($result)>0)
                                      {	
                                       while($row = mysqli_fetch_assoc($result))
                                       {
                                       	echo '<option>'.$row['username'].'</option>';
                                       }
                                   }
                            	?>   
                            </select>
                        </div>
                        <div class="form-group">
                            <select name ="status" class="form-control">
                            	<option>Status</option>
                            	<option>Open</option>
                            	<option>Done</option>
                            	<option>Closed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btnContact" value="Add" />
                        </div>



                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="details" class="form-control" placeholder="Details *" style="width: 100%; height: 150px;" required=""></textarea>
                        </div>
                    </div>
                </div>
            </form>
</div>
  

