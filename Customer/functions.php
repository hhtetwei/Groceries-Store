<?php

   function create_accu(){
	   global $connection;
	     global $user_name;
		   global $password;
		     global $email;
			   global $phone;
			     global $address;
				 
				 $hpass=md5($password);
				 $query="select * from user where username='$user_name' and password='$hpass'";
				 $user_query=mysqli_query($connection,$query);
				 $count=mysqli_num_rows($user_query);
				 if($count>0){
					 echo "<script>window.alert('already exists')</script>";
				 }
				 else{
					 $query="insert into user (username,password,email,phone,address)";
					  $query.="values ('$user_name','$hpass','$email','$phone','$address')";
					   $go_query=mysqli_query($connection,$query);
					   $userId = mysqli_insert_id($connection);
					   if(!$go_query){
						   die("QUERY FAILED".mysqli_error($connection));
					   }
					   else
					   {
						   echo "<script>window.alert('Registeration success!')</script>";
						$user_name=$_POST['username'];
						$_SESSION['user']=$user_name;
						$_SESSION['userId'] = $userId;
						header('location:index.php');
					}
				}
   } 
?>