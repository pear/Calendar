<?php

class MockCalendarTestCase extends PHPUnit_Framework_TestCase
{
	var $mockengine;
    var $mockcal;

    function setUp() {
        $this->mockengine = $this->getMockBuilder('Calendar_Engine_Interface')
                                 ->getMock();

        $this->mockcal = $this->getMockBuilder('Calendar_Second')
                              ->disableOriginalConstructor()
                              ->getMock();
        $this->mockcal->method('prevYear')->willReturn(2002);
        $this->mockcal->method('thisYear')->willReturn(2003);
        $this->mockcal->method('nextYear')->willReturn(2004);
        $this->mockcal->method('prevMonth')->willReturn(9);
        $this->mockcal->method('thisMonth')->willReturn(10);
        $this->mockcal->method('nextMonth')->willReturn(11);
        $this->mockcal->method('prevDay')->willReturn(14);
        $this->mockcal->method('thisDay')->willReturn(15);
        $this->mockcal->method('nextDay')->willReturn(16);
        $this->mockcal->method('prevHour')->willReturn(12);
        $this->mockcal->method('thisHour')->willReturn(13);
        $this->mockcal->method('nextHour')->willReturn(14);
        $this->mockcal->method('prevMinute')->willReturn(29);
        $this->mockcal->method('thisMinute')->willReturn(30);
        $this->mockcal->method('nextMinute')->willReturn(31);
        $this->mockcal->method('prevSecond')->willReturn(44);
        $this->mockcal->method('thisSecond')->willReturn(45);
        $this->mockcal->method('nextSecond')->willReturn(46);
        $this->mockcal->method('getEngine')->willReturn($this->mockengine);
        $this->mockcal->method('getTimestamp')->willReturn(12345);
    }
    
    function tearDown() {
        unset ( $this->mockengine );
        unset ( $this->mockcal );
    }
}
