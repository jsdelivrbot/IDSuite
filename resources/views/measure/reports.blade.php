<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/all.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img width="220" src="img/logo_trans.png" /></a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--  
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                    <li class="divider"></li> 
                    -->
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li><a href="index"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                    <li><a href="cdr"><i class="fa fa-bar-chart-o fa-fw"></i> Custom Reporting</a></li>
                    <li><a href="reports"><i class="fa fa-pie-chart fa-fw"></i> Premade Reports</a></li>
                    <li><a href="endpoints"><i class="fa fa-wrench fa-fw"></i> Endpoint Control</a></li>
                    <li><a href="proxies"><i class="fa fa-exchange fa-fw"></i> Proxy Control</a></li>
                    <li><a href="customers"><i class="fa fa-exchange fa-fw"></i> Customer Control</a></li>
                    <li><a href="alerts"><i class="fa fa-exclamation-triangle fa-fw"></i> Alerts</a></li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

<h1 class="page-header"><i class="fa fa-pie-chart"> </i> Premade Reports</h1>

<div class="col-lg-12" style="margin-top:15pt;">
    <div class="panel panel-default">
        <div class="panel-heading"><b>System Utilization and Uptime</b></div>
        <div class="panel-body">
        	<form action="report_cdr_customer.php" method="get">
        		Customer: <select name="customer" required="required">
        			<option value="">Choose One</option>
        		
        		</select> 

        			<span style="margin-left:20px;">
        				Year: <input type="text" class="input" name="year" style="width:50px;" value="" />
        			</span>
        		<span style="margin-left:20px;">
        			<input type="submit" value="Download" />
        		</span>
        	</form>
        </div>
	</div>
</div>

<!-- 
<script>
	$(document).ready(function(){

	});

	function hide_criteria(){
		$('#criteria_panel_body').slideUp('fast');
		$('#criteria_hide_link').slideUp('fast');
		window.setTimeout("$('#criteria_show_link').slideDown('fast')", 200);
	}

	function show_criteria(){
		$('#criteria_panel_body').slideDown('fast');
		$('#criteria_show_link').slideUp('fast');
		window.setTimeout("$('#criteria_hide_link').slideDown('fast')", 200);
	}

	function criteria_changed(){
		$('#download_button').html('Apply Changes First');
		$('#download_button').attr('disabled', 'disabled');
	}

</script> -->