<?php include('../dbconnet.php'); 
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
   echo $email .','. $password;
    
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([
            'email' => $email
        ]);
        $user = $stmt->fetch();
        //var_dump($user);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            $_SESSION['login'] = true;
            //session_start();
            //$_SESSION['user'] = $user;
            header('Location: index.php');
        }else {
            header('Location: login.php');
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
                    <h3>Login</h3>
                    <form action="#" method="post" class="p-4 p-md-5 border rounded-3 bg-light" >
                        
                        <div class="form-floating mb-3">    
                            <input type="email" class="form-control" name="email" id="floatInputEmail" placeholder="b1E0S@example.com">
                            <label for="floatInputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="floatInputPassword" placeholder="Password">
                            <label for="floatInputPassword">Password</label>
                        </div>
                        
                        <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
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
