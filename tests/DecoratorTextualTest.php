<?php

require_once 'PEAR/Registry.php';
require_once 'MockCalendarTestCase.php';

if (! defined('CALENDAR_FIRST_DAY_OF_WEEK')) {
    define ('CALENDAR_FIRST_DAY_OF_WEEK', 1);
}

class DecoratorTextualTest extends MockCalendarTestCase
{
    function testMonthNamesLong() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $monthNames = array(
            1=>'January',
            2=>'February',
            3=>'March',
            4=>'April',
            5=>'May',
            6=>'June',
            7=>'July',
            8=>'August',
            9=>'September',
            10=>'October',
            11=>'November',
            12=>'December',
        );
        $this->assertEquals($monthNames,$Textual->monthNames());
    }
    function testMonthNamesShort() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $monthNames = array(
            1=>'Jan',
            2=>'Feb',
            3=>'Mar',
            4=>'Apr',
            5=>'May',
            6=>'Jun',
            7=>'Jul',
            8=>'Aug',
            9=>'Sep',
            10=>'Oct',
            11=>'Nov',
            12=>'Dec',
        );
        $this->assertEquals($monthNames,$Textual->monthNames('short'));
    }
    function testMonthNamesTwo() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $monthNames = array(
            1=>'Ja',
            2=>'Fe',
            3=>'Ma',
            4=>'Ap',
            5=>'Ma',
            6=>'Ju',
            7=>'Ju',
            8=>'Au',
            9=>'Se',
            10=>'Oc',
            11=>'No',
            12=>'De',
        );
        $this->assertEquals($monthNames,$Textual->monthNames('two'));
    }
    function testMonthNamesOne() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $monthNames = array(
            1=>'J',
            2=>'F',
            3=>'M',
            4=>'A',
            5=>'M',
            6=>'J',
            7=>'J',
            8=>'A',
            9=>'S',
            10=>'O',
            11=>'N',
            12=>'D',
        );
        $this->assertEquals($monthNames,$Textual->monthNames('one'));
    }
    function testWeekdayNamesLong() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $weekdayNames = array(
            0=>'Sunday',
            1=>'Monday',
            2=>'Tuesday',
            3=>'Wednesday',
            4=>'Thursday',
            5=>'Friday',
            6=>'Saturday',
        );
        $this->assertEquals($weekdayNames,$Textual->weekdayNames());
    }
    function testWeekdayNamesShort() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $weekdayNames = array(
            0=>'Sun',
            1=>'Mon',
            2=>'Tue',
            3=>'Wed',
            4=>'Thu',
            5=>'Fri',
            6=>'Sat',
        );
        $this->assertEquals($weekdayNames,$Textual->weekdayNames('short'));
    }
    function testWeekdayNamesTwo() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $weekdayNames = array(
            0=>'Su',
            1=>'Mo',
            2=>'Tu',
            3=>'We',
            4=>'Th',
            5=>'Fr',
            6=>'Sa',
        );
        $this->assertEquals($weekdayNames,$Textual->weekdayNames('two'));
    }
    function testWeekdayNamesOne() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $weekdayNames = array(
            0=>'S',
            1=>'M',
            2=>'T',
            3=>'W',
            4=>'T',
            5=>'F',
            6=>'S',
        );
        $this->assertEquals($weekdayNames,$Textual->weekdayNames('one'));
    }
    function testPrevMonthNameShort() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $this->assertEquals('Sep',$Textual->prevMonthName('short'));
    }
    function testThisMonthNameShort() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $this->assertEquals('Oct',$Textual->thisMonthName('short'));
    }
    function testNextMonthNameShort() {
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $this->assertEquals('Nov',$Textual->nextMonthName('short'));
    }
    function testThisDayNameShort() {
        $reg = new PEAR_Registry;
        if (! $reg->packageExists('Date')) {
            $this->markTestSkipped("Depends on optional pear/Date");
        }

        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $this->assertEquals('Wed',$Textual->thisDayName('short'));
    }
    function testOrderedWeekdaysShort() {
        $weekdayNames = array(
            0=>'Sun',
            1=>'Mon',
            2=>'Tue',
            3=>'Wed',
            4=>'Thu',
            5=>'Fri',
            6=>'Sat',
        );
        $nShifts = CALENDAR_FIRST_DAY_OF_WEEK;
        while ($nShifts-- > 0) {
            $day = array_shift($weekdayNames);
            array_push($weekdayNames, $day);
        }
        $Textual = new Calendar_Decorator_Textual($this->mockcal);
        $this->assertEquals($weekdayNames,$Textual->orderedWeekdays('short'));
    }
}
