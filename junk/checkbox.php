// This is to collect box array value as global_variables is set off in PHP5 by default

$box=$_POST['box'];

while (list ($key,$val) = @each ($box)) {
echo "$val,";
}

echo "<form method=post action='checkboxPost.php'>";
echo "<table border='0' cellspacing='0' style='border-collapse: collapse' width='100' >
<tr bgcolor='#ffffff'>
<td width='25%'><input type=checkbox name=box[] value='John'></td>
<td width='25%'>&nbsp;John</td>
<td width='25%'><input type=checkbox name=box[] value='Mike'></td>
<td width='25%'>&nbsp;Mike</td>
<td width='25%'><input type=checkbox name=box[] value='Rone'></td>
<td width='25%'>&nbsp;Rone</td>
</tr>
<tr bgcolor='#f1f1f1'>
<td width='25%'><input type=checkbox name=box[] value='Mathew'></td>
<td width='25%'>&nbsp;Mathew</td>
<td width='25%'><input type=checkbox name=box[] value='Reid'></td>
<td width='25%'>&nbsp;Reid</td>
<td width='25%'><input type=checkbox name=box[] value='Simon'></td>
<td width='25%'>&nbsp;Simon</td>
</tr>

<tr><td colspan =6 align=center><input type=submit value=Select></form></td></tr>
</table>"; 