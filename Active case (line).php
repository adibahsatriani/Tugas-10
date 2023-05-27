<?php
include('koneksi.php');
$covid = mysqli_query($koneksi,"select * from data_covid");
while($row = mysqli_fetch_array($covid)){
$countryOther[] = $row['countryOther'];
$query = mysqli_query($koneksi,"select activeCases from data_covid where id ='".$row['id']."'");
$row = $query->fetch_array();
$active_cases[] = $row['activeCases'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Membuat Grafik Menggunakan Chart JS</title>
<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
<div style="width: 800px;height: 800px">
<canvas id="myChart"></canvas>
</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'line',
data: {
labels: <?php echo json_encode($countryOther); ?>,
datasets: [{
label: 'Grafik Covid',
data: <?php echo json_encode($active_cases); 
?>,
backgroundColor: 'rgba(255, 99, 132, 0.2)',
borderColor: 'rgba(255,99,132,1)',
borderWidth: 1
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero:true
}
}]
}
}
});
</script>
</body>
</html>