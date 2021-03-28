<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../tremenheere/public/index.html');
	exit;
}

include('../inc/header.php');
include('../inc/container.php');
include('../inc/db_connect.php');
    // initialize errors variable
	$errors = "";
	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$deadline = $_POST['deadline'];
			$task = $_POST['task'];
			$priority = $_POST['priority'];
			$staffid = $_POST['staff'];
			$weekly = $_POST['weekly'];
			if($weekly == 0){
			$sql = "INSERT INTO todo (deadline, task, priority, staffid) VALUES ('$deadline','$task','$priority',$staffid)";
			mysqli_query($conn, $sql) or die(mysqli_error($conn));
		}elseif($weekly == 1){
				$day = $_POST['day'];
			$sql = "INSERT INTO todo (deadline, task, priority, staffid, weekly, day) VALUES ('$deadline','$task','$priority',$staffid,$weekly,'$day')";
			mysqli_query($conn, $sql) or die(mysqli_error($conn));
		}elseif ($weekly == 2) {
			$deadline = $_POST['dailytime'];
			$time = $_POST['deadline'];
			$sql = "INSERT INTO todo (deadline, task, priority, staffid, daily, time) VALUES ('$deadline','$task','$priority',$staffid,1, '$time')";
			mysqli_query($conn, $sql) or die(mysqli_error($conn));
		}
		}
	}
  if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($conn, "DELETE FROM todo WHERE id=".$id);

}
if (isset($_GET['complete_task'])) {
$id = $_GET['complete_task'];
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s', time());
mysqli_query($conn, "UPDATE todo SET completed=1, timecompleted='$date' WHERE id=".$id);

}
if (isset($_GET['incomplete_task'])) {
$id = $_GET['incomplete_task'];

mysqli_query($conn, "UPDATE todo SET completed=0, timecompleted=NULL WHERE id=".$id);

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Task List</title>
	<script type="text/javascript" src="scripts/tasks.js"></script>
  <link rel="stylesheet" type="text/css" href="css/tasks.css">
</head>
<body>

<?php if( $_SESSION['admin'] == 1){
	?>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">Task List</h2>
	</div>
	<form method="post" action="tasks.php" class="input_form">
		<label for="weekly">Recurring Task?</label>
		<select class='weekly' name="weekly"required>
			<option value="0">One time</option>
			<option value="1">Weekly recurring</option>
			<option value="2">Daily recurring</option>
		</select><br>
		<label for="task">Task</label>
		<input type="text" name="task" class="task_input"required><br>
		<label class='setdeadline' for="deadline">Set Deadline</label>
		<input class='setdeadline' type="datetime-local" name="deadline"required><br>
		<label for="priority">Priority</label>
		<select class="priority" name="priority"required>
			<option style='background-color: green;' value="Low">Low</option>
			<option style='background-color: orange;' value="Medium">Medium</option>
			<option style='background-color: red;'value="High">High</option>
		</select><br>
		<label for="staff"required>Set Staff</label>
		<select class="staff" name="staff">
				<option value="10">All</option>
				<option value="1">Daniel Michael</option>
				<option value="2">Mark Lea</option>
				<option value="3">Lisa Blake</option>
				<option value="4">Louise Twigger</option>
				<option value="5">Jack Michael</option>
				<option value="6">Angkhan Phumiwet</option>
				<option value="7">Jack Drewitt</option>
				<option value="8">Frankie Michael</option>
		</select>

		<br><button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>

<div class="heading">
	<h2 style="font-style: 'Hervetica';">All Tasks</h2>
</div>
  <table>
	<thead>

		<tr>
			<th hidden>ID</th>
			<th class='date'>Start Date</th>
			<th class='deadline'>Deadline</th>
			<th class='task' style="width: 40%;">Task</th>
			<th class='priority'>Priority</th>
			<th class='setfor'>Set for</th>
			<th class='status'>Status</th>
			<th class='action' style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($conn, "SELECT * FROM todo");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td hidden> <?php echo $i; ?> </td>

				<td class="date"><?php echo $row['date'];  ?></td>
				<td class="deadline"><?php echo $row['deadline'];  ?></td>
				<td class="task"><b> <?php echo $row['task']; ?> </b></td>
				<td class='priority'><?php echo $row['priority']; ?></td>
				<?php
				$idname = $row['staffid'];
				$sql = "SELECT * FROM accounts WHERE id = $idname";
				$query = mysqli_query($conn, $sql);
				while($result = mysqli_fetch_assoc($query)){
				?>
				<td class='setfor'><?php echo $result['username']; } ?></td>
				<td class='status'><?php if ($row['completed'] == 1){ echo $row['completed'] . "d - " . $row['timecompleted'];}else{ echo $row['completed'];} ?></td>
				<td class='action'>
				<div class="delete">
					<a href="tasks.php?del_task=<?php echo $row['id'] ?>"><i class="fas fa-trash-alt"></i></a>
				</div>
					<div class="complete">
						<a href="tasks.php?incomplete_task=<?php echo $row['id'] ?>"><i class="fas fa-window-close"></i></a>
						<a href="tasks.php?complete_task=<?php echo $row['id'] ?>"><i class="fas fa-check"></i></a>
					</div>
				</td>
			</tr>
		<?php $i++; } ?>
	</tbody>
</table>
<?php } ?>


