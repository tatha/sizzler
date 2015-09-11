<div>
<h4>List of Employee</h4>
<a href="employee/add">
<input type="button" name="add" value="Add Employee">
</a>

<?php
if(isset($_SESSION['employee']['list'])) {
	if($_SESSION['employee']['list']['status']=='success') {
		$color = "#0F0";
	} else {
		$color = "#F00";
	}
?>
<div style="color:<?php echo $color; ?>">
<?php echo $_SESSION['employee']['list']['msg']; ?>
</div>
<?php
	unset($_SESSION['employee']['list']);
}
?>

<table width="50%" border="1">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Gender</th>
    <th>Action</th>
  </tr>
<?php
if(count($employees)>0) {
	foreach($employees as $employee) {
?>
  <tr>
    <td><?php echo $employee['e_id']; ?></td>
    <td><?php echo $employee['e_name']; ?></td>
    <td><?php echo $employee['e_gender']; ?></td>
    <td>
    <a href="employee/edit/<?php echo $employee['e_id']; ?>">
    <input type="button" name="edit" value="Edit">
    </a>
    <a href="employee/delete/<?php echo $employee['e_id']; ?>">
    <input type="button" name="delete" value="Delete">
    </a>
    </td>
  </tr>
<?php
	}
} else {
?>
  <tr>
    <td colspan="4" align="center">No record found</td>
  </tr>
<?php
}
?>
</table>

</div>