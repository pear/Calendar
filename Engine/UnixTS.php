<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Harry Fuecks <hfuecks@phppatterns.com>                      |
// +----------------------------------------------------------------------+
//
// $Id$
//
/**
 * @package Calendar
 * @version $Id$
 */
/**
 * Performs calendar calculations based on the PHP date() function and
 * Unix timestamps (using PHP's mktime() function).
 * @package Calendar
 * @access protected
 */
class Calendar_Engine_UnixTS /* implements Calendar_Engine_Interface */
{
    /**
     * Returns a numeric year given a timestamp
     * @param int Unix timestamp
     * @return int year (e.g. 2003)
     * @access protected
     */
    function stampToYear($stamp)
    {
        static $r = array();
        if (!isset($r[$stamp])) {
            $r[$stamp] = @date('Y', $stamp);
        }
        return (int)$r[$stamp];
    }

    /**
     * Returns a numeric month given a timestamp
     * @param int Unix timestamp
     * @return int month (e.g. 9)
     * @access protected
     */
    function stampToMonth($stamp)
    {
        static $r = array();
        if (!isset($r[$stamp])) {
            $r[$stamp] = @date('n', $stamp);
        }
        return (int)$r[$stamp];
    }

    /**
     * Returns a numeric day given a timestamp
     * @param int Unix timestamp
     * @return int day (e.g. 15)
     * @access protected
     */
    function stampToDay($stamp)
    {
        static $r = array();
        if (!isset($r[$stamp])) {
            $r[$stamp] = @date('j', $stamp);
        }
        return (int)$r[$stamp];
    }

    /**
     * Returns a numeric hour given a timestamp
     * @param int Unix timestamp
     * @return int hour (e.g. 13)
     * @access protected
     */
    function stampToHour($stamp)
    {
        static $r = array();
        if (!isset($r[$stamp])) {
            $r[$stamp] = @date('H', $stamp);
        }
        return (int)$r[$stamp];
    }

    /**
     * Returns a numeric minute given a timestamp
     * @param int Unix timestamp
     * @return int minute (e.g. 34)
     * @access protected
     */
    function stampToMinute($stamp)
    {
        static $r = array();
        if (!isset($r[$stamp])) {
            $r[$stamp] = @date('i', $stamp);
        }
        return (int)$r[$stamp];
    }

    /**
     * Returns a numeric second given a timestamp
     * @param int Unix timestamp
     * @return int second (e.g. 51)
     * @access protected
     */
    function stampToSecond($stamp)
    {
        static $r = array();
        if (!isset($r[$stamp])) {
            $r[$stamp] = @date('s', $stamp);
        }
        return (int)$r[$stamp];
    }

    /**
     * Returns a timestamp
     * @param int year (2003)
     * @param int month (9)
     * @param int day (13)
     * @param int hour (13)
     * @param int minute (34)
     * @param int second (53)
     * @return int Unix timestamp
     * @access protected
     */
    function dateToStamp($y, $m, $d, $h=0, $i=0, $s=0)
    {
        return @mktime($h, $i, $s, $m, $d, $y);
    }

    /**
     * The upper limit on years that the Calendar Engine can work with
     * @return int (2037)
     * @access protected
     */
    function getMaxYears()
    {
        return 2037;
    }

    /**
     * The lower limit on years that the Calendar Engine can work with
     * @return int (1970 if it's Windows and 1902 for all other OSs)
     * @access protected
     */
    function getMinYears()
    {
        return $min = strpos(PHP_OS, 'WIN') >= 0 ? 1970 : 1902;
    }

    /**
     * Returns the number of months in a year
     * @return int (12)
    * @access protected
     */
    function getMonthsInYear($y=null)
    {
        return 12;
    }

    /**
     * Returns the number of days in a month, given year and month
     * @param int year (2003)
     * @param int month (9)
     * @return int days in month
     * @access protected
     */
    function getDaysInMonth($y, $m)
    {
        return @date('t', @mktime(0, 0, 0, $m, 1, $y));
    }

