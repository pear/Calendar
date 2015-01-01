<?php

if (! defined('CALENDAR_FIRST_DAY_OF_WEEK')) {
    define('CALENDAR_FIRST_DAY_OF_WEEK', 0); //force firstDay = Sunday
}

class WeekFirstDayZeroTest extends PHPUnit_Framework_TestCase
{
    function setUp() {
        // This test must be run alone, otherwise it will be skipped.
        if (CALENDAR_FIRST_DAY_OF_WEEK == 1) {
            $this->markTestSkipped();
        }
        $this->cal = Calendar_Factory::create('Week', 2003, 10, 9);
    }
    function testPrevDay () {
        $this->assertEquals(8, $this->cal->prevDay());
    }
    function testPrevDay_Array () {
        $this->assertEquals(
            array(
                'year'   => 2003,
                'month'  => 10,
                'day'    => 8,
                'hour'   => 0,
                'minute' => 0,
                'second' => 0),
            $this->cal->prevDay('array'));
    }
    function testThisDay () {
        $this->assertEquals(9, $this->cal->thisDay());
    }
    function testNextDay () {
        $this->assertEquals(10, $this->cal->nextDay());
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
        $stamp = mktime(0,0,0,10,9,2003);
        $this->assertEquals($stamp,$this->cal->getTimeStamp());
    }
    function testNewTimeStamp() {
        $stamp = mktime(0,0,0,7,28,2004);
        $this->cal->setTimestamp($stamp);
        $this->assertEquals('29 2004', date('W Y', $this->cal->prevWeek(true)));
        $this->assertEquals('30 2004', date('W Y', $this->cal->thisWeek(true)));
        $this->assertEquals('31 2004', date('W Y', $this->cal->nextWeek(true)));
    }
    function testPrevWeekInMonth() {
        $this->assertEquals(1, $this->cal->prevWeek());
        $stamp = mktime(0,0,0,2,3,2005);
        $this->cal->setTimestamp($stamp);
        $this->assertEquals(0, $this->cal->prevWeek());
    }
    function testThisWeekInMonth() {
        $this->assertEquals(2, $this->cal->thisWeek());
        $stamp = mktime(0,0,0,2,3,2005);
        $this->cal->setTimestamp($stamp);
        $this->assertEquals(1, $this->cal->thisWeek());
        $stamp = mktime(0,0,0,1,1,2005);
        $this->cal->setTimestamp($stamp);
        $this->assertEquals(1, $this->cal->thisWeek());
        $stamp = mktime(0,0,0,1,3,2005);
        $this->cal->setTimestamp($stamp);
        $this->assertEquals(2, $this->cal->thisWeek());
    }
    function testNextWeekInMonth() {
        $this->assertEquals(3, $this->cal->nextWeek());
        $stamp = mktime(0,0,0,2,3,2005);
        $this->cal->setTimestamp($stamp);
        $this->assertEquals(2, $this->cal->nextWeek());
    }
    function testPrevWeekInYear() {
        $this->assertEquals(date('W', $this->cal->prevWeek('timestamp')), $this->cal->prevWeek('n_in_year'));
        $stamp = mktime(0,0,0,1,1,2004);
        $this->cal->setTimestamp($stamp);
        $this->assertEquals(date('W', $this->cal->nextWeek('timestamp')), $this->cal->nextWeek('n_in_year'));
    }
    function testThisWeekInYear() {
        $this->assertEquals(date('W', $this->cal->thisWeek('timestamp')), $this->cal->thisWeek('n_in_year'));
        $stamp = mktime(0,0,0,1,1,2004);
        $this->cal->setTimestamp($stamp);
        $this->assertEquals(date('W', $this->cal->thisWeek('timestamp')), $this->cal->thisWeek('n_in_year'));
    }
    function testFirstWeekInYear() {
        $stamp = mktime(0,0,0,1,4,2004);
        $this->cal->setTimestamp($stamp);
        $this->assertEquals(1, $this->cal->thisWeek('n_in_year'));
    }
    function testNextWeekInYear() {
        $this->assertEquals(date('W', $this->cal->nextWeek('timestamp')), $this->cal->nextWeek('n_in_year'));
    }
    function testPrevWeekArray() {
        $testArray = array(
            'year'=>2003,
            'month'=>9,
            'day'=>28,
            'hour'=>0,
            'minute'=>0,
            'second'=>0
            );
        $this->assertEquals($testArray, $this->cal->prevWeek('array'));
    }
    function testThisWeekArray() {
        $testArray = array(
            'year'=>2003,
            'month'=>10,
            'day'=>5,
            'hour'=>0,
            'minute'=>0,
            'second'=>0
            );
        $this->assertEquals($testArray, $this->cal->thisWeek('array'));
    }
    function testNextWeekArray() {
        $testArray = array(
            'year'=>2003,
            'month'=>10,
            'day'=>12,
            'hour'=>0,
            'minute'=>0,
            'second'=>0
            );
        $this->assertEquals($testArray, $this->cal->nextWeek('array'));
    }
    function testPrevWeekObject() {
        $testWeek = Calendar_Factory::create('Week', 2003,9,28);
        $Week = $this->cal->prevWeek('object');
        $this->assertEquals($testWeek->getTimeStamp(),$Week->getTimeStamp());
    }
    function testThisWeekObject() {
        $testWeek = Calendar_Factory::create('Week', 2003,10,5);
        $Week = $this->cal->thisWeek('object');
        $this->assertEquals($testWeek->getTimeStamp(),$Week->getTimeStamp());
    }
    function testNextWeekObject() {
        $testWeek = Calendar_Factory::create('Week', 2003,10,12);
        $Week = $this->cal->nextWeek('object');
        $this->assertEquals($testWeek->getTimeStamp(),$Week->getTimeStamp());
    }
    function testSize() {
        $this->cal->build();
        $this->assertEquals(7, $this->cal->size());
    }

    function testFetch() {
        $this->cal->build();
        $i=0;
        while ($Child = $this->cal->fetch()) {
            $i++;
        }
        $this->assertEquals(7, $i);
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
        require_once(CALENDAR_ROOT . 'Day.php');
        $selection = array(Calendar_Factory::create('Day', 2003, 10, 6));
        $this->cal->build($selection);
        $i = 1;
        while ($Child = $this->cal->fetch()) {
            if ($i == 2) {
                break; //06-10-2003 is the 2nd day of the week
            }
            $i++;
        }
        $this->assertTrue($Child->isSelected());
    }
    function testSelectionCornerCase() {
        require_once(CALENDAR_ROOT . 'Day.php');
        $selectedDays = array(
            Calendar_Factory::create('Day', 2003, 12, 28),
            Calendar_Factory::create('Day', 2003, 12, 29),
            Calendar_Factory::create('Day', 2003, 12, 30),
            Calendar_Factory::create('Day', 2003, 12, 31),
            Calendar_Factory::create('Day', 2004, 01, 01),
            Calendar_Factory::create('Day', 2004, 01, 02),
            Calendar_Factory::create('Day', 2004, 01, 03)
        );
        $this->cal = Calendar_Factory::create('Week', 2003, 12, 31, 0);
        $this->cal->build($selectedDays);
        while ($Day = $this->cal->fetch()) {
            $this->assertTrue($Day->isSelected());
        }
        $this->cal = Calendar_Factory::create('Week', 2004, 1, 1, 0);
        $this->cal->build($selectedDays);
        while ($Day = $this->cal->fetch()) {
            $this->assertTrue($Day->isSelected());
        }
    }
}
