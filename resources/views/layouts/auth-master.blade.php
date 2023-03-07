<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>ClaMEISER-登入</title>

    <!-- Bootstrap core CSS -->
    <script src="../js/jquery-3.5.0.min.js"></script>
    <link href="../js/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../js/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
    <link href="../css/header.css" rel="stylesheet">
    <link href="../css/login_layout.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
</head>
<body class="text-center">
    <main class="form-signin">
      <div class="container">
      @yield('content')
      </div>
    </main>
    

</body>
</html>