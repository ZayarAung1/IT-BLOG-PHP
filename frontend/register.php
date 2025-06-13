<?php 
include('../dbconnet.php'); 
session_start();
$errors = [];

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['userName']);
    $email = htmlspecialchars($_POST['userEmail']);
    $password = htmlspecialchars($_POST['userPassword']);
    $comfirmPassword = htmlspecialchars($_POST['userConfirmPassword']);
    
   //echo $name .','. $email .','. $password .','. $comfirmPassword;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([
            'email' => $email
        ]);
        $user = $stmt->fetch();
        //var_dump($user);
        
        if ($password != $comfirmPassword) {//password not match
            $errors['password'] = 'Password not match';
           // header('Location: register.php');
            // exit();
        }else if (!$user) {
        
           //email not exists
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            //echo $hashedpassword;
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashedpassword
            ]);
            header('Location: login.php');

            
            
        }else {
            $errors['email'] = 'Email already exists';
            //header('Location: register.php');
            //var_dump($errors);
            //exit();
            
        }
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Home - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
       <?php include('navbar.php'); ?>
        <!-- Page header with logo and tagline-->

        <!-- Page content-->
        <div class="container py-5">
            <div class="row justify-content-center">
                <!-- Blog entries-->
                <div class="col-lg-6">
                    <h3>Register</h3>
                    <form action="#" method="post" class="p-4 p-md-5 border rounded-3 bg-light" >
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="userName" id="floatInputName" placeholder="shewu">
                            <label for="floatInputName">Name</label>
                        </div>
                        <div class="form-floating mb-3">    
                            <input type="email" class="form-control" name="userEmail" id="floatInputEmail" placeholder="b1E0S@example.com">
                            <label for="floatInputEmail">Email address</label>
                            <div class="text-danger">
                                <?php if (isset($errors['email'])) {echo $errors['email'];}; ?>
                            </div>
                           
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="userPassword" id="floatInputPassword" placeholder="Password">
                            <label for="floatInputPassword">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="userConfirmPassword" id="floatInputConfirmPassword" placeholder="Password">
                            <label for="floatInputConfirmPassword">Confirm Password</label>
                            <div class="text-danger">
                                <?php if (isset($errors['password'])) {echo $errors['password'];}; ?>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        
                    
                    </form>
                </div>
        <!-- Footer-->
        <?php include('footer.php'); ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>