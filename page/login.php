<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login-Desa Temusai</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background-color:#5689f4">

    <div class="container">
        <div class="row">
            
                <center><table width="700">
                    <tr>
                        <td height="60" width="100"></td>
                        <td width="600"></td>
                    </tr>                    
                    <tr>
                        <td height="150"style="padding-left: 10px"><img src="../assets/img/logo.png" height="90%"></td>
                        <td style="padding-left: 20px"><h2 style="color:white;line-height: 1.55em;"><strong>SISTEM INFORMASI<br>PENGELOLAAN AGENDA KEGIATAN</strong></h2></td>
                    </tr>
                </table></center>
            
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel" style="margin-top: 15%">
                    <div class="panel-body">
                            <form role="form" action="../data/do_login.php" method="post">
                                <center><h4 style="color:#2d29f4;">Silahkan Log In</h4></center><br>
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Username" name="username" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button class="btn btn-lg btn-primary btn-block" type ="submit">Log In</button>
                                </fieldset>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/sb-admin-2.js"></script>

</body>

</html>