<div class="heading">
	<h2 style="font-style: 'Hervetica';">My Recurring Tasks</h2>
</div>
<table>
<thead>
	<tr>
		<th hidden>ID</th>
		<th class='date'>Start Date</th>
		<th class='deadline'>Deadline</th>
		<th class='task' style="width: 40%;">Task</th>
		<th class='priority'>Priority</th>
		<th class='setfor'>Set for</th>
		<th class='status'>Status</th>
		<th class='action' style="width: 60px;">Action</th>
	</tr>
</thead>

<tbody>
	<?php
	// select all tasks if page is visited or refreshed
	$myid = $_SESSION['id'];
	$tasks = mysqli_query($conn, "SELECT * FROM todo WHERE (completed = 0 AND staffid = $myid AND weekly = 1) OR (completed = 0 AND staffid = 10 AND weekly = 1) OR (completed = 0 AND staffid = $myid AND daily = 1) OR (completed = 0 AND staffid = 10 AND daily = 1)");
	$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
		<tr>
			<td hidden> <?php echo $i; ?> </td>

			<td class="date"><?php echo $row['date']; ?></td>
			<td class="deadline" style="color:green;"><?php if ($row['weekly'] == 1){ echo 'Weekly - Every ' . $row['day'];}else{ echo 'Daily - By '. $row['time'];} ?></td>
			<td class="task"><b> <?php echo $row['task']; ?> </b></td>
			<td class='priority'><?php echo $row['priority']; ?></td>
			<?php
			$idname = $row['staffid'];
			$sql = "SELECT * FROM accounts WHERE id = $idname";
			$query = mysqli_query($conn, $sql);
			while($result = mysqli_fetch_assoc($query)){
			?>
			<td class='setfor'><?php echo $result['username']; } ?></td>
			<td class='status'><?php echo $row['completed']; ?></td>
			<td class="action complete">
				<a href="tasks.php?complete_task=<?php echo $row['id'] ?>"><i class="fas fa-check"></i></a>
			</td>
		</tr>
		<tr style='height:200px;'>
			<td>
				<h5>Date Set</h5>
				<?php echo $row['date']; ?>
				<h5 style="margin-top:10px;">Deadline</h5>
				<?php if ($row['weekly'] == 1){ echo 'Weekly - Every ' . $row['day'];}else{ echo 'Daily - By '. $row['time'];} ?>
			</td>
			<td>
				<h5>Task Details</h5>
				<?php echo $row['task']; ?>
				<h5 style="margin-top:10px;">Priority</h5>
				<?php echo $row['priority']; ?>
			</td>
			<td>
				<h5>Set for</h5>
				<?php
				$idname = $row['staffid'];
				$sql = "SELECT * FROM accounts WHERE id = $idname";
				$query = mysqli_query($conn, $sql);
				while($result = mysqli_fetch_assoc($query)){
				?>
				<?php echo $result['username']; } ?>
				<h5>Status</h5>
				<span class='status'><?php echo $row['completed']; ?></span>
			</td>
			<td></td>
		</tr>
	<?php $i++; } ?>
</tbody>
</table>

<div class="heading">
	<h2 style="font-style: 'Hervetica';">My Daily Tasks</h2>
</div>
<table>
<thead>
	<tr>
		<th hidden>ID</th>
		<th class='date'>Start Date</th>
		<th class='deadline'>Deadline</th>
		<th class='task' style="width: 40%;">Task</th>
		<th class='priority'>Priority</th>
		<th class='setfor'>Set for</th>
		<th class='status'>Status</th>
		<th class='action' style="width: 60px;">Action</th>
	</tr>
</thead>

<tbody>
	<?php
	// select all tasks if page is visited or refreshed
	$myid = $_SESSION['id'];
	$tasks = mysqli_query($conn, "SELECT * FROM todo WHERE (completed = 0 AND staffid = $myid AND weekly = 0) OR (completed = 0 AND staffid = 10 AND weekly = 0)");

	$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
		<tr>
			<td hidden> <?php echo $i; ?> </td>

			<td class="date"><?php echo $row['date'];  ?></td>
			<td class="deadline"><?php echo $row['deadline'];  ?></td>
			<td class="task"><b> <?php echo $row['task']; ?> </b></td>
			<td class='priority'><?php echo $row['priority']; ?></td>
			<?php
			$idname = $row['staffid'];
			$sql = "SELECT * FROM accounts WHERE id = $idname";
			$query = mysqli_query($conn, $sql);
			while($result = mysqli_fetch_assoc($query)){
			?>
			<td class='setfor'><?php echo $result['username']; } ?></td>
			<td class='status'><?php echo $row['completed']; ?></td>
			<td class="action complete">
				<a href="tasks.php?complete_task=<?php echo $row['id'] ?>"><i class="fas fa-check"></i></a>
			</td>
		</tr>

	<?php $i++; } ?>
</tbody>
</table>



  <?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
<?php } ?>
</body>
</html>
