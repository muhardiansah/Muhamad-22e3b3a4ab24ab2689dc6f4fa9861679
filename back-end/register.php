<?php
    
    require_once("koneksi.php");

    if(isset($_POST['register'])){

    // filter data yang diinputkan
    $nama_lengkap = filter_input(INPUT_POST, 'nama_lengkap', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($_POST['password']==$_POST['password2'] ) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    }else 
    {
    echo "<script>alert('Password yang Anda Masukan Tidak Sama');history.go(-1)</script>";
    }

    // menyiapkan query
    $sql = "INSERT INTO tbuser (nama_lengkap, username, email, password) 
            VALUES (:nama_lengkap, :username, :email, :password)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":nama_lengkap" => $nama_lengkap,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved) header("Location: login.php");
    }
  ?>

  <!DOCTYPE html>
  <html>
  <head>
      <title>Halaman Register</title>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
        <div class="col-md-6 mt-5">
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>

        <form action="" method="POST">

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input class="form-control" type="text" name="nama_lengkap" placeholder="Nama kamu" />
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Username" />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Alamat Email" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" />
            </div>

            <div class="form-group">
                <label for="password">Ulangi Password</label>
                <input class="form-control" type="password" name="password2" placeholder="Password" />
            </div>

            <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />

        </form>
            
        </div>

    </div>
    </div>
  </body>
  </html>