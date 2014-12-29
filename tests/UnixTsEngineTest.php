<?php

class UnixTsEngineTest extends PHPUnit_Framework_TestCase
{
    function setUp() {
        $this->engine = new Calendar_Engine_UnixTs();
    }
    function testGetSecondsInMinute() {
        $this->assertEquals($this->engine->getSecondsInMinute(),60);
    }
    function testGetMinutesInHour() {
        $this->assertEquals($this->engine->getMinutesInHour(),60);
    }
    function testGetHoursInDay() {
        $this->assertEquals($this->engine->getHoursInDay(),24);
    }
    function testGetFirstDayOfWeek() {
        $this->assertEquals($this->engine->getFirstDayOfWeek(),1);
    }
    function testGetWeekDays() {
        $this->assertEquals($this->engine->getWeekDays(),array(0,1,2,3,4,5,6));
    }
    function testGetDaysInWeek() {
        $this->assertEquals($this->engine->getDaysInWeek(),7);
    }
    function testGetWeekNInYear() {
        $this->assertEquals($this->engine->getWeekNInYear(2003, 11, 3), 45);
    }
    function testGetWeekNInMonth() {
        $this->assertEquals($this->engine->getWeekNInMonth(2003, 11, 3), 2);
    }
    function testGetWeeksInMonth0() {
        $this->assertEquals($this->engine->getWeeksInMonth(2003, 11, 0), 6); //week starts on sunday
    }
    function testGetWeeksInMonth1() {
        $this->assertEquals($this->engine->getWeeksInMonth(2003, 11, 1), 5); //week starts on monday
    }
    function testGetWeeksInMonth2() {
        $this->assertEquals($this->engine->getWeeksInMonth(2003, 2, 6), 4); //week starts on saturday
    }
    function testGetWeeksInMonth3() {
        // Unusual cases that can cause fails (shows up with example 21.php)
        $this->assertEquals($this->engine->getWeeksInMonth(2004,2,1),5);
        $this->assertEquals($this->engine->getWeeksInMonth(2004,8,1),6);
    }
    function testGetDayOfWeek() {
        $this->assertEquals($this->engine->getDayOfWeek(2003, 11, 18), 2);
    }
    function testGetFirstDayInMonth() {
        $this->assertEquals($this->engine->getFirstDayInMonth(2003,10),3);
    }
    function testGetDaysInMonth() {
        $this->assertEquals($this->engine->getDaysInMonth(2003,10),31);
    }
    function testGetMinYears() {
        $test = strpos(PHP_OS, 'WIN') === true ? 1970 : 1902;
        $this->assertEquals($this->engine->getMinYears(),$test);
    }
    function testGetMaxYears() {
        $this->assertEquals($this->engine->getMaxYears(),2037);
    }
    function testDateToStamp() {
        $stamp = mktime(0,0,0,10,15,2003);
        $this->assertEquals($this->engine->dateToStamp(2003,10,15,0,0,0),$stamp);
    }
    function testStampToSecond() {
        $stamp = mktime(13,30,45,10,15,2003);
        $this->assertEquals($this->engine->stampToSecond($stamp),45);
    }
    function testStampToMinute() {
        $stamp = mktime(13,30,45,10,15,2003);
        $this->assertEquals($this->engine->stampToMinute($stamp),30);
    }
    function testStampToHour() {
        $stamp = mktime(13,30,45,10,15,2003);
        $this->assertEquals($this->engine->stampToHour($stamp),13);
    }
    function testStampToDay() {
        $stamp = mktime(13,30,45,10,15,2003);
        $this->assertEquals($this->engine->stampToDay($stamp),15);
    }
    function testStampToMonth() {
        $stamp = mktime(13,30,45,10,15,2003);
        $this->assertEquals($this->engine->stampToMonth($stamp),10);
    }
    function testStampToYear() {
        $stamp = mktime(13,30,45,10,15,2003);
        $this->assertEquals($this->engine->stampToYear($stamp),2003);
    }
    function testIsToday() {
        $stamp = mktime();
        $this->assertTrue($this->engine->isToday($stamp));
        $stamp += 1000000000;
        $this->assertFalse($this->engine->isToday($stamp));
    }
}
