<?php require_once('css_apis/api_class.php'); 

$data=$css->run_query('SELECT * FROM `user` join usersubjects WHERE user.user_id =usersubjects.UserId group BY user_id');

if(isset($_POST['name'])){

    $pk = $_POST['pk']; //primary key aka ID
    $value = $_POST['value']; //value of the field
    $css->update_single_where_key('user' , 'status' , $value , 'user_id' , $pk);

}
if(isset($_GET['status'])){
	$query="SELECT * FROM `user` join usersubjects WHERE user.user_id =usersubjects.UserId AND status=$_GET[status] group BY user_id ";
	$data = $css->run_query($query);
}



?>



<html>
<head>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-html5-1.2.2/cr-1.3.2/r-2.1.0/datatables.min.css"/>


<!-- 
  <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/main.css">

  <style>
  body{
  	background-color: white;
  }
  	</style>
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
				<h1 class='text-center'>Admin Panel</h1>
				<h3 class='text-center'>Registrations Table</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
				<h5 style='float:left;font-size:15px;padding-right:10px;'>Show For: </h5>
				<div style='float:left'>
					<a href="registrations.php?status='Pending'" role='btn' class='btn btn-primary'>Pending</a>
					<a href="registrations.php?status='Paid'"  role='btn' class='btn btn-primary'>Paid</a>
					<a href="registrations.php"  role='btn' class='btn btn-primary'>All</a>
				</div>
			</div>
		</div>
		<div class="row"> &nbsp;</div>
		<br>
		<div class="row">
			
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
				
				<table id="registrations_table" class='table table-respo'>
				    <thead>
				      <tr>
				      	<th>S.no</th>
				      	<th>Name</th>
				      	<th>Email</th>
				      	<th>Packege Selected</th>
				      	<th>Start Date</th>
				      	<th>End Date</th>
				      	<th>Months</th>
				      	<th>Status</th>
				      </tr>
				    </thead>
				    <tbody>

				     <tr>
				     	
				      <?php $no=1; foreach ($data as $key ):
				      ?>
				      		<td><?php echo $no; ?></td>
				      		<!-- <td><input type="checkbox" class='checks' value='<?=$key['user_id']?>'></td> -->
				      		<td><?php echo $key['fname']; ?></td>
				      		<td><?php echo $key['email']; ?></td>
				      		<td>
				      			<?php 
				      			 if($key['usertype']==1) 
				      			 		echo "Standard";
				      			 else if($key['usertype']==2)
				      			 		echo "Premium";
				      			 else if($key['usertype']==3)
				      			 		echo "Custom";

				      			 ?>
				      		
				      		</td>
				      		<td>
				      			<?php 
				      			echo $key['start'];
				      		?>
				      	</td>
				      	<td><?=$key['end']?></td>
				      	<td><?=$key['months']?></td>
				      	<td>

				      		<a href="#" class="comments1" data-type="select" data-name="status" data-url="registrations.php" data-pk="<?php echo $key['user_id'] ?>"><?php echo $key['status'] ?></a>

				      	</td>

					

				      		

				      </tr>
				      <?php 
				      $no++;
				      endforeach;
				       ?>
				    </tbody>
				  </table>

			</div>

		</div>
	

	</div>


  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-html5-1.2.2/cr-1.3.2/r-2.1.0/datatables.min.js"></script>

 


  
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<!-- 
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
 -->


  <script>
  $(function(){
    $("#registrations_table").dataTable();

    // $.fn.editable.defaults.mode = 'inline';
    $('.comments1').editable({
        value: 1,   
        url:  "registrations.php",
         source: [
              {value: 'Paid', text: 'Paid'},
              {value: 'Pending', text: 'Pending'}
           ],
        ajaxOptions: {
         type: 'POST'
       }


  })

});

$("input[type=search]");

  </script>
</body>
</html>

