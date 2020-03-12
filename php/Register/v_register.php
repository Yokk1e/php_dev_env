<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="register.css">
</head>
<body>

<form action="Register.php" method="POST">
  <div class="container">
    <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="fname"><b>First Name</b></label>
    <input type="text" placeholder="First Name" name="fname" required>

    <label for="lname"><b>Last Name</b></label>
    <input type="text" placeholder="Last Name" name="lname" required>

    <label for="birthDate"><b>Birth Date</b></label>
    <input type="date" name="birthDate" required>

    <label for="address"><b>Address</b></label>
    <input type="text" placeholder="Enter Address" name="address" required>

    <label for="photo"><b>Photo</b></label>
    <input type="file"  name="photo" >
    
    <button type="submit" class="registerbtn">Register</button>
  </div>
  
</form>

</body>
</html>