    /**
     * Returns numeric representation of the day of the week in a month,
     * given year and month
     * @param int year (2003)
     * @param int month (9)
     * @return int from 0 to 6
     * @access protected
     */
    function getFirstDayInMonth($y, $m)
    {
        return @date('w', @mktime(0, 0, 0, $m, 1, $y));
    }

    /**
     * Returns the number of days in a week
     * @return int (7)
     * @access protected
     */
    function getDaysInWeek()
    {
        return 7;
    }

    /**
     * Returns the number of the week in the year (ISO-8601), given a date
     * @param int year (2003)
     * @param int month (9)
     * @param int day (4)
     * @return int week number
     * @access protected
     */
    function getWeekNInYear($y, $m, $d)
    {
        return @date('W', @mktime(0, 0, 0, $m, $d, $y));
    }

    /**
     * Returns the number of the week in the month, given a date
     * @param int year (2003)
     * @param int month (9)
     * @param int day (4)
     * @param int first day of the week (default: monday)
     * @return int week number
     * @access protected
     */
    function getWeekNInMonth($y, $m, $d, $firstDay=1)
    {
        $weekEnd = ($firstDay == 0) ? $this->getDaysInWeek()-1 : $firstDay-1;
        $end_of_week = 1;
        while (@date('w', @mktime(0, 0, 0, $m, $end_of_week, $y)) != $weekEnd) {
            ++$end_of_week; //find first weekend of the month
        }
        $w = 1;
        while ($d > $end_of_week) {
            ++$w;
            $end_of_week += $this->getDaysInWeek();
        }
        return $w;
    }

    /**
     * Returns the number of weeks in the month
     * @param int year (2003)
     * @param int month (9)
     * @param int first day of the week (default: monday)
     * @return int weeks number
     * @access protected
     */
    function getWeeksInMonth($y, $m, $firstDay=1)
    {
        $FDOM = $this->getFirstDayInMonth($y, $m);
        if ($FDOM > $firstDay) {
            $firstWeekDays = $this->getDaysInWeek() - $FDOM + $firstDay;
            $weeks = 1;
        } else {
            $firstWeekDays = $firstDay - $FDOM;
            $weeks = 0;
        }
        $firstWeekDays %= $this->getDaysInWeek();
        return (int)(ceil(($this->getDaysInMonth($y, $m) - $firstWeekDays) /
                           $this->getDaysInWeek()) + $weeks);
    }

    /**
     * Returns the number of the day of the week (0=sunday, 1=monday...)
     * @param int year (2003)
     * @param int month (9)
     * @param int day (4)
     * @return int weekday number
     * @access protected
     */
    function getDayOfWeek($y, $m, $d)
    {
        return @date('w', @mktime(0, 0, 0, $m, $d, $y));
    }

    /**
     * Returns a list of integer days of the week beginning 0
     * @return array (0,1,2,3,4,5,6) 1 = Monday
     * @access protected
     */
    function getWeekDays()
    {
        return array(0, 1, 2, 3, 4, 5, 6);
    }

    /**
     * Returns the default first day of the week
     * @return int (default 1 = Monday)
     * @access protected
     */
    function getFirstDayOfWeek()
    {
        return 1;
    }

    /**
     * Returns the number of hours in a day
     * @return int (24)
     * @access protected
     */
    function getHoursInDay($y=null,$m=null,$d=null)
    {
        return 24;
    }

    /**
     * Returns the number of minutes in an hour
     * @return int (60)
     * @access protected
     */
    function getMinutesInHour($y=null,$m=null,$d=null,$h=null)
    {
        return 60;
    }

    /**
     * Returns the number of seconds in a minutes
     * @return int (60)
     * @access protected
     */
    function getSecondsInMinute($y=null,$m=null,$d=null,$h=null,$i=null)
    {
        return 60;
    }
}
?>