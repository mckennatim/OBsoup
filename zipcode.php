<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>zipcode</title>
<!--	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />	
-->	
	<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />	
<!--		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico">
		
<!--		<title>Using DataTable with Editable plugin - Getting the data source via ajax request</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
			@import "media/css/demo_validation.css";
			@import "media/css/themes/base/jquery-ui.css";
			@import "media/css/themes/smoothness/jquery-ui-1.7.2.custom.css";
		</style>*/
-->
		<script src="jq/jquery-1.7.min.js" type="text/javascript"></script>
<!--      <script src="media/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.jeditable.js" type="text/javascript"></script>
        <script src="media/js/jquery-ui.js" type="text/javascript"></script>
        <script src="media/js/jquery.validate.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.editable.js" type="text/javascript"></script>
-->
		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
/*				$('#example').dataTable({
                    "bProcessing": true,
					"sAjaxSource": "getTeamforProj.php",
					aoColumns: [ { "bVisible": false}, {"bVisible": false}, null, null]
						 })
						 .makeEditable({
							sUpdateURL: "updateTeamRec.php",
							sAddURL: "addTeamRec.php",
							sAddHttpMethod: "GET", //Used only on google.code live example because google.code server do not support POST request
							sDeleteURL: "deleteTeamRec.php",
							sDeleteHttpMethod: "GET", //Used only on google.code live example because google.code server do not support POST request
				});*/
				$("#zipcode").blur(function() 
				{ 				
					$.get(  
						"tm/zcompl.php",  //url
						{zip: $("#zipcode").val()},  //data
						function(data) {  //success
							//alert(data.city);
							var loc = data.city + ', ' + data.state;
							$("#location").val(loc);
						},
						"json"	//dataType
					); 
				}); 
			});
/*			$(function() {
				$( "#projdate" ).datepicker();
			});	*/
			
		</script>
</head>
<body>
	<div class="container">
		<header>
			<nav class="round">
			</nav>
			<section class="round">
				<img src="images/soupbanner.jpg" alt="soup banner" />
			</section>
		</header>
		<section class="round">

		</section>
	</div>

<div class="container">
<section class="round">
			<form id="form1" name="Update" method="get" >
				<label>zipcode: </label>
				<input name="zipcode" id="zipcode" size="9"/>	<input name="dipcode" id="dipcode" size="9"/>
				<label>location: (neighborhood)</label><br/>
				<input name="location" id="location" value="" />
				<br />
				<input class="notify_button round" type="submit" value="Create a New Soup Project" /><br />
			</form>
</section>
</div>
</body>
</html>
