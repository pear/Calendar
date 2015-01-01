<?php

class ValidatorUnitTest extends PHPUnit_Framework_TestCase
{
    function setUp() {
        $this->mockengine = $this->getMockBuilder('Calendar_Engine_Interface')
                           ->getMock();
        $this->mockengine->method('getMinYears')->willReturn(1970);
        $this->mockengine->method('getMaxYears')->willReturn(2037);
        $this->mockengine->method('getMonthsInYear')->willReturn(12);
        $this->mockengine->method('getDaysInMonth')->willReturn(30);
        $this->mockengine->method('getHoursInDay')->willReturn(24);
        $this->mockengine->method('getMinutesInHour')->willReturn(60);
        $this->mockengine->method('getSecondsInMinute')->willReturn(60);
        $this->mockcal = $this->getMockBuilder('Calendar_Second')
                              ->disableOriginalConstructor()
                              ->getMock();
        $this->mockcal->method('getEngine')->willReturn($this->mockengine);
    }

    function testIsValidYear() {
        $this->mockcal->method('thisYear')->willReturn(2000);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertTrue($Validator->isValidYear());

    }
    function testIsValidYearTooSmall() {
        $this->mockcal->method('thisYear')->willReturn(1969);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidYear());
    }
    function testIsValidYearTooLarge() {
        $this->mockcal->method('thisYear')->willReturn(2038);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidYear());
    }
    function testIsValidMonth() {
        $this->mockcal->method('thisMonth')->willReturn(10);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertTrue($Validator->isValidMonth());
    }
    function testIsValidMonthTooSmall() {
        $this->mockcal->method('thisMonth')->willReturn(0);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidMonth());
    }
    function testIsValidMonthTooLarge() {
        $this->mockcal->method('thisMonth')->willReturn(13);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidMonth());
    }
    function testIsValidDay() {
        $this->mockcal->method('thisDay')->willReturn(10);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertTrue($Validator->isValidDay());
    }
    function testIsValidDayTooSmall() {
        $this->mockcal->method('thisDay')->willReturn(0);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidDay());
    }
    function testIsValidDayTooLarge() {
        $this->mockcal->method('thisDay')->willReturn(31);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidDay());
    }
    function testIsValidHour() {
        $this->mockcal->method('thisHour')->willReturn(10);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertTrue($Validator->isValidHour());
    }
    function testIsValidHourTooSmall() {
        $this->mockcal->method('thisHour')->willReturn(-1);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidHour());
    }
    function testIsValidHourTooLarge() {
        $this->mockcal->method('thisHour')->willReturn(24);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidHour());
    }
    function testIsValidMinute() {
        $this->mockcal->method('thisMinute')->willReturn(30);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertTrue($Validator->isValidMinute());
    }
    function testIsValidMinuteTooSmall() {
        $this->mockcal->method('thisMinute')->willReturn(-1);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidMinute());
    }
    function testIsValidMinuteTooLarge() {
        $this->mockcal->method('thisMinute')->willReturn(60);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidMinute());
    }
    function testIsValidSecond() {
        $this->mockcal->method('thisSecond')->willReturn(30);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertTrue($Validator->isValidSecond());
    }
    function testIsValidSecondTooSmall() {
        $this->mockcal->method('thisSecond')->willReturn(-1);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidSecond());
    }
    function testIsValidSecondTooLarge() {
        $this->mockcal->method('thisSecond')->willReturn(60);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValidSecond());
    }
    function testIsValid() {
        $this->mockcal->method('thisYear')->willReturn(2000);
        $this->mockcal->method('thisMonth')->willReturn(5);
        $this->mockcal->method('thisDay')->willReturn(15);
        $this->mockcal->method('thisHour')->willReturn(13);
        $this->mockcal->method('thisMinute')->willReturn(30);
        $this->mockcal->method('thisSecond')->willReturn(40);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertTrue($Validator->isValid());
    }
    function testIsValidAllWrong() {
        $this->mockcal->method('thisYear')->willReturn(2038);
        $this->mockcal->method('thisMonth')->willReturn(13);
        $this->mockcal->method('thisDay')->willReturn(31);
        $this->mockcal->day = 31;
        $this->mockcal->method('thisHour')->willReturn(24);
        $this->mockcal->method('thisMinute')->willReturn(60);
        $this->mockcal->method('thisSecond')->willReturn(60);
        $Validator = new Calendar_Validator($this->mockcal);
        $this->assertFalse($Validator->isValid());
        $i = 0;
        while ( $Validator->fetch() ) {
            $i++;
        }
        $this->assertEquals($i,6);
    }
    function testYear() {
        $Unit = new Calendar_Year(2038);
        $Validator = $Unit->getValidator();
        $this->assertFalse($Validator->isValidYear());
    }
    function testMonth() {
        $Unit = new Calendar_Month(2000,13);
        $Validator = $Unit->getValidator();
        $this->assertFalse($Validator->isValidMonth());
    }
/*
    function testWeek() {
        $Unit = new Calendar_Week(2000,12,7);
        $Validator = $Unit->getValidator();
        $this->assertFalse($Validator->isValidWeek());
    }
*/
    function testDay() {
        $Unit = new Calendar_Day(2000,12,32);
        $Validator = $Unit->getValidator();
        $this->assertFalse($Validator->isValidDay());
    }
    function testHour() {
        $Unit = new Calendar_Hour(2000,12,20,24);
        $Validator = $Unit->getValidator();
        $this->assertFalse($Validator->isValidHour());
    }
    function testMinute() {
        $Unit = new Calendar_Minute(2000,12,20,23,60);
        $Validator = $Unit->getValidator();
        $this->assertFalse($Validator->isValidMinute());
    }
    function testSecond() {
        $Unit = new Calendar_Second(2000,12,20,23,59,60);
        $Validator = $Unit->getValidator();
        $this->assertFalse($Validator->isValidSecond());
    }
    function testAllBad() {
        $Unit = new Calendar_Second(2000,13,32,24,60,60);
        $this->assertFalse($Unit->isValid());
        $Validator = $Unit->getValidator();
        $i = 0;
        while ( $Validator->fetch() ) {
            $i++;
        }
        $this->assertEquals($i,5);
    }
}
