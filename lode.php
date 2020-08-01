<?php 
	$con = mysqli_connect('localhost','root','','task');

	extract($_POST);
	$data = "";

	//----- show data----------------- ---------

	if(isset($_POST['readrecord'])){
		?>            <table class='table table-bordered'>	
						<tr>
							<th>NO.</th><th>First name</th><th>Last name</th>
							<th>Email</th><th>Mobile</th><th>Edit Action</th>
							<th>Delete Action</th>
						</tr>
		<?php 	
		 $showdata = mysqli_query($con, "SELECT * FROM `ajaxcurd`");

		 if(mysqli_num_rows($showdata) > 0){
		 	$no = 1;
		 	while (	$row = mysqli_fetch_array($showdata)) {
		 		?><tr>
							 <td><?php echo $no;?></td>	
							 <td><?php echo $row['firstname'];?></td>	
							 <td><?php echo $row['lastname'];?></td>	
							 <td><?php echo $row['email'];?></td>	
							 <td><?php echo $row['mobile'];?></td>	
							 <td><button class="btn btn-warning" onclick="edit_user(<?php echo $row['id']?>)">Edit User</button>
							 </td>
							 <td><button class="btn btn-danger" onclick="delete_user(<?php echo $row['id']?>)">Delete User</button>
							 </td>
		 				  </tr>
		 		<?php
		 		 $no++;
		 	}
		 }
		 	echo "</table>";
	}


	// ----insert data-----------------------------------------

	if(isset($_POST['fname']))
	{
		$q = mysqli_query($con,"INSERT INTO `ajaxcurd`(`firstname`, `lastname`, `email`, `mobile`) VALUES ('$fname','$lname','$email','$mobile')");
	}

	//------------dalate recoders--------------------

	if(isset($_POST['deleteid'])){
		$userid = $_POST['deleteid'];

		$dalete = mysqli_query($con,"DELETE FROM `ajaxcurd` WHERE id ='$userid' ");

	}

//----------update data backend----------

	if(isset($_POST['update_id']) && $_POST['update_id'] != ""){

		$userid = $_POST['update_id'];

		$run = mysqli_query($con,"select * form ajaxcurd where id ='$userid'");

		 $res = array();

		 if(mysqli_num_rows($run)> 0){

		 	while($row = mysqli_fetch_assoc($run)){
		 		$res = $row;
		 	}
		 }
		 else{
		 	$res['status'] = 200;
		 	$res['message'] = "data not found";
		 }
		 echo json_encode($res);
	} else{
		    $res['status'] = 200;
		 	$res['message'] = "invalid request";	
	}













 ?>