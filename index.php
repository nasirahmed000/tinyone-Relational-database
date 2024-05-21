<?php
// db connection 
include "lib/connection.php";

// data insert 
if (isset($_POST['c_submit'])) {
  // Step 3: Insert Data
  $name = $_POST['name'];
  $roll = $_POST['roll'];
  $phone = $_POST['phone'];
  $dept = $_POST['dept'];
  $c_address = $_POST['c_address'];
  $p_address = $_POST['p_address'];


  // Insert into students table
  $sql_students = "INSERT INTO students (Name, Roll, Phone) VALUES ('$name', '$roll', '$phone')";
  $conn->query($sql_students);
  
  // Get the last inserted ID
  $s_id = $conn->insert_id;

  // Insert into student_details table
  $sql_student_details = "INSERT INTO student_details (s_id, dept, c_address, p_address) VALUES ('$s_id', '$dept', '$c_address', '$p_address')";
  $conn->query($sql_student_details);
}

// Edit data Read
$name = '';
$roll = '';
$dept = '';
$c_address = '';
$p_address = '';
$phone = '';
$button = '';
if(isset($_GET['type']) && $_GET['type'] == 'edit'){
  $editId = $_GET['id'];
  $editQuery = "SELECT * FROM student_details INNER JOIN students ON students.id = student_details.s_id WHERE students.id = $editId";
  $editResult = $conn->query($editQuery);
  $results = $editResult->fetch_assoc();
  // print_r($results);
  $name = $results['Name'];
  $roll = $results['Roll'];
  $dept = $results['dept'];
  $c_address = $results['c_address'];
  $p_address = $results['p_address'];
  $phone = $results['Phone'];
  $button = 1;
}

// Step 4: Read Data
$sql_read = "SELECT * FROM students"; 
$result1 = $conn->query($sql_read); 
// $data = $result->fetch_assoc();
// echo "<pre>";
// print_r($data);
// $sql_read = "SELECT students.*, student_details.dept, student_details.c_address, student_details.p_address 
//              FROM students 
//              INNER JOIN student_details ON students.id = student_details.s_id"; 

$result = $conn->query($sql_read);


// try 

$sql_read = "SELECT name, roll, phone FROM students";

if (!$result) {
  echo "Error: " . $conn->error;
}



      if (isset($_POST['update_submit'])) {
        $edit_id = $_GET['id'];
        // ... other fields
        $name = $_POST['name'];
        $roll = $_POST['roll'];
        $phone = $_POST['phone'];
        $dept = $_POST['dept'];
        $c_address = $_POST['c_address'];
        $p_address = $_POST['p_address'];
        // Update the students table
        $sql_update_students = "UPDATE students SET Name='$name', Roll='$roll', Phone='$phone' WHERE id='$edit_id'";
        
    
        // Update the student_details table
        if($conn->query($sql_update_students) == TRUE){
          $sql_update_details = "UPDATE student_details SET dept='$dept', c_address='$c_address', p_address='$p_address' WHERE s_id='$edit_id'";
          $conn->query($sql_update_details);
          header("Location: {$_SERVER["PHP_SELF"]}");
        }
    }

// delete 
if(isset($_GET['type']) && $_GET['type'] == 'delete'){
  $editId = $_GET['id'];
 $delete = "DELETE FROM students WHERE id = '$editId'";
 $conn->query($delete);
 header('location: index.php');
}



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- meta -->
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TinyOne</title>
    
    <!-- icons -->

    <script src="https://kit.fontawesome.com/6460d7096d.js" crossorigin="anonymous"></script>

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Poppins&family=Quicksand&family=Roboto&display=swap" rel="stylesheet">

    <!-- css links -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
  </head>

  <body>
    <!-- header start --> 
    <header class="fixed-top">
    
        <div class="container">

          <nav class="navbar navbar-expand-lg c_nav">
            <div class="container-fluid p-0">
              <!-- logo start  -->
              <a class="navbar-brand" href="index.php">
              <img class="image-fluid logo " src="images/logo.png" alt="TinyOne">
              </a>

              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav_cus" aria-controls="nav_cus" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <!-- menu  -->
              <div class="collapse navbar-collapse menu " id="nav_cus">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#feature">Student info</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#contact">Support</a>
                  </li>
                
                  <li class="nav-item">
                    <a class="nav-link" href="#blog">Blog</a>
                  </li>
                
                </ul>

              </div>
            </div>
          </nav>
        </div>
    </header>
<!-- header end -->
    
<!-- slider start  -->
<section class="slider " id="slider">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <!-- carousel start  -->
        <div id="carousel_c" class="carousel slide">
          <!-- indicators  -->
          <div class="carousel-indicators c_ind">
            <button type="button" data-bs-target="#carousel_c" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel_c" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel_c" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <!-- inner  -->
          <div class="carousel-inner">
            <!-- item start -->
            <div class="carousel-item active">
             <div class="row">
              <div class="col-lg-5">
                <div class="s_text">
                  <h1 class="m-0">Believe you can and you're halfway there</h1>
                  <h2>Simple to use for your app, products showcase and your inspiration</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros eget tellus tristique bibendum. Donec rutrum sed sem quis venenatis. Proin viverra risus a eros volutpat tempor. In quis arcu et eros porta lobortis sit </p>
                  <div class="s_icon">

                    <ul class="list-inline m-0">

                      <li class="list-inline-item">
                        <i class="fa-brands fa-apple"></i>
                        <i class="fa-brands fa-android"></i>
                        <i class="fa-brands fa-windows"></i>
                        
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
              <div class="offset-lg-2 col-lg-5 d-md-block d-none">
                <div class="s_img text-center">
                  <img class="img-fluid " src="images/tinyone.png" alt="TinyOne">

                </div>
              </div>
             </div>
            </div>
              <!-- item start -->
              <div class="carousel-item ">
                <div class="row">
                 <div class="col-lg-5">
                   <div class="s_text">
                     <h1 class="m-0">The mind is everything. What you think you become.</h1>
                     <h2>Simple to use for your app, products showcase and your inspiration</h2>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros eget tellus tristique bibendum. Donec rutrum sed sem quis venenatis. Proin viverra risus a eros volutpat tempor. In quis arcu et eros porta lobortis sit </p>
                     <div class="s_icon">
   
                       <ul class="list-inline m-0">
   
                         <li class="list-inline-item">
                           <i class="fa-brands fa-apple"></i>
                           <i class="fa-brands fa-android"></i>
                           <i class="fa-brands fa-windows"></i>
                           
                         </li>
                       </ul>
                     </div>
                
                   </div>    
                 </div>
                 <div class="offset-lg-2 col-lg-5 d-md-block d-none">
                   <div class="s_img text-center">
                     <img class="img-fluid " src="images/slide2.jpg" alt="TinyOne">
   
                   </div>
                 </div>
                </div>
               </div>
                 <!-- item start -->
            <div class="carousel-item ">
              <div class="row">
               <div class="col-lg-5">
                 <div class="s_text">
                   <h1 class="m-0">The best way to predict your future is to create it</h1>
                   <h2>Simple to use for your app, products showcase and your inspiration</h2>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros eget tellus tristique bibendum. Donec rutrum sed sem quis venenatis. Proin viverra risus a eros volutpat tempor. In quis arcu et eros porta lobortis sit </p>
                   <div class="s_icon">
 
                     <ul class="list-inline m-0">
 
                       <li class="list-inline-item">
                         <i class="fa-brands fa-apple"></i>
                         <i class="fa-brands fa-android"></i>
                         <i class="fa-brands fa-windows"></i>
                         
                       </li>
                     </ul>
                   </div>
 
                 </div>
               </div>
               <div class="offset-lg-2 col-lg-5 d-md-block d-none">
                 <div class="s_img text-center">
                   <img class="img-fluid" src="images/slider3.jpg" alt="TinyOne">
                 </div>
               </div>
              </div>
             </div>
           <!-- item end  -->
          </div>
         
        </div>
        <!-- carousel end -->
      </div>
    </div>
  </div>
