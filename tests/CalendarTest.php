<?php

require_once 'Calendar/Calendar.php';

class CalendarTest extends PHPUnit_Framework_TestCase
{
    var $cal;
    function setUp()
    {
        $this->cal = new Calendar(2003,10,25,13,32,43);
    }
    function tearDown() 
    {
        unset($this->cal);
    }
    function testPrevYear ()
    {
        $this->assertEquals(2002,$this->cal->prevYear());
    }
    function testPrevYear_Array () {
        $this->assertEquals(
            array(
                'year'   => 2002,
                'month'  => 1,
                'day'    => 1,
                'hour'   => 0,
                'minute' => 0,
                'second' => 0),
            $this->cal->prevYear('array'));
    }
    function testThisYear () {
        $this->assertEquals(2003,$this->cal->thisYear());
    }
    function testNextYear () {
        $this->assertEquals(2004,$this->cal->nextYear());
    }
    function testPrevMonth () {
        $this->assertEquals(9,$this->cal->prevMonth());
    }
    function testPrevMonth_Array () {
        $this->assertEquals(
            array(
                'year'   => 2003,
                'month'  => 9,
                'day'    => 1,
                'hour'   => 0,
                'minute' => 0,
                'second' => 0),
            $this->cal->prevMonth('array'));
    }
    function testThisMonth () {
        $this->assertEquals(10,$this->cal->thisMonth());
    }
    function testNextMonth () {
        $this->assertEquals(11,$this->cal->nextMonth());
    }
    function testPrevDay () {
        $this->assertEquals(24,$this->cal->prevDay());
    }
    function testPrevDay_Array () {
        $this->assertEquals(
            array(
                'year'   => 2003,
                'month'  => 10,
                'day'    => 24,
                'hour'   => 0,
                'minute' => 0,
                'second' => 0),
            $this->cal->prevDay('array'));
    }
    function testThisDay () {
        $this->assertEquals(25,$this->cal->thisDay());
    }
    function testNextDay () {
        $this->assertEquals(26,$this->cal->nextDay());
    }
    function testPrevHour () {
        $this->assertEquals(12,$this->cal->prevHour());
    }
    function testThisHour () {
        $this->assertEquals(13,$this->cal->thisHour());
    }
    function testNextHour () {
        $this->assertEquals(14,$this->cal->nextHour());
    }
    function testPrevMinute () {
        $this->assertEquals(31,$this->cal->prevMinute());
    }
    function testThisMinute () {
        $this->assertEquals(32,$this->cal->thisMinute());
    }
    function testNextMinute () {
        $this->assertEquals(33,$this->cal->nextMinute());
    }
    function testPrevSecond () {
        $this->assertEquals(42,$this->cal->prevSecond());
    }
    function testThisSecond () {
        $this->assertEquals(43,$this->cal->thisSecond());
    }
    function testNextSecond () {
        $this->assertEquals(44,$this->cal->nextSecond());
    }
    function testSetTimeStamp() {
        $stamp = mktime(13,32,43,10,25,2003);
        $this->cal->setTimeStamp($stamp);
        $this->assertEquals($stamp,$this->cal->getTimeStamp());
    }
    function testGetTimeStamp() {
        $stamp = mktime(13,32,43,10,25,2003);
        $this->assertEquals($stamp,$this->cal->getTimeStamp());
    }
    function testIsToday() {
        $stamp = mktime();
        $this->cal->setTimestamp($stamp);
        $this->assertTrue($this->cal->isToday());

        $stamp += 1000000000;
        $this->cal->setTimestamp($stamp);
        $this->assertFalse($this->cal->isToday());
    }
}
