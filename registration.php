<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="registration_style.css">
</head>
<body>
    <div class="container">
        <?php
         //print_r($_POST);
         if(isset($_POST["submit"])){
            $name=$_POST["name"];
            $email=$_POST["email"];
            $phone=$_POST["phone"];
            $dob=$_POST["dob"];
            $gender=$_POST["gender"];
            $course=$_POST["course"];
            //$name=$_POST["name"];
            $errors = array();

            //
            //if (empty($name) OR empty( $email) OR empty($phone) OR empty($dob) OR empty($gender) OR empty( $course)){}

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors,"email is not valid");
            }

            if (strlen($phone)!=10) {
                array_push($errors,"Not a valid mobile number");
            }

            if (count($errors)>0) {
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'> $error</div>";
                }
            }
            else{
                require_once "database.php";
                $sql = "INSERT INTO students (stud_name, email, phone,dob,gender, course) VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if ($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"ssssss",$name,$email,$phone,$dob,$gender,$course);
                    mysqli_stmt_execute($stmt);
                    echo"<div class='alert alert-success'>You are Successfuly registered</div>";
                }
                else{
                    die("Something Wen Wrong when registering");
                }
            }
         }
        ?>
        <form action="registration.php" method="post" class="registration-form">
            <div>
                <h2>Registration Form</h2>
            </div>
            <div class="form_div">
                <label for="name">Name:</label>
                <input type="name" name="name" id="name" required>
            </div><div class="form_div">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form_div">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div>
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <div>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
            </select>
            </div>

            <div>
            <label for="course">Select Course:</label>
            <select id="course" name="course" required>
            <option value="computer-science">Computer Science</option>
            <option value="engineering">Engineering</option>
            <option value="business">Business</option>
            </select>
            </div>

            <div>
                <!--<button type="submit">Submit</button> -->
                <input type="submit" class="btn btn-primary" value = "Register" name= "submit">
            </div>


        </form>
    </div>
    
</body>
</html>