</section>
<!-- slider end -->


    <!-- Features start  -->
    <section class="feature c_padding" id="feature">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xxl-8 col-lg-9 ">
            <div class="c_title text-center">
              <h1 class="c_h1 ">Student Information</h1>
              <p class="c_p mb-0">Insert the values</p>
            </div>
          </div>
        </div>
        <div class="row">


        <form action="" method="post" >
                                
                                <div class="mb-3">
                                   <label for="c_name" class="form-label"> Name</label>
                                    <input type="text" class="form-control c_name" id="c_name" name="name" value="<?= $name ?>" required>
                                </div>
                                <div class="mb-3">
                                   <label for="c_icon" class="form-label">Roll</label>
                                    <input type="text" class="form-control c_icon" id="c_icon" name="roll" value="<?= $roll ?>" required>
                                </div>
                                <div class="mb-3">
                                   <label for="c_icon" class="form-label">Phone</label>
                                    <input type="text" class="form-control c_icon" id="c_icon" name="phone" value="<?= $phone ?>" required>
                                </div>
                                <div class="mb-3">
                                   <label for="c_icon" class="form-label">Dept</label>
                                    <input type="text" class="form-control c_icon" id="c_icon" name="dept" value="<?= $dept ?>" required>
                                </div>
                                <div class="mb-3">
                                   <label for="c_icon" class="form-label">Current address</label>
                                    <input type="text" class="form-control c_icon" id="c_icon" name="c_address" value="<?= $c_address ?>" required>
                                </div>
                                <div class="mb-3">
                                   <label for="c_icon" class="form-label">Permanent Address</label>
                                    <input type="text" class="form-control c_icon" id="c_icon" name="p_address" value="<?= $p_address ?>" required>
                                </div>

                                <input type="hidden" name="edit_id" value="<?php echo $editData['id']; ?>">
            <!-- Add/Edit form fields here with values from $editData -->
                               
                           <div class="mb-2">
   
                           <button class=" btn btn-dark" type="submit" name="<?= $button == 1 ? 'update_submit' : 'c_submit' ?>" value="1"><?= $button == 1 ? 'UPDATE DATA' : 'SUBMIT DATA' ?> </button>
                           <!-- <button class="btn btn-dark" type="submit" name="update_submit" value="1">Update</button> -->

        </form>
                            
                           </div>
                </form>

                <?php
   if ($result1 !== false && $result1->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Roll</th>
                <th>Phone</th>
            
                <th>Show</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>";

    while ($row = $result1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . (isset($row['Roll']) ? $row['Roll'] : '') . "</td>";
        echo "<td>" . (isset($row['Phone']) ? $row['Phone'] : '') . "</td>";
        echo "<td><a href='show.php?id={$row['id']}'>Show</a></td>";
        echo "<td><a href='?type=edit&id={$row['id']}'>Edit</a></td>";
        echo "<td><a href='?type=delete&id={$row['id']}'>Delete</a></td>";
        

        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "No records found.";
}

    
    ?>  



            </div>

          </div>

        </div>
      </div>

    </section>

    <!-- Features end  -->

<!-- contact start  -->
<section class="contact c_padding" id="contact">
  <div class="container">
    <!-- 1st row  -->
    <div class="row justify-content-center">
      <div class="col-xxl-8 col-lg-9 ">
        <div class="c_title text-center">
          <h1 class="c_h1 yellow">Keep in touch with us</h1>
          <p class="c_p mb-0 ash">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros eget tellus tristique bibendum. Donec rutrum sed sem quis venenatis.</p>
        </div>
      </div>
    </div>
<!-- 2nd row  -->
<div class="row justify-content-center ">
  <div class=" col-xl-7 col-xxl-8 col-lg-9 ">
    <div class="c_form">
      <form action="#">
        <div class="row g-3">
          <div class="col-lg-9">
            <input type="text" class="form-control c_input" placeholder="Enter your email to update " >
          </div>
          <div class="col-lg-3 ">
           <button type="submit " class="btn c_submit "> submit</button>
          </div>
        </div>
      </form>
    </div> 
    
  </div>

  <!-- 3rd row  -->
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="c_icon text-center">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">
            <i class="fa-brands fa-square-facebook"></a></i>
            <a href="#">
            <i class="fa-brands fa-twitter"></a></i>
            <a href="#">
            <i class="fa-brands fa-google-plus"></a></i>
            <a href="#"> 
            <i class="fa-brands fa-pinterest"></a></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

  </div>


</section>

<!-- contact end -->


<!-- footer start  -->
<footer id="blog">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12 ">
        <div class="f_1">
          <address>
            HALOVIETNAM LTD <br>
              66, Dang Van ngu, Dong Da <br>
                Hanoi, Vietnam <br>
                contact@halovietnam.com <br>
                +844 35149182

          </address>
        </div>
      </div>
      <div class="col-lg-2 col-md-2  col-sm-3  ">
        <div class="f_2">
         <p class="mb-0">
          <a href="#">Examples</a>  </p> 
         <p class="mb-0"> <a href="#">Shop</a> </p>
        <p class="mb-0">  <a href="#">License</a></p>
        
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-3 ">
         <div class="f_3">
         <p class="mb-0">
          <a href="#">Contact</a></p> 
          <p class="mb-0"><a href="#">About</a></p>
         <p class="mb-0"> <a href="#">Privacy</a> </p>
        <p class="mb-0"> <a href="#">Terms</a> 
         </p>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-3 ">
 <div class="f_4">
         <p class="mb-0">
          <a href="#"> Download</a></p>
          <p class="mb-0"><a href="#">Support</a></p>
         <p class="mb-0"> <a href="#">Documents</a>
          
         </p>
        </div>
      </div> 
      <div class="col-lg-2 col-md-2 col-sm-3 ">
 <div class="f_5">
         <p class="mb-0">
          <a href="#">Media</a></p>
      <p class="mb-0"> <a href="#">Blogs</a> </p>
        <p class="mb-0">  <a href="#">Forums</a>
         </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- footer end  -->
<section class="footer2">
  <div class="container">
    <div class="row text-center justify-content-center">
      <div class="col-lg-12">
        <p>
          <i class="fa-regular fa-copyright"></i>
          Copyright 2024 <a href="#" class="f_l">Developed by Nasir Ahmed</a>
        </p>
      </div>
    </div>
  </div>
</section>
    <!-- js links -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>



<!-- designed and developed by Md Nasir Ahmed 
id 193002105
department of CSE 
Green Univeristy of Bangladesh -->