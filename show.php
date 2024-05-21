<?php
    require "lib/connection.php";
    if(isset($_GET['id'])){
        $editId = $_GET['id'];
        $editQuerys = "SELECT * FROM student_details INNER JOIN students ON students.id = student_details.s_id WHERE students.id = $editId";
        $datas = $conn->query($editQuerys);
        $result2 = $datas->fetch_assoc();
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tinyone</title>
<style>
    table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    padding: 8px; 
    border: 1px solid #ddd; 
  }
  th {
    text-align: left; 
    background-color: #f2f2f2; 
  }
  tr:hover {
    background-color: #f5f5f5; 
  }
</style>

</style>

    
</head>


<body>

<table>
  <tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Roll</th>
    <th>Department</th>
    <th>Current Address</th>
    <th>Permanent Address</th>
  </tr>
  <tr>
    <td><?= $result2['Name'] ?></td>
    <td><?= $result2['Phone'] ?></td>
    <td><?= $result2['Roll'] ?></td>
    <td><?= $result2['dept'] ?></td>
    <td><?= $result2['c_address'] ?></td>
    <td><?= $result2['p_address'] ?></td>
  </tr>
</table>



    
</body>
</html>