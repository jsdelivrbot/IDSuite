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

<h1 class="page-header"><i class="fa fa-bar-chart-o"> </i> Custom Reporting</h1>

<div class="col-lg-12" style="margin-top:15pt;">
    <div class="panel panel-default">
        <div class="panel-heading">
          <b>Manual Criteria</b>
          <span class="pull-right" id="criteria_hide_link">
          	<a href="" onClick="hide_criteria(); return false;">
          		<i class="fa fa-caret-square-o-up"></i> Hide
          	</a>
          </span>
          <span class="pull-right" id="criteria_show_link" style="display:none;">
          	<a href="" onClick="show_criteria(); return false;">
          		<i class="fa fa-caret-square-o-down"></i> Show
          	</a>
          </span>
        </div>
        <div class="panel-body" id="criteria_panel_body">
			<form method="post" action="cdr_reporting.php" id="criteria">
				<div class="form-group  col-md-6">
			    	<label>Customer: </label>
			    	<select name="customer" class="form-control" onChange="criteria_changed();">
			    		<option value="0">All Customers</option>
			    		
			    	</select>
			    </div>
				<div class="form-group  col-md-6">
			    	<label>Endpoint: </label>
			    	<select name="endpoint" class="form-control" onChange="criteria_changed();">
			    		<option value="0">All Endpoints</option>
			    		
			    	</select>
			    </div>
			    <div class="form-group col-md-6">
			    	<label>Start Date: (inclusive)</label>
			    	<input type="date" name="start" class="form-control" value="<?php if(isset($_SESSION['cdrr_start'])){echo ($_SESSION['cdrr_start']);} ?>" onChange="criteria_changed();" />
			    </div>
			    <div class="form-group col-md-6">
			    	<label>End Date:  (inclusive)</label>
			    	<input type="date" name="end" class="form-control" value="<?php if(isset($_SESSION['cdrr_end'])){echo $_SESSION['cdrr_end'];} ?>" onChange="criteria_changed();" />
			    </div>
			    <div class="form-group  col-md-6">
			    	<label>Zero-Duration Calls: </label>
			    	<select name="zero_duration" class="form-control" onChange="criteria_changed();">
			    		
			    	</select>
			    </div>
			</form>
			<div class="form-group  col-md-12">
				<button class="btn btn-primary" style="margin-left:10pt;">Apply</button>
				<button class="btn btn-default">Reset</button>
				<span class="pull-right" style="margin-right:10pt;">
					<button class="btn btn-primary" id="download_button">
						<i class="fa fa-download"></i> Download CSV
					</button>
				</span>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12" style="margin-top:15pt;">
    <div class="panel panel-default">
        <div class="panel-heading">
          <b>Results</b>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dt-cdr"> 
                <thead>
                    <tr>
                        <th>Conf ID</th>
                        <th>Device</th>
                        <th>Remote Name</th>
                        <th>Remote Number</th>
                        <th>Start Time</th>
                        <th>Duration</th>
                        <th>Dir</th>
                        <th>Protocol</th>
                    </tr>
                </thead>
                <tbody>
                 
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- 
<script>
	$(document).ready(function(){

	    // Initialize data tables
	    $('#dt-cdr').dataTable( {
	        "aaSorting": [], // no sort
	        "sDom": '<<"pull-left"p>ftl<"pull-right"i>>',
	        "iDisplayLength": 10,
	    });
	    
	    // "sPaginationType": "full_numbers",
	    // 

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

</script>
 -->