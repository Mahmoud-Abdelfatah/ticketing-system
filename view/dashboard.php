<?php
include('layout.php');


if ($_SESSION["user"] == "1") {

	 $conn = conncection('localhost','root','','login_db');


}else

{
	header('location:../index.php');
}

 function foo($seconds) {
  $t = round($seconds);
  return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
}

header("Refresh:180");    // refresh page after 3 minets


$idletime=3600;//after 60 seconds the user gets logged out
if (time()-$_SESSION['timestamp']>$idletime){
header('location:../logout.php');
}else{
  //  $_SESSION['timestamp']=time();
}
  
?>





<div class="container">
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading" id="">All Tickets</div>

  <!-- Table -->
  <table class="table" style="">
    <thead>
    	<th>#</th>
    	<th>Title</th>
    	<th>Asigned To</th>
    	<th>Created At</th>
    	<th>Status</th>
    	<th>Created By</th>
    	<th>Created From</th>
    	<th>Action</th>
    </thead>
    <tbody>
    	
    	<?php

    	  $sql = "select * from tickets";
    	  $result = mysqli_query($conn,$sql);

    	 if(mysqli_num_rows($result )>0)
    	 {

    	 	while ($row=mysqli_fetch_assoc($result)) {
    	 		
    	 		   $time_of_ticket = strtotime(date('Y-m-d H:i:s')) - strtotime($row['created_at']);
                   $deadline = $row['deadline']*24*60*60;

                 echo '<tr>';
                 echo '<td>'.$row['id'].'</td>';                
                 echo '<td>'.$row['title'].'</td>';
                 echo '<td>'.$row['user'].'</td>';
                 echo '<td>'.$row['created_at'].'</td>';
                 if($time_of_ticket>$deadline && $row['in_time']!=1)
                 {
                 	echo '<td ><button class="btn btn-defult" style="background-color: red">'.$row['status'].'</button></td>';
                 }elseif($row['in_time']==1)
                 {
                    echo '<td ><button class="btn btn-warning" >'.$row['status'].'</button></td>';
                 }else
                 {
                 	echo '<td ><button class="btn btn-info" >'.$row['status'].'</button></td>';
                 }
                 
                 echo '<td>'.$row['created_by'].'</td>';
                 echo '<td>'.foo($time_of_ticket).'</td>';
                 echo '<td><a href="view_ticket.php/?id='.$row['id'].'" class=" btn btn-primary glyphicon glyphicon-eye-open"></a>';
                 if ($_SESSION['row']['role_id']==1) {
                 	echo     ' '.'<a href="edit_ticket.php/?id='.$row['id'].'" class="btn btn-warning">Edit</a>';
                 }
                      
                   echo    '</td>';
                
                 echo '</tr>';
    	 	}
    	 }else

    	  {
    	  	       echo '<tr><td><div class="row">'.
  	               '<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">'.
                   '<h2>No Tickets!</h2>'.
  	               '</div>'. 
                   '</div></td></tr>';
    	  }
    	?>
    </tbody>
  </table>
</div>
</div>

