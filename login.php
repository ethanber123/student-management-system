<?php
include "config.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){

  $stmt = $conn->prepare("SELECT * FROM admins WHERE username=?");
  $stmt->bind_param("s",$_POST['username']);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows==1){
    $admin = $result->fetch_assoc();

    if(password_verify($_POST['password'],$admin['password'])){
      $_SESSION['admin']=$admin['username'];
      $_SESSION['role']=$admin['role'];
      header("Location: dashboard.php");
      exit();
    }
  }
  $error="invalid login";
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/style.css">
</head>
<body class="center">
  <div class="card">
    <h2>SMS Ultimate Login</h2>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button>Login</button>
</form>
</div>
</body>
</html>
