<?php

class DayTest extends PHPUnit_Framework_TestCase
{
    function setUp() {
        $this->cal = new Calendar_Day(2003,10,25);
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
    function testPrevHour () {
        $this->assertEquals(23,$this->cal->prevHour());
    }
    function testThisHour () {
        $this->assertEquals(0,$this->cal->thisHour());
    }
    function testNextHour () {
        $this->assertEquals(1,$this->cal->nextHour());
    }
    function testPrevMinute () {
        $this->assertEquals(59,$this->cal->prevMinute());
    }
    function testThisMinute () {
        $this->assertEquals(0,$this->cal->thisMinute());
    }
    function testNextMinute () {
        $this->assertEquals(1,$this->cal->nextMinute());
    }
    function testPrevSecond () {
        $this->assertEquals(59,$this->cal->prevSecond());
    }
    function testThisSecond () {
        $this->assertEquals(0,$this->cal->thisSecond());
    }
    function testNextSecond () {
        $this->assertEquals(1,$this->cal->nextSecond());
    }
    function testGetTimeStamp() {
        $stamp = mktime(0,0,0,10,25,2003);
        $this->assertEquals($stamp,$this->cal->getTimeStamp());
    }
    function testSize() {
        $this->cal->build();
        $this->assertEquals(24,$this->cal->size());
    }
    function testFetch() {
        $this->cal->build();
        $i=0;
        while ( $Child = $this->cal->fetch() ) {
            $i++;
        }
        $this->assertEquals(24,$i);
    }
    function testFetchAll() {
        $this->cal->build();
        $children = array();
        $i = 0;
        while ( $Child = $this->cal->fetch() ) {
            $children[$i]=$Child;
            $i++;
        }
        $this->assertEquals($children,$this->cal->fetchAll());
    }
    function testSelection() {
        require_once(CALENDAR_ROOT . 'Hour.php');
        $selection = array(new Calendar_Hour(2003,10,25,13));
        $this->cal->build($selection);
        $i = 0;
        while ( $Child = $this->cal->fetch() ) {
            if ( $i == 13 )
                break;
            $i++;
        }
        $this->assertTrue($Child->isSelected());
    }
}
