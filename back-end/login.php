<?php
	require_once("koneksi.php");

	if(isset($_POST['login'])){

	    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

	    $sql = "SELECT * FROM tbuser WHERE username=:username OR email=:email";
	    $stmt = $db->prepare($sql);
	    
	    // bind parameter ke query
	    $params = array(
	        ":username" => $username,
	        ":email" => $username
	    );

	    $stmt->execute($params);

	    $user = $stmt->fetch(PDO::FETCH_ASSOC);

	    // jika user terdaftar
	    if($user){
	        // verifikasi password
	        if(password_verify($password, $user["password"])){
	            // buat Session
	            session_start();
	            $_SESSION["user"] = $user;
	            // login sukses, alihkan ke halaman timeline
	            header("Location: ../front-end/index.html");
                // header("Location: timeline.php");
	        }
	    }
	}
  ?>

  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">

        <h4>Masuk ke Aplikasi</h4>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>

        <form action="" method="POST">

            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Username atau email" />
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" />
            </div>

            <input type="submit" class="btn btn-success btn-block" name="login" value="Masuk" />

        </form>
            
        </div>

        <div class="col-md-6">
            <!-- isi dengan sesuatu di sini -->
        </div>

    </div>
</div>
    
</body>
</html>