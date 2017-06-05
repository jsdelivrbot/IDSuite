<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>IDS Admin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/all.css') }}">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

    <body>

        <div class="container">
            <div class="row"  >
                <div class="col-md-4 col-md-offset-4">

                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b>Please Sign In</b></h3>
                        </div>
                        <div class="panel-body">
                       <!--  <?php
                            if(isset($_SESSION['error'])){
                                echo "<div class='alert alert-danger' role='alert'><i class=\"fa fa-thumbs-down\"> </i> ". $_SESSION['error'] ."</div>";
                                unset($_SESSION['error']);
                            }

                            if(isset($_SESSION['success'])){
                                echo "<div class='alert alert-info' role='alert'><i class=\"fa fa-thumbs-up\"> </i> ". $_SESSION['success'] ."</div>";
                                unset($_SESSION['success']);
                            }
                            ?> -->
                            <!-- <form role="form" >
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus required="required">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" required="required">
                                    </div>
                                    <input type="hidden" name="target" />
                                    <input type="button" id="login-button" class="btn btn-lg btn-success btn-block" value="Log In" />
                                </fieldset>
                            </form> -->
                            <form role="form" >
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password">
                                    </div>
                                    <input type="hidden" name="target" />
                                    <input type="button" id="login-button" class="btn btn-lg btn-success btn-block" value="Log In" />
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>

    <!-- Bootstrap and Jquery  JavaScript -->
    <script src="js/app.js"></script>

    <script>
                    
        $('#login-button').click(function() {
           $.ajax({
                url: "/login",
                type: "POST",
                dataType: "json",
                data: {
                    data: 'test'
                },
                //Other code
                success: function(msg)
                {
                    console.log('we had success');

                    console.log('message : ');

                    console.log(msg);

                    if(msg.code === '200'){
                        window.location.replace("/index");
                    }

                },
                error: function(msg)
                {
                    console.log('we had an error');

                    console.log('message : ');

                    console.log(msg);
                },
                complete: function(msg)
                {
                    console.log('completed request');
                }
            });
        });
                    
    </script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metis.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/admin_custom_2.js"></script>

