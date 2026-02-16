$photo = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
move_uploaded_file($tmp,"assets/uploads/".$photo);

$stmt=$conn->prepare("INSERT INTO students(fullname,email,course,phone,photo) VALUES(?,?,?,?,?)");
$stmt->bind_param("sssss",$fullname,$email,$course,$phone,$photo);

<form method="POST" enctype="multipart/form-data">
<input type="file" name="photo" required>
