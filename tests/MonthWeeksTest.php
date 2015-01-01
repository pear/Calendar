<?php

class MonthWeeksTest extends PHPUnit_Framework_TestCase
{
    function setUp() {
        $this->cal = new Calendar_Month_Weeks(2003, 10);
    }
    function testPrevDay () {
        $this->assertEquals(30, $this->cal->prevDay());
    }
    function testPrevDay_Array () {
        $this->assertEquals(
            array(
                'year'   => 2003,
                'month'  => 9,
                'day'    => 30,
                'hour'   => 0,
                'minute' => 0,
                'second' => 0),
            $this->cal->prevDay('array'));
    }
    function testThisDay () {
        $this->assertEquals(1, $this->cal->thisDay());
    }
    function testNextDay () {
        $this->assertEquals(2, $this->cal->nextDay());
    }
    function testPrevHour () {
        $this->assertEquals(23, $this->cal->prevHour());
    }
    function testThisHour () {
        $this->assertEquals(0, $this->cal->thisHour());
    }
    function testNextHour () {
        $this->assertEquals(1, $this->cal->nextHour());
    }
    function testPrevMinute () {
        $this->assertEquals(59, $this->cal->prevMinute());
    }
    function testThisMinute () {
        $this->assertEquals(0, $this->cal->thisMinute());
    }
    function testNextMinute () {
        $this->assertEquals(1, $this->cal->nextMinute());
    }
    function testPrevSecond () {
        $this->assertEquals(59, $this->cal->prevSecond());
    }
    function testThisSecond () {
        $this->assertEquals(0, $this->cal->thisSecond());
    }
    function testNextSecond () {
        $this->assertEquals(1, $this->cal->nextSecond());
    }
    function testGetTimeStamp() {
        $stamp = mktime(0,0,0,10,1,2003);
        $this->assertEquals($stamp,$this->cal->getTimeStamp());
    }
    function TestOfMonthWeeksBuild() {
        $this->UnitTestCase('Test of Month_Weeks::build()');
    }
    function testSize() {
        $this->cal->build();
        $this->assertEquals(5,$this->cal->size());
    }

    function testFetch() {
        $this->cal->build();
        $i=0;
        while ($Child = $this->cal->fetch()) {
            $i++;
        }
        $this->assertEquals(5,$i);
    }
    function testFetchAll() {
        $this->cal->build();
        $children = array();
        $i = 1;
        while ( $Child = $this->cal->fetch() ) {
            $children[$i]=$Child;
            $i++;
        }
        $this->assertEquals($children,$this->cal->fetchAll());
    }
    function testSelection() {
        include_once CALENDAR_ROOT . 'Week.php';
        $selection = array(new Calendar_Week(2003, 10, 12));
        $this->cal->build($selection);
        $i = 1;
        $expected = (CALENDAR_FIRST_DAY_OF_WEEK == 0) ? 3 : 2;
        while ($Child = $this->cal->fetch()) {
            if ($i == $expected) {
                //12-10-2003 is in the 2nd week of the month if firstDay is Monday,
                //in the 3rd if firstDay is Sunday
                break;
            }
            $i++;
        }
        $this->assertTrue($Child->isSelected());
    }
    function testEmptyDaysBefore_AfterAdjust() {
        $this->cal = new Calendar_Month_Weeks(2004, 0);
        $this->cal->build();
        $expected = (CALENDAR_FIRST_DAY_OF_WEEK == 0) ? 1 : 0;
        $this->assertEquals($expected, $this->cal->tableHelper->getEmptyDaysBefore());
    }
}
