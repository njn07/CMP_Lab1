<html>
<head>
<title>Lab1 Calendar</title>
</head>
<body>
<form action="./calendar.php" method="get">
		Enter year: <input name="year"><br /> 
		Enter month: <input name="month"><br />
<input type="submit" value="Show calendar">
	</form>
</body>
</html>
<?php
if (isset($_GET['month'])&&isset($_GET['year'])) {
$month=$_GET['month'];
$year=$_GET['year'];
	if(validInput($year,$month))
		setCalendar($year,$month);
	else {
		echo 'Bad input parameters';
	}
  }
  
  function validInput($year,$month){
		if (is_numeric($year)&&is_numeric($month)) {	
		if($year>1601&&$year<2399)
			return true;
		}
  return false;
  }
  function setCalendar($inYear, $inMonth){
  $dayofmonth = date('t',
                      mktime(0, 0, 0, $inMonth, 1, $inYear));
  $day_count = 1;

  $num = 0;
  for($i = 0; $i < 7; $i++)
  {
    $dayofweek = date('w',
                      mktime(0, 0, 0, $inMonth, $day_count, $inYear));
    $dayofweek = $dayofweek - 1;
    if($dayofweek == -1) $dayofweek = 6;

    if($dayofweek == $i)
    {
      $week[$num][$i] = $day_count;
      $day_count++;
    }
    else
    {
      $week[$num][$i] = "";
    }
  }

  while(true)
  {
    $num++;
    for($i = 0; $i < 7; $i++)
    {
      $week[$num][$i] = $day_count;
      $day_count++;
      if($day_count > $dayofmonth) break;
    }
    if($day_count > $dayofmonth) break;
  }
	setView($week);
  }
  function setView($week){
  
  echo "<table border=1>";
  for($i = 0; $i < count($week); $i++)
  {
    echo "<tr>";
    for($j = 0; $j < 7; $j++)
    {
      if(!empty($week[$i][$j]))
      {
        if($j == 5 || $j == 6) 
             echo "<td><font color=red>".$week[$i][$j]."</font></td>";
        else echo "<td>".$week[$i][$j]."</td>";
      }
      else echo "<td>&nbsp;</td>";
    }
    echo "</tr>";
  } 
  echo "</table>";
  }
?>