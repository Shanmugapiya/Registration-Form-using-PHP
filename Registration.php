<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Shanmugapriya_Task3</title>
 <script type="text/javascript">
        <!--
// for show/hide password details
        function ShowHide() {
            if (document.getElementById('radio1').checked) {
                document.getElementById('txtPassword').type = 'text';
            } else {
                document.getElementById('txtPassword').type = 'password';
            }
        }

        //-->
        </script>
</head>

<body>
<fieldset>
     <legend>Registration Form</legend>
	    <form action="" method="post" enctype="multipart/form-data">
	       <table style="margin:10px 10px 10px 10px;">
		   <tr>
	          <td>Name</td>
			  <td><input id="txtName" type="text" name="txtName" maxlength="30"/></td>	   
		   </tr>
		   <tr>
	          <td>Roll_No</td>
			  <td><input id="numRollno" type="number" name="numRollno" maxlength="3"/></td>	   
		   </tr>
		      <tr>
	          <td>Department</td>
			  <td><input id="txtDepartment" type="text" name="txtDepartment"/></td>	   
		   </tr>
		   <tr>
	          <td>Year_of_study</td>
			  <td><input id="numYearofstudy" type="number" name="numYearofstudy" min="1" max="4" /></td>	   
		   </tr>
		   <tr>
	          <td>Email</td>
			  <td><input id="txtEmail" type="email" name="txtEmail"/></td>	   
		   </tr>
		   <tr>
	          <td>Password</td>
			  <td><input id="txtPassword" type="password" name="txtPassword" maxlength="10"/></td>
			  <br />
			  <td><label><input type="radio" id="radio1" name="radio1" value="on" onchange="ShowHide();">Show</label></td>
              <td><label><input type="radio" id="radio2" name="radio1" value="off" onchange="ShowHide();" checked>Hide</label></td>	   
		   </tr>
		    <tr>
	          <td>Profile Picture</td>
			  <td><input id="file_img" type="file" name="file_img" maxlength="10"/></td>
			     
		   </tr>
		   <tr>
	          <td></td>
			  <td><input id="btnSubmit" type="submit" name="btnSubmit"  value="Submit"/></td>
			   
		   </tr>
		   </table>
		</form>
</fieldset>
<?php
    
    if(isset($_REQUEST["btnSubmit"]))
	 {
	    $con = mysqli_connect("localhost","root","") or die("error in database connection" . mysql_error());
        mysqli_select_db($con ,"regdb") or die("error to select the db" . mysql_error());
	    $name=$_REQUEST["txtName"];
	    $rollno=$_REQUEST["numRollno"];
	    $department=$_REQUEST["txtDepartment"];
		$yearofstudy=$_REQUEST["numYearofstudy"];
		$email=$_REQUEST["txtEmail"];
		$password=$_REQUEST["txtPassword"];
		// for encrypting password!!
		$encp=sha1($password); 
		$filetmp = $_FILES["file_img"]["tmp_name"];
		$filename = "$name"; // to upload image in the user name
		$filetype = $_FILES["file_img"]["type"];
		$filepath = "photo/".$filename;
		// check for image size
		if ($_FILES["file_img"]["size"] > 512000) {
              echo "Sorry, your file is Greater than 500KB.";
              }
        else{
		move_uploaded_file($filetmp,$filepath);
		}
		// for generating randum user id (unique 10 digits)
        $randnum = rand(1111111111,9999999999);

	    $query="Insert into reg(Name,Rollno,Department,Yearofstudy,Email,Password,userid) values('$name','$rollno','$department','$yearofstudy','$email','$encp','$randnum')";
	  $result=mysqli_query($con,$query) or die("error in inserting data in db" . mysql_error());
	  		
		
		
		if($result>0)
		{
		 echo nl2br("\n Registered succesfully!!! \n your user id is :  $randnum ");
		}
			
	
}	
	 


?>

</body>
</html>
