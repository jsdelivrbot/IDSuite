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
    <link rel="stylesheet" href="css/jquery.timepicker.css" />

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

<h1 class="page-header">
	<i class="fa fa-wrench"> </i>
	Endpoint Control
	<span class="pull-right"> 
		<button class="btn btn-default"><i class="fa fa-plus"></i> Add Endpoint</button>
	</span>
</h1>
<h2>
<form action="endpoint_control.php" method="get">
    <input type='checkbox' name='disabled' value='1'>
    <input type="submit">

</form>
</h2>
<div class="col-lg-12" style="margin-top:25pt; display:none;" id="add_endpoint_container">
    <div class="panel panel-default"> 
        <div class="panel-heading">
          <b>Add Endpoint</b>
        </div>
        <div class="panel-body">
			<form role="form" action='endpoint_add.php' method='POST'>
				<div class="form-group">
	            	<label>Customer: </label>
	            	<select name="customer" required="required" class="form-control">
	            		<option value="">Choose One</option>
	            		
	            	</select>
	            </div>
				<div class="form-group">
	            	<label>Endpoint Name: </label>
	            	<input type="text" name="name" required="required" class="form-control" />
	            </div>
				<div class="form-group">
	            	<label>Mfg: </label>
	            	<select name="mfg" required="required" class="form-control">
	            		<option value="">Choose One</option>
	            		<option value="LifeSize">LifeSize</option>
                        <option value="Polycom">Polycom</option>
                        <option value="Vidyo">Vidyo</option>
	            	</select>
	            </div>	
				<div class="form-group">
	            	<label>Model: </label>
	            	<select name="model" required="required" class="form-control">
	            		<option value="">Choose One</option>
	            		
	            	</select>
	            </div>
				<div class="form-group">
	            	<label>Username: </label>
	            	<input type="text" name="username" required="required" class="form-control" />
	            </div>
				<div class="form-group">
	            	<label>Password: </label>
	            	<input type="text" name="password" required="required" class="form-control" />
	            </div>
				<div class="form-group">
	            	<label>IPv4 Address: </label>
	            	<input type="text" name="ip_address" required="required" class="form-control" />
	            </div>
				<div class="form-group">
	            	<label>MAC Address: (optional)</label>
	            	<input type="text" name="mac_address" class="form-control" />
	            </div>
                    <div class="form-group">
                        <label>Proxy: (optional)</label>
                        <select name="proxy" class="form-control">
                            <option value="">None</option>
                            
                        </select>
                    </div>
	            <div class="form-group">
	            	<label>Sync Time: </label>
	            	<input type="text" id="sync_time" name="sync_time" placeholder="Must be a 5 minute increment." class="form-control" />
	            </div>
	            <div class="form-group">
	            	<label>Reboot Time: </label>
	            	<input type="text" id="reboot_time" name="reboot_time" placeholder="Must be a 5 minute increment." class="form-control" />
	            </div>

				<input type="submit" class="btn btn-primary" value="Save">
				<button class="btn btn-default" type="button">Cancel</button>
				<input type="hidden" name="action" value="add" />
			</form>
		</div>
    </div>
</div>

<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dt-endpoints">
	<thead>
		<tr>
			<th>Mfg</th>
			<th>Model</th>
			<th>Name</th>
			<th>IP</th>
			<th>Customer</th>
		</tr>
	</thead>
	<tbody>
	
	</tbody>
</table>

<script src="js/jquery.timepicker.min.js"></script>



<!-- <script>
	$(document).ready(function(){

		// Initialize data tables
		$('#dt-endpoints').dataTable( {
	        "aaSorting": [[ 4, "asc" ]],
	        "iDisplayLength": 50,
	    });
	    // "sPaginationType": "full_numbers",
	    // "sDom": '<fpi<t>lT>',

	    $("#sync_time").timepicker({'step':5});
	    $("#reboot_time").timepicker({'step':5});

	});
</script> -->
