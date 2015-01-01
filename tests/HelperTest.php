<?php

class HelperTest extends PHPUnit_Framework_TestCase
{
	function setUp() {
        $this->mockengine = $this->getMockBuilder('Calendar_Engine_Interface')
                                 ->getMock();
        $this->mockengine->method('getMinYears')->willReturn(1970);
        $this->mockengine->method('getMaxYears')->willReturn(2037);
        $this->mockengine->method('getMonthsInYear')->willReturn(12);
        $this->mockengine->method('getDaysInMonth')->willReturn(31);
        $this->mockengine->method('getHoursInDay')->willReturn(24);
        $this->mockengine->method('getMinutesInHour')->willReturn(60);
        $this->mockengine->method('getSecondsInMinute')->willReturn(60);
        $this->mockengine->method('getWeekDays')->willReturn(array(0,1,2,3,4,5,6));
        $this->mockengine->method('getDaysInWeek')->willReturn(7);
        $this->mockengine->method('getFirstDayOfWeek')->willReturn(1);
        $this->mockengine->method('getFirstDayInMonth')->willReturn(3);

        $this->mockcal = $this->getMockBuilder('Calendar_Second')
                              ->disableOriginalConstructor()
                              ->getMock();
        $this->mockcal->method('thisYear')->willReturn(2003);
        $this->mockcal->method('thisMonth')->willReturn(10);
        $this->mockcal->method('thisDay')->willReturn(15);
        $this->mockcal->method('thisHour')->willReturn(13);
        $this->mockcal->method('thisMinute')->willReturn(30);
        $this->mockcal->method('thisSecond')->willReturn(45);
        $this->mockcal->method('getEngine')->willReturn($this->mockengine);
    }
    function testGetFirstDay() {
        for ( $i = 0; $i <= 7; $i++ ) {
            $Helper = new Calendar_Table_Helper($this->mockcal,$i);
            $this->assertEquals($Helper->getFirstDay(),$i);
        }
    }
    function testGetDaysOfWeekMonday() {
        $Helper = new Calendar_Table_Helper($this->mockcal);
        $this->assertEquals($Helper->getDaysOfWeek(),array(1,2,3,4,5,6,0));
    }
    function testGetDaysOfWeekSunday() {
        $Helper = new Calendar_Table_Helper($this->mockcal,0);
        $this->assertEquals($Helper->getDaysOfWeek(),array(0,1,2,3,4,5,6));
    }
    function testGetDaysOfWeekThursday() {
        $Helper = new Calendar_Table_Helper($this->mockcal,4);
        $this->assertEquals($Helper->getDaysOfWeek(),array(4,5,6,0,1,2,3));
    }
    function testGetNumWeeks() {
        $Helper = new Calendar_Table_Helper($this->mockcal);
        $this->assertEquals($Helper->getNumWeeks(),5);
    }
    function testGetNumTableDaysInMonth() {
        $Helper = new Calendar_Table_Helper($this->mockcal);
        $this->assertEquals($Helper->getNumTableDaysInMonth(),35);
    }
    function testGetEmptyDaysBefore() {
        $Helper = new Calendar_Table_Helper($this->mockcal);
        $this->assertEquals($Helper->getEmptyDaysBefore(),2);
    }
    function testGetEmptyDaysAfter() {
        $Helper = new Calendar_Table_Helper($this->mockcal);
        $this->assertEquals($Helper->getEmptyDaysAfter(),33);
    }
    function testGetEmptyDaysAfterOffset() {
        $Helper = new Calendar_Table_Helper($this->mockcal);
        $this->assertEquals($Helper->getEmptyDaysAfterOffset(),5);
    }
}
