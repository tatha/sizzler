<h4>Add Employee</h4>
<form action="employee/save" method="post">
<table width="100%">
  <tr>
    <td>ID</td>
    <td>:</td>
    <td>
    <?php if(isset($employee['e_id'])) { ?>
    <input type="text" name="employee[e_id]" value="<?php echo $employee['e_id']; ?>" readonly>
    <?php } else { ?>
    Not Applicable
    <?php } ?>
    </td>
  </tr>
  <tr>
    <td>Name</td>
    <td>:</td>
    <td>
    <input type="text" name="employee[e_name]" value="<?php echo $employee['e_name']; ?>">
    </td>
  </tr>
  <tr>
    <td>Gender</td>
    <td>:</td>
    <td>
    <select name="employee[e_gender]">
    	<option value="">Select</option>
    	<option value="M" <?php if($employee['e_gender']=='M') { ?>selected<?php } ?>>Male</option>
    	<option value="F" <?php if($employee['e_gender']=='F') { ?>selected<?php } ?>>Female</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <input type="submit" value="Save">
    </td>
  </tr>
</table>
</form>