<?
echo header("Content-type: text/plain");
session_start();
include_once('dbinfo.php');
require_once('FirePHP.class.php');
require_once('fb.php');
ob_start(); //gotta have this
fb('how are you today');



function createUpdateTable($sql){
	$sqll =$sql." LIMIT 1";
	$res = mysql_query($sqll);
	$numfields = mysql_num_fields($res);
	$field_names = array_keys( mysql_fetch_array( mysql_query($sql), MYSQL_ASSOC)); 
	fb($field_names);
	$fn="";
	$gn="";
	$vn="";
	$eq="";
	$sq="";
	$bn="(";
	$cn="(";
$whr = " WHERE id = \".\$id.\"";	
$get1 = "\$trying =\"ontime\"; fb(\$trying);\n";
$get1 .="\$sql=\"".$sql.$whr." LIMIT 1\";\n";	
$get1 .="fb(\$sql);\n";	
$get1 .="\$result = mysql_query(\$sql) or die(\$trying);\n";	
$get1 .="\$r = mysql_fetch_assoc(\$result);\n";	
/*
$trying = "";
$sql="SELECT * FROM  WHERE id ='".$id."'";
fb($sql);
$result = mysql_query($sql) or die($trying);
$row = 	$arow = mysql_fetch_assoc($result);

*/
	for ($i=0;$i<$numfields;$i++){
		$row  = mysql_field_name($res, $i);
		$table = mysql_tablename($res,$i);
		$sz = mysql_field_len($res, $i);
		$fn.= $row."\n";
		$gn.= "\$_GET['".$row."'];\n";
		$vn.= "$".$row."\n";
		$en.= "$".$row." = \$_GET['".$row."'];\n";
		$pn.= "$".$row." = \$_POST['".$row."'];\n";
		$rn.= "$".$row." = \$_REQUEST['".$row."'];\n";		
		$bn.= "'$".$row."', ";
		$cn.= "`".$row."`, ";
		$se  .= "`".$row."` = '$".$row."',\n";	
		$is .= "<label>".$row.": </label>\n";
		$is .= "<input name=\"".$row."\" size=\"".$sz."\" id=\"".$row."\" value=\<?=".$row."?>\"/>\n";		
		$ts .= "<tr><td></td><td><label>".$row.": </label></td>
<td></td><td>
<input name=\"".$row."\" id=\"".$row."\" size=\"".$sz."\" value=\"<?=$".$row."?>\"/></td><td></td></tr>\n";			//$fn.= $row."\n";		
		
		$get1 .= "$".$row." = \$r['".$row."'];\n"; 
		//$projdate = $row['projdate'];
		}
	$bn =substr($bn,0,-2).")\n";	
	$cn =substr($cn,0,-2).")\n";
echo $get1."\n\n";	
	echo $fn."\n\n";
	echo $gn."\n\n";
	echo $bn."\n\n";
	echo "INSERT INTO table " . $cn . " VALUES ".$bn."\n\n";
	echo $en."\n\n";
	echo $pn."\n\n";
	echo $rn."\n\n";
	echo $se."\n\n";
	echo $is."\n\n";
	echo $ts."\n\n";	
	//echo $sq;	
}
/*
mysql_connect("localhost", "mysql_username", "mysql_password");
mysql_select_db("mysql");
$result = mysql_query("SELECT * FROM func");
$fields = mysql_num_fields($result);
$rows   = mysql_num_rows($result);
$table  = mysql_field_table($result, 0);
echo "Your '" . $table . "' table has " . $fields . " fields and " . $rows . " record(s)\n";
echo "The table has the following fields:\n";
for ($i=0; $i < $fields; $i++) {
    $type  = mysql_field_type($result, $i);
    $name  = mysql_field_name($result, $i);
    $len   = mysql_field_len($result, $i);
    $flags = mysql_field_flags($result, $i);
    echo $type . " " . $name . " " . $len . " " . $flags . "\n";
}
mysql_free_result($result);
mysql_close();

The above example will output something similar to:

Your 'func' table has 4 fields and 1 record(s)
The table has the following fields:
string name 64 not_null primary_key binary
int ret 1 not_null
string dl 128 not_null
string type 9 not_null enum



*/

$sql="SELECT * FROM proutlines";
fb($sql);
createUpdateTable($sql);
?>
