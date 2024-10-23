<?php

$search_value = $_POST['search'];
include("student_db.php");
      $sql = "select * from `student_data` where s_name like '%{$search_value}%'";
      $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
      if(mysqli_num_rows($result)>0){
        echo '<div class="table-responsive ">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr. No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Class</th>
                    <th scope="col">Section</th>
                    <th scope="col">Student Pass</th>
                    <th scope="col">Father Name</th>
                    <th scope="col">Mother Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date of Register</th>
                    <th scope="col">Image</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        $s_pass = $row['s_pass'];
        $s_name = $row['s_name'];
        $s_img = $row['s_img'];
        $s_id = $row['s_id'];
        $class = $row['class'];
        $section = $row['section'];
        $father = $row['father'];
        $mother = $row['mother'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        $date = $row['dateofRagister'];
        
        echo '<tr>
        <td>' . $s_id . '</td>
        <td>' . $s_name . '</td>
        <td>' . $class . '</td>
        <td>' . $section . '</td>
        <td>' . $s_pass . '</td>
        <td>' . $father . '</td>
        <td>' . $mother . '</td>
        <td>' . $mobile . '</td>
        <td>' . $email . '</td>
        <td>' . $date . '</td>
        <td><img src="S_Profile_Img/' . $s_img . '" alt="Student Image" style="width: 50px; height: 50px;"></td>
        <td>
            <button class="delete-btn btn btn-danger" data-id="' . $row['s_id'] . '">Delete</button>
        </td>
        <td>
            <button class="update-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="' . $row['s_id'] . '">Update</button>
        </td>
    </tr>';
    
    }
    echo '</tbody></table></div>';
   } else {
    echo '<div class="alert alert-primary" role="alert">
        <strong>Empty!</strong> There is no such student in school.
    </div>';
   }

?>