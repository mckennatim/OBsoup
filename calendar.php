<?
session_start();
//require_once('auth.php');
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');
ob_start(); //gotta have this
fb('in caledar');

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
} 

$time_start = getmicrotime();

IF(!isset($_GET['year'])){
    $_GET['year'] = date("Y");
}
IF(!isset($_GET['month'])){
    $_GET['month'] = date("n")+1;
}

$month = addslashes($_GET['month'] - 1);
$year = addslashes($_GET['year']);
$db_table = "calendar_events";

$sql= "SELECT projdate, title, pid, organizer
FROM projects
WHERE MONTH(projdate)='".$month."' AND YEAR(projdate) = '".$year."'";
$query = "SELECT event_id,event_title,event_day,event_time FROM $db_table WHERE event_month='$month' AND event_year='$year' ORDER BY event_time";
fb($sql);
$query_result = mysql_query ($sql);
while ($info = mysql_fetch_array($query_result))
{
	$day = intval(date("d",strtotime($info['projdate'])));
    $event_id = $info['pid'];
	$pid = $info['pid'];
    $events[$day][] = $pid;
    $event_info[$event_id]['0'] = substr($info['title'], 0, 11);
    $event_info[$event_id]['1'] = substr($info['organizer'], 0 ,3);
	
/*    $day = $info['eve nt_day'];
    $event_id = $info['event_id'];
    $events[$day][] = $info['event_id'];
    $event_info[$event_id]['0'] = substr($info['event_title'], 0, 14);;*/
    //$event_info[$event_id]['1'] = $info['event_time'];
}
fb($event_info);
fb($events);

$todays_date = date("j");
$todays_month = date("n");

$days_in_month = date ("t", mktime(0,0,0,$_GET['month'],0,$_GET['year']));
$first_day_of_month = date ("w", mktime(0,0,0,$_GET['month']-1,1,$_GET['year']));
$first_day_of_month = $first_day_of_month + 1;
$count_boxes = 0;
$days_so_far = 0;

IF($_GET['month'] == 13){
    $next_month = 2;
    $next_year = $_GET['year'] + 1;
} ELSE {
    $next_month = $_GET['month'] + 1;
    $next_year = $_GET['year'];
}

IF($_GET['month'] == 2){
    $prev_month = 13;
    $prev_year = $_GET['year'] - 1;
} ELSE {
    $prev_month = $_GET['month'] - 1;
    $prev_year = $_GET['year'];
}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />		
	<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/cal.css" rel="stylesheet" />	
</head>	
<body> 
	<div class="container">
		<header>
			<nav class="round">
			</nav>
			<section class="round">
				<a href="soup.php"><img src="images/soupbanner.jpg" class="stretch" alt="soup banner" /></a>
				<?
					if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
						echo '<ul class="err">';
						foreach($_SESSION['ERRMSG_ARR'] as $msg) {
							echo '<li>',$msg,'</li>'; 
						}
						echo '</ul>';
						unset($_SESSION['ERRMSG_ARR']);
					}
				?>				
			</section>
		</header>
		<section class="round">

<div align="center"><span class="currentdate"><? echo date ("F Y", mktime(0,0,0,$_GET['month']-1,1,$_GET['year'])); ?></span><br>
  <br>
</div>
<div align="center"><br>
  <table width="700" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td><div align="right"><a href="<? echo "calendar.php?month=$prev_month&amp;year=$prev_year"; ?>">&lt;&lt;</a></div></td>
      <td width="200"><div align="center">
            
          <select name="month" id="month" onChange="MM_jumpMenu('parent',this,0)">
            <?
			for ($i = 1; $i <= 12; $i++) {
				$link = $i+1;
				IF($_GET['month'] == $link){
					$selected = "selected";
				} ELSE {
					$selected = "";
				}
				echo "<option value=\"calendar.php?month=$link&amp;year=$_GET[year]\" $selected>" . date ("F", mktime(0,0,0,$i,1,$_GET['year'])) . "</option>\n";
			}
			?>
          </select>
          <select name="year" id="year" onChange="MM_jumpMenu('parent',this,0)">
		  <?
		  for ($i = 2011; $i <= 2015; $i++) {
		  	IF($i == $_GET['year']){
				$selected = "selected";
			} ELSE {
				$selected = "";
			}
		  	echo "<option value=\"calendar.php?month=$_GET[month]&amp;year=$i\" $selected>$i</option>\n";
		  }
		  ?>
          </select>
        </div></td>
      <td><div align="left"><a href="<? echo "calendar.php?month=$next_month&amp;year=$next_year"; ?>">&gt;&gt;</a></div></td>
    </tr>
  </table>
  <br>
</div>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr class="topdays"> 
          <td><div align="center">Sunday</div></td>
          <td><div align="center">Monday</div></td>
          <td><div align="center">Tuesday</div></td>
          <td><div align="center">Wednesday</div></td>
          <td><div align="center">Thursday</div></td>
          <td><div align="center">Friday</div></td>
          <td><div align="center">Saturday</div></td>
        </tr>
		<tr valign="top" bgcolor="#FFFFFF"> 
		<?
		for ($i = 1; $i <= $first_day_of_month-1; $i++) {
			$days_so_far = $days_so_far + 1;
			$count_boxes = $count_boxes + 1;
			echo "<td width=\"100\" height=\"100\" class=\"beforedayboxes\"></td>\n";
		}
		for ($i = 1; $i <= $days_in_month; $i++) {
   			$days_so_far = $days_so_far + 1;
    			$count_boxes = $count_boxes + 1;
			IF($_GET['month'] == $todays_month+1){
				IF($i == $todays_date){
					$class = "highlighteddayboxes";
				} ELSE {
					$class = "dayboxes";
				}
			} ELSE {
				IF($i == 1){
					$class = "highlighteddayboxes";
				} ELSE {
					$class = "dayboxes";
				}
			}
			echo "<td width=\"100\" height=\"100\" class=\"$class\">\n";
			$link_month = $_GET['month'] - 1;
			echo "<div align=\"right\"><span class=\"toprightnumber\">\n<a href=\"soup-createProject.php?day=".$i."&month=".$month."&year=".$year."\">$i</a>&nbsp;</span></div>\n";
			IF(isset($events[$i])){
				echo "<div align=\"left\"><span class=\"eventinbox\">\n";
				while (list($key, $value) = each ($events[$i])) {
					echo "&nbsp;<a href=\"soup-joinTeam.php?pid=".$pid."\">" . $event_info[$value]['1'] .":". $event_info[$value]['0']. "</a>\n<br>\n";
					fb("&nbsp;<a href=\"javascript:MM_openBrWindow('event.php?id=$value','','width=500,height=200');\">" . $event_info[$value]['1'] .":". $event_info[$value]['0']. "</a>\n<br>\n");
					fb($events[$i]);
					}
				echo "</span></div>\n";
			}
			echo "</td>\n";
			IF(($count_boxes == 7) AND ($days_so_far != (($first_day_of_month-1) + $days_in_month))){
				$count_boxes = 0;
				echo "</TR><TR valign=\"top\">\n";
			}
		}
		$extra_boxes = 7 - $count_boxes;
		for ($i = 1; $i <= $extra_boxes; $i++) {
			echo "<td width=\"100\" height=\"100\" class=\"afterdayboxes\"></td>\n";
		}
		$time_end = getmicrotime();
		$time = round($time_end - $time_start, 3);
		?>
        </tr>
      </table></td>
  </tr>
</table>
<p align="center"><span class="footer">&copy; 2008 
    <a href="http://www.kubelabs.com/php_calendar.php">Kubelabs.com</a><br>
    Script Execution Time: <? echo $time; ?></span><br><br>
    <a href="http://validator.w3.org/check/referer"><img border="0" src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01!" height="31" width="88"></a> 
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img border="0" style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!"></a></p>
</section>
</body>
</html>
