<?php
/**
* Description: shows the Weekday decorator combined with the Wrapper decorator
* plus the Uri and Textual utilities
*/

if ( !@include 'Calendar/Calendar.php' ) {
    define('CALENDAR_ROOT','../../');
}
require_once CALENDAR_ROOT.'Month'.DIRECTORY_SEPARATOR.'Weekdays.php';
require_once CALENDAR_ROOT.'Decorator'.DIRECTORY_SEPARATOR.'Wrapper.php';
require_once CALENDAR_ROOT.'Decorator'.DIRECTORY_SEPARATOR.'Weekday.php';
require_once CALENDAR_ROOT.'Util'.DIRECTORY_SEPARATOR.'Uri.php';
require_once CALENDAR_ROOT.'Util'.DIRECTORY_SEPARATOR.'Textual.php';

if (!isset($_GET['y'])) $_GET['y'] = date('Y');
if (!isset($_GET['m'])) $_GET['m'] = date('m');

// Build a month
$Month = & new Calendar_Month_Weekdays($_GET['y'],$_GET['m']);

// Build the days in the month
$Month->build();

// Decorate it with the Wrapper
$WrappedMonth = & new Calendar_Decorator_Wrapper($Month);

// Set up the Uri util, specifying required fragments (see $_GET vars above)
$Uri = & new Calendar_Util_Uri('y','m');

// Get the names of the days of the week
$weekDayNames = Calendar_Util_Textual::weekdayNames('short');
// Move Sunday to the end of the list
$weekDayNames[] = array_shift($weekDayNames);

// Find out who's on call for this day of the week
function whoIsOnCall($dayOfWeek) {
    switch ( $dayOfWeek ) {
        case 0:
        case 4:
            return 'John';
        break;
        case 1:
        case 3:
            return 'Bill';
        break;
        case 2:
            return 'Mary';
        break;

        // No one on call at weekends
        case 5:
        case 6:
            return false;
        break;
    }
}
?>
<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> On Call List </title>
<style text="text/css">

body {
    font-family: verdana;
    font-size: 11px;
}

h2, p {

    text-align: center;

}
table {
    border-collapse: collapse;
    font-size: inherit;
    
}
caption {
    font-family: verdana;
    font-size: 14pt;
    padding-bottom: 4pt;
}
th {
    text-align: center;
    background-color: #e7e3e7;
    padding: 5pt;
    line-height: 150%;
    border: 1px solid #ccc;
}
td {
    text-align: left;
    vertical-align: top;
    border: 1px solid #b5bece;
    padding: 3px;
}
td.calCellEmpty {
    background-color: #f3f3f7;
}

.calWeekNum {
    text-align: center;
    width: 50px;
    border: ;
}

#prev {
    float: left;
    font-size: 70%;
}
#next {
    float: right;
    font-size: 70%;
}
</style>
</head>

<body>

<h2>On Call List</h2>

<p>Shows the Wrapper and Weekday decorators in use. The "on call" person is assigned by day of the week in this example.</p>

<table class="calendar" width="98%" cellspacing="0" cellpadding="0">
<caption>
    <div id="next">
        <a href="?<?php echo $Uri->next($Month,'month'); ?>">>></a>
    </div>
    
    <div id="prev">
        <a href="?<?php echo $Uri->prev($Month,'month'); ?>"><<</a>
    </div>

    <?php echo strftime('%B %Y',$Month->getTimestamp()); ?>
</caption>

<tr>
    <th class="calWeekNum">Week #</th>

<?php
foreach ( $weekDayNames as $weekDayName ) {
?>
    <th><?php echo $weekDayName; ?></th>
<?php
}
?>
</tr>

<?php
$weekNum = 1;

// Pull out the days, immediately wrapping them in a Weekday decorator
while ( $Weekday = & $WrappedMonth->fetch('Calendar_Decorator_Weekday') ) {

    if ($Weekday->isFirst()) {
        echo "<tr>\n";
        echo "<td class='calWeekNum'>$weekNum</td>\n";
    }

    if ( $Weekday->isEmpty() ) {

        echo "<td class='calCellEmpty'>&nbsp;</td>\n";

    } else {

        echo "<td>";

        if ( false !== ( $onCall = whoIsOnCall($Weekday->thisWeekDay()) ) ) {
            echo "On Call: $onCall";
        } else {
            echo "&nbsp;";
        }
        
        echo "</td>\n";

    }

    if ($Weekday->isLast()) {
        echo "</tr>\n";
        $weekNum++;
    }

}
?>

</table>

</body>

</html>