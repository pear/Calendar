<?php

require_once 'PEAR/Registry.php';

class PearDateEngineTest extends PHPUnit_Framework_TestCase
{
    function setUp() {
        $reg = new PEAR_Registry;
        if (! $reg->packageExists('Date')) {
            $this->markTestSkipped("Depends on optional pear/Date");
        }
        $this->engine = new Calendar_Engine_PearDate();
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
        $this->assertEquals($this->engine->getMinYears(),0);
    }
    function testGetMaxYears() {
        $this->assertEquals($this->engine->getMaxYears(),9999);
    }
    function testDateToStamp() {
        $stamp = '2003-10-15 13:30:45';
        $this->assertEquals($this->engine->dateToStamp(2003,10,15,13,30,45),$stamp);
    }
    function testStampToSecond() {
        $stamp = '2003-10-15 13:30:45';
        $this->assertEquals($this->engine->stampToSecond($stamp),45);
    }
    function testStampToMinute() {
        $stamp = '2003-10-15 13:30:45';
        $this->assertEquals($this->engine->stampToMinute($stamp),30);
    }
    function testStampToHour() {
        $stamp = '2003-10-15 13:30:45';
        $this->assertEquals($this->engine->stampToHour($stamp),13);
    }
    function testStampToDay() {
        $stamp = '2003-10-15 13:30:45';
        $this->assertEquals($this->engine->stampToDay($stamp),15);
    }
    function testStampToMonth() {
        $stamp = '2003-10-15 13:30:45';
        $this->assertEquals($this->engine->stampToMonth($stamp),10);
    }
    function testStampToYear() {
        $stamp = '2003-10-15 13:30:45';
        $this->assertEquals($this->engine->stampToYear($stamp),2003);
    }
    function testAdjustDate() {
        $stamp = '2004-01-01 13:30:45';
        $y = $this->engine->stampToYear($stamp);
        $m = $this->engine->stampToMonth($stamp);
        $d = $this->engine->stampToDay($stamp);

        //the first day of the month should be thursday
        $this->assertEquals($this->engine->getDayOfWeek($y, $m, $d), 4);

        $m--; // 2004-00-01 => 2003-12-01
        $this->engine->adjustDate($y, $m, $d, $dummy, $dummy, $dummy);

        $this->assertEquals($y, 2003);
        $this->assertEquals($m, 12);
        $this->assertEquals($d, 1);

        // get last day and check if it's wednesday
        $d = $this->engine->getDaysInMonth($y, $m);

        $this->assertEquals($this->engine->getDayOfWeek($y, $m, $d), 3);
    }
    function testIsToday() {
        $stamp = date('Y-m-d H:i:s');
        $this->assertTrue($this->engine->isToday($stamp));
        $stamp = date('Y-m-d H:i:s', time() + 1000000000);
        $this->assertFalse($this->engine->isToday($stamp));
    }
}
