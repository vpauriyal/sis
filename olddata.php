<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<body>
<?php
include("includes/db.php");
mssql_connect($myOServer, $myUser, $myPass)
  or die("Service Available only in Office Hours please come back later !!!");


mssql_select_db($Odbname)
  or die("Couldn't open database $myDB");

$enroll = $_GET['enroll'];
$sql = "SELECT enrol_no, sname,fname,dob,sex,study_center_code,category from student where enrol_no='$enroll'";
$query=mssql_query($sql);
echo "<div align=center><table border=1>";
while($result=mssql_fetch_array($query)) {
		$father=explode(" ",$result[fname]);
		$fname = t($father[0])." ".t($father[1])." ".t($father[2])." ".t($father[3]);
		$name=explode(" ",$result[sname]);
                $name = t($name[0])." ".t($name[1])." ".t($name[2])." ".t($name[3]);
echo "<tr><td>Name</td><td>$name</td><td>$result[sex]</td><td>$result[category]</td><td>$result[study_center_code]</td></tr>";
echo "<tr><td>Father/Husband Name</td><td>$fname</td></tr>";

}

echo "<tr><td>Programme</td><td>Programme Year</td><td>Session</td><td>Year Total</td><td>Year Result</td></tr>";
echo "<tr><td colspan=5><strong>Main Exam Results</strong></td></tr>";
$esql="SELECT year,pro_code,pro_year,roll_no,y_total,y_result from result where enroll_no like '$enroll'";

$equery=mssql_query($esql);
while($exam=mssql_fetch_array($equery)) {
echo "<tr><td>".$exam['pro_code']."</td>";
echo "<td>".$exam['pro_year']."</td>";
echo "<td>".$exam['year']."</td>";
echo "<td>".$exam['y_total']."</td>";
echo "<td>".$exam['y_result']."</td></tr>";
}
echo "</table></div>";
?>
<body>
</html>

