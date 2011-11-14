<?
// This is to collect box array value as global_variables is set off in PHP5 by default

$box=$_POST['box'];

while (list ($key,$val) = @each ($box)) {
echo "$val,";
}
?>