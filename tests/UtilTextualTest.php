<?php

require_once 'PEAR/Registry.php';
require_once 'MockCalendarTestCase.php';

if (! defined('CALENDAR_FIRST_DAY_OF_WEEK')) {
    define ('CALENDAR_FIRST_DAY_OF_WEEK', 1);
}

class UtilTextualTest extends MockCalendarTestCase
{
    function testMonthNamesLong() {
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
        $this->assertEquals($monthNames,Calendar_Util_Textual::monthNames());
    }
    function testMonthNamesShort() {
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
        $this->assertEquals($monthNames,Calendar_Util_Textual::monthNames('short'));
    }
    function testMonthNamesTwo() {
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
        $this->assertEquals($monthNames,Calendar_Util_Textual::monthNames('two'));
    }
    function testMonthNamesOne() {
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
        $this->assertEquals($monthNames,Calendar_Util_Textual::monthNames('one'));
    }
    function testWeekdayNamesLong() {
        $weekdayNames = array(
            0=>'Sunday',
            1=>'Monday',
            2=>'Tuesday',
            3=>'Wednesday',
            4=>'Thursday',
            5=>'Friday',
            6=>'Saturday',
        );
        $this->assertEquals($weekdayNames,Calendar_Util_Textual::weekdayNames());
    }
    function testWeekdayNamesShort() {
        $weekdayNames = array(
            0=>'Sun',
            1=>'Mon',
            2=>'Tue',
            3=>'Wed',
            4=>'Thu',
            5=>'Fri',
            6=>'Sat',
        );
        $this->assertEquals($weekdayNames,Calendar_Util_Textual::weekdayNames('short'));
    }
    function testWeekdayNamesTwo() {
        $weekdayNames = array(
            0=>'Su',
            1=>'Mo',
            2=>'Tu',
            3=>'We',
            4=>'Th',
            5=>'Fr',
            6=>'Sa',
        );
        $this->assertEquals($weekdayNames,Calendar_Util_Textual::weekdayNames('two'));
    }
    function testWeekdayNamesOne() {
        $weekdayNames = array(
            0=>'S',
            1=>'M',
            2=>'T',
            3=>'W',
            4=>'T',
            5=>'F',
            6=>'S',
        );
        $this->assertEquals($weekdayNames,Calendar_Util_Textual::weekdayNames('one'));
    }
    function testPrevMonthNameShort() {
        $this->assertEquals('Sep',Calendar_Util_Textual::prevMonthName($this->mockcal,'short'));
    }
    function testThisMonthNameShort() {
        $this->assertEquals('Oct',Calendar_Util_Textual::thisMonthName($this->mockcal,'short'));
    }
    function testNextMonthNameShort() {
        $this->assertEquals('Nov',Calendar_Util_Textual::nextMonthName($this->mockcal,'short'));
    }
    function testThisDayNameShort() {
        $reg = new PEAR_Registry;
        if (! $reg->packageExists('Date')) {
            $this->markTestSkipped("Depends on optional pear/Date");
        }

        $this->assertEquals('Wed',Calendar_Util_Textual::thisDayName($this->mockcal,'short'));
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
        $this->assertEquals($weekdayNames,Calendar_Util_Textual::orderedWeekdays($this->mockcal,'short'));
    }
}
