<?php
include('layout.php');

if ($_SESSION["user"] == "1") {

	 $conn = conncection('localhost','root','','login_db');


}else

{
	header('location:../index.php');
}

if (isset($_POST['submit'])) {
	
	$id = $_GET['id'];
	$user_notes = $_POST['user_notes'];
	$qyery = "select * from tickets where id = '$id' ";
	$result = mysqli_query($conn,$qyery);
	if (mysqli_num_rows($result)>0) {
	
	while ( $row=mysqli_fetch_assoc($result)) {

             	$time_of_ticket = strtotime(date('Y-m-d H:i:s')) - strtotime($row['created_at']);
	              $deadline = $row['deadline']*24*60*60;

	          // echo $deadline.'  '.$time_of_ticket;
	         if($time_of_ticket>$deadline)
	          {
                    $updeat_status = "update tickets set status ='Done',user_note='$user_notes' where id='$id' ";
	          }else
	              {
                   $updeat_status = "update tickets set status ='Done',in_time='1',user_note='$user_notes' where id='$id' ";
	             }
    
    $result_of_update = mysqli_query($conn,$updeat_status);
    header('location:../dashboard.php');
     
	    }
	}


}



?>



<div class="container" >	
<table class="table table-hover table-bordered" >
		<?php
		  if(isset($_GET['id'])){


$ticket_id =  $_GET['id'];
$sql = "select * from tickets where id = '$ticket_id' ";
 $result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result)>0) {
	
	while ( $row=mysqli_fetch_assoc($result)) {

	 echo '<tr class="active">
	    <th>
		Ticket Title
	    </th>
	      <td>'.$row['title'].'</td>
	 </tr>
    <tr class="warning">
		<th>
			Ticket Status
		</th>
		<td>'
			.$row['status'].
		'</td>
	</tr>
	<tr class="success">
		<th>
			Asigned To
		</th>
		<td>'
			.$row['user'].
		'</td>
	</tr>
	<tr class="warning">
		<th>
			Created By
		</th>
		<td>'
			.$row['created_by'].
		'</td>
	</tr>
	<tr>
		<th>
			Created At
		</th>
		<td>'
			.$row['created_at'].
		'</td>
	</tr>
	<tr class="danger">
		<th>DeadLine
		</th>
		<td>'
			.$row['deadline'].
		'Day</td>
	</tr>
	<tr class="active">	
		<th>Details
		</th>
		<td><textarea  rows="8" cols="100" class="form-control" disabled>'
			.$row['details'].
		'</textarea></td>
	</tr>';		
    }

}

}
		?>


<form method="POST">

   <tr class="active">	
		<th>User Notes
		</th>
		<td><textarea name="user_notes"  rows="5" cols="100"  class="form-control"></textarea></td>
	</tr>		
</table>





	<button type="submit" name="submit" class="btn btn-success" style="float: right; margin: 0px 10px 0px 5px">Done</button>
	<!-- <a type="button" class="btn " onclick="status();">Check connectivity status</a> -->
</form>

<a href="../dashboard.php" class="btn btn-warning" style="float: right">Back</a>	

</div>

 <script>
    function status()
    {
        if(navigator.onLine)
        {
            alert("Browser is online");
        }
        else
        {
            alert("Browser is offline");
        }
    }
</script>