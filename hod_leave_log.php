<?php
session_start();
$emp_id=$_SESSION['emp_id'];


if(!isset($_SESSION['emp_id'])) 
	{ 
		header("Location:http://localhost/Pluto/index_1.php");
		exit;
	} 

try
{
	$db = new PDO("mysql:dbname=leave_management;host=localhost", "root", "" );
}
catch(PDOException $e)
{
    alert($e->getMessage()) ;
}   

$sql="select * from emp_table where emp_id='$emp_id'";
foreach($db->query($sql) as $row)
?>
<!DOCTYPE html>

<html>
	<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
<!-- MEMO: update me with `git checkout gh-pages && git merge master && git push origin gh-pages` -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">


  <title>HOD <?php echo $row['name'];?></title>

  <!-- Material Design fonts -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Material Design -->
  <link href="dist/css/bootstrap-material-design.css" rel="stylesheet">
  <link href="dist/css/ripples.min.css" rel="stylesheet">


  <link href="http://fezvrasta.github.io/snackbarjs/dist/snackbar.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body background="abc_16.jpg">

<div class="container">

  <!-- Navbar
================================================== -->
<div class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                  <li><a href="javascript:void(0)"><i class="material-icons">fingerprint</i>
				  <b></b></a></li>
				  <li><a href="http://localhost/Pluto/staff_home.php"><b><?php echo $row['name'];?></b></a></li>
                </ul>


                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons md-48"><i class="material-icons">account_circle</i></i>
                      <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="http://localhost/Pluto/hod_home.php"><i class="material-icons">assignment</i></i> Home</a></li>
					  <li><a href="http://localhost/Pluto/hod_leave_application.php"><i class="material-icons">assignment</i></i> Leave Application</a></li>
					  <li><a href="http://localhost/Pluto/hod_leave_history.php"><i class="material-icons">assignment</i></i> Leave History</a></li>
                      <li class="divider"></li>
                      <li><a href="http://localhost/Pluto/PHP/Logout.php"><i class="material-icons">power_settings_new</i> LOG OUT</a></li>
                    </ul>
                  </li>
                </ul>
				
              </div>
            </div>
          </div>
  <!-- Forms
================================================== -->
  <div class="bs-docs-section">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1 id="forms"><font color="white">Application</font></h1>
        </div>
      </div>
    </div>

     <div class="row">
      <div >
        <div class="well bs-component">
            <fieldset>
              <legend>Pending Leave Requests</legend>
			  
			  <table class="table table-striped table-hover ">
  <thead>
  <tr>
    <th>Leave ID</th>
	<th>Employee ID</th>
    <th>Leave Type</th>
    <th>Application Date</th>
    <th>Start Date</th>
	<th>End Date</th>
	<th>Days</th>
	<th>Status</th>
  </tr>
  </thead>
<?php $sql="select * from leave_log where status='Pending'";
$key=0;
foreach($db->query($sql) as $row){
	$key++;?>
  <tbody>
  <tr>
    <td><?php echo $row['leave_id'];?></td>
	<td><?php echo $row['emp_id'];?></td>
    <td><?php echo $row['ltype'];?></td>
    <td><?php echo $row['date_now'];?></td>
    <td><?php echo $row['start_date'];?></td>
	<td><?php echo $row['end_date'];?></td>
	<td><?php echo $row['days'];?></td>
	<td><?php echo $row['status'];?></td>
	<td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" <?php echo "data-target=\"#myModal".$key."\""; ?>> View</button></td>
	
	
	
	
	<div class="modal fade" role="dialog" <?php echo "id=\"myModal".$key."\""; ?>>
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Issue?</h4>
        </div>
        <div class="modal-body">
		<form action="http://localhost/Pluto/PHP/leave_accept.php" method="post">
		<div class="form-group">
			<input value="<?php echo $row['leave_id'];?>" name="leave_id">
			<input value="<?php echo $row['emp_id'];?>" name="emp_id">
			<input value="<?php echo $row['ltype'];?>" name="ltype">
			<div class="col-md-10">
						<select id="select111" class="form-control" name="status">
						<option value="Pending">Pending</option>
						<option value="Accepted">Accepted</option>
						<option value="Declined">Declined</option>
						</select>
				</div>
		</div>
		<br>
		<br>
        <div class="modal-footer">
		   <button type="submit" class="btn btn-default" >Issue</button>
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</form>
		 </div>
       </div>

    </div> 
 </div>	
 </div>
 
	
	
	
	</tr>
  </tbody>
<?php }?>
	</table>
			  
			
		
              
			</fieldset>
          
        </div>
      </div>
      
    </div>
      
    </div>
  </div>    
</div>
    
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="dist/js/ripples.min.js"></script>
<script src="dist/js/material.min.js"></script>
<script src="http://fezvrasta.github.io/snackbarjs/dist/snackbar.min.js"></script>


<script src="http://cdnjs.cloudflare.com/ajax/libs/noUiSlider/6.2.0/jquery.nouislider.min.js"></script>
<script>
  $(function () {
    $.material.init();
    $(".shor").noUiSlider({
      start: 40,
      connect: "lower",
      range: {
        min: 0,
        max: 100
      }
    });

    $(".svert").noUiSlider({
      orientation: "vertical",
      start: 40,
      connect: "lower",
      range: {
        min: 0,
        max: 100
      }
    });
  });
</script>
</body>
</html>
