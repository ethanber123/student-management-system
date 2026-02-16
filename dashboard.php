<?php
include "config.php";
checkLogin();

$total = $conn->query("SELECT COUNT(*) as t FROM students")
              ->fetch_assoc()['t'];

$courses = $conn->query("SELECT course,COUNT(*) as total FROM students GROUP BY course");
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="sidebar">
<h3 style="text-align:center;">SMS</h3>
<a href="dashboard.php">Dashboard</a>
<a href="students.php">Students</a>
<?php if($_SESSION['role']=="superadmin"){ ?>
<a href="manage_admins.php">Manage Admins</a>
<?php } ?>
<a href="logout.php">Logout</a>
</div>

<div class="content">
<h2>Dashboard</h2>
<h3>Total Students: <?= $total ?></h3>
<canvas id="chart"></canvas>
</div>

<script>
const ctx=document.getElementById('chart');
new Chart(ctx,{
type:'bar',
data:{
labels:[<?php while($row=$courses->fetch_assoc()){ echo "'".$row['course']."',"; } ?>],
datasets:[{
label:'Students',
data:[<?php
$courses2 = $conn->query("SELECT course,COUNT(*) as total FROM students GROUP BY course");
while($row=$courses2->fetch_assoc()){ echo $row['total'].","; } ?>]
}]
}
});
</script>

</body>
</html>
