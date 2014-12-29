<?php

require_once 'MockCalendarTestCase.php';

class DecoratorTest extends MockCalendarTestCase
{
    function testPrevYear() {
        $this->mockcal->expects($this->once())
                      ->method('prevYear')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(2002,$Decorator->prevYear());
    }
    function testThisYear() {
        $this->mockcal->expects($this->once())
                      ->method('thisYear')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(2003,$Decorator->thisYear());
    }
    function testNextYear() {
        $this->mockcal->expects($this->once())
                      ->method('nextYear')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(2004,$Decorator->nextYear());
    }
    function testPrevMonth() {
        $this->mockcal->expects($this->once())
                      ->method('prevMonth')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(9,$Decorator->prevMonth());
    }
    function testThisMonth() {
        $this->mockcal->expects($this->once())
                      ->method('thisMonth')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(10,$Decorator->thisMonth());
    }
    function testNextMonth() {
        $this->mockcal->expects($this->once())
                      ->method('nextMonth')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(11,$Decorator->nextMonth());
    }
    function testPrevWeek() {
        $mockweek = $this->getMockBuilder('Calendar_Week')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockweek->method('prevWeek')->willReturn(1);
        $mockweek->expects($this->once())
                 ->method('prevWeek')
                 ->with($this->equalTo('n_in_month'));
        $Decorator = new Calendar_Decorator($mockweek);
        $this->assertEquals(1,$Decorator->prevWeek());
    }
    
    function testThisWeek() {
        $mockweek = $this->getMockBuilder('Calendar_Week')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockweek->method('thisWeek')->willReturn(2);
        $mockweek->expects($this->once())
                 ->method('thisWeek')
                 ->with($this->equalTo('n_in_month'));
        $Decorator = new Calendar_Decorator($mockweek);
        $this->assertEquals(2,$Decorator->thisWeek());
    }
    function testNextWeek() {
        $mockweek = $this->getMockBuilder('Calendar_Week')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockweek->method('nextWeek')->willReturn(3);
        $mockweek->expects($this->once())
                 ->method('nextWeek')
                 ->with($this->equalTo('n_in_month'));
        $Decorator = new Calendar_Decorator($mockweek);
        $this->assertEquals(3,$Decorator->nextWeek());
    }

    function testPrevDay() {
        $this->mockcal->expects($this->once())
                      ->method('prevDay')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(14,$Decorator->prevDay());
    }
    function testThisDay() {
        $this->mockcal->expects($this->once())
                      ->method('thisDay')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(15,$Decorator->thisDay());
    }
    function testNextDay() {
        $this->mockcal->expects($this->once())
                      ->method('nextDay')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(16,$Decorator->nextDay());
    }
    function testPrevHour() {
        $this->mockcal->expects($this->once())
                      ->method('prevHour')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(12,$Decorator->prevHour());
    }
    function testThisHour() {
        $this->mockcal->expects($this->once())
                      ->method('thisHour')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(13,$Decorator->thisHour());
    }
    function testNextHour() {
        $this->mockcal->expects($this->once())
                      ->method('nextHour')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(14,$Decorator->nextHour());
    }
    function testPrevMinute() {
        $this->mockcal->expects($this->once())
                      ->method('prevMinute')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(29,$Decorator->prevMinute());
    }
    function testThisMinute() {
        $this->mockcal->expects($this->once())
                      ->method('thisMinute')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(30,$Decorator->thisMinute());
    }
    function testNextMinute() {
        $this->mockcal->expects($this->once())
                      ->method('nextMinute')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(31,$Decorator->nextMinute());
    }
    function testPrevSecond() {
        $this->mockcal->expects($this->once())
                      ->method('prevSecond')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(44,$Decorator->prevSecond());
    }
    function testThisSecond() {
        $this->mockcal->expects($this->once())
                      ->method('thisSecond')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(45,$Decorator->thisSecond());
    }
    function testNextSecond() {
        $this->mockcal->expects($this->once())
                      ->method('nextSecond')
                      ->with($this->equalTo('int'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(46,$Decorator->nextSecond());
    }
    function testGetEngine() {
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertInstanceOf('Calendar_Engine_Interface', $Decorator->getEngine());
    }
    function testSetTimestamp() {
        $this->mockcal->expects($this->once())
                      ->method('setTimestamp')
                      ->with($this->equalTo('12345'));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $Decorator->setTimestamp('12345');
    }
    function testGetTimestamp() {
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals(12345,$Decorator->getTimestamp());
    }
    function testSetSelected() {
        $this->mockcal->expects($this->once())
                      ->method('setSelected')
                      ->with($this->equalTo(true));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $Decorator->setSelected();
    }
    function testIsSelected() {
        $this->mockcal->method('isSelected')->willReturn(true);
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertTrue($Decorator->isSelected());
    }
    function testAdjust() {
        $this->mockcal->expects($this->once())
                      ->method('adjust');
        $Decorator = new Calendar_Decorator($this->mockcal);
        $Decorator->adjust();
    }
    function testToArray() {
        $testArray = array('foo'=>'bar');
        $this->mockcal->method('toArray')->willReturn($testArray);
        $this->mockcal->expects($this->once())
                      ->method('toArray')
                      ->with($this->equalTo(12345));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals($testArray,$Decorator->toArray(12345));
    }
    function testReturnValue() {
        $this->mockcal->method('returnValue')->willReturn('foo');
        $this->mockcal->expects($this->once())
                      ->method('returnValue')
                      ->with(
                        $this->equalTo('a'),
                        $this->equalTo('b'),
                        $this->equalTo('c'),
                        $this->equalTo('d')
                      );
        $Decorator = new Calendar_Decorator($this->mockcal);
        $this->assertEquals('foo',$Decorator->returnValue('a','b','c','d'));
    }
    function testSetFirst() {
        $mockday = $this->getMockBuilder('Calendar_Day')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockday->expects($this->once())
                ->method('setFirst')
                ->with($this->equalTo(true));
        $Decorator = new Calendar_Decorator($mockday);
        $Decorator->setFirst();
    }
    function testSetLast() {
        $mockday = $this->getMockBuilder('Calendar_Day')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockday->expects($this->once())
                ->method('setLast')
                ->with($this->equalTo(true));
        $Decorator = new Calendar_Decorator($mockday);
        $Decorator->setLast();
    }
    function testIsFirst() {
        $mockday = $this->getMockBuilder('Calendar_Day')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockday->method('isFirst')->willReturn(true);
        $Decorator =& new Calendar_Decorator($mockday);
        $this->assertTrue($Decorator->isFirst());
    }
    function testIsLast() {
        $mockday = $this->getMockBuilder('Calendar_Day')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockday->method('isLast')->willReturn(true);
        $Decorator = new Calendar_Decorator($mockday);
        $this->assertTrue($Decorator->isLast());
    }
    function testSetEmpty() {
        $mockday = $this->getMockBuilder('Calendar_Day')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockday->expects($this->once())
                ->method('setEmpty')
                ->with($this->equalTo(true));
        $Decorator = new Calendar_Decorator($mockday);
        $Decorator->setEmpty();
    }
    function testIsEmpty() {
        $mockday = $this->getMockBuilder('Calendar_Day')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockday->method('isEmpty')->willReturn(true);
        $Decorator = new Calendar_Decorator($mockday);
        $this->assertTrue($Decorator->isEmpty());
    }
    function testBuild() {
        $testArray=array('foo'=>'bar');
        $this->mockcal->expects($this->once())
                      ->method('build')
                      ->with($this->equalTo($testArray));
        $Decorator = new Calendar_Decorator($this->mockcal);
        $Decorator->build($testArray);
    }
    function testFetch() {
        $this->mockcal->expects($this->once())
                      ->method('fetch');
        $Decorator = new Calendar_Decorator($this->mockcal);
        $Decorator->fetch();
    }
    function testFetchAll() {
        $this->mockcal->expects($this->once())
                      ->method('fetchAll');
        $Decorator = new Calendar_Decorator($this->mockcal);
        $Decorator->fetchAll();
    }
    function testSize() {
        $this->mockcal->expects($this->once())
                      ->method('size');
        $Decorator = new Calendar_Decorator($this->mockcal);
        $Decorator->size();
    }
    function testIsValid() {
        $this->mockcal->expects($this->once())
                      ->method('isValid');
        $Decorator = new Calendar_Decorator($this->mockcal);
        $Decorator->isValid();
    }
    function testGetValidator() {
        $this->mockcal->expects($this->once())
                      ->method('getValidator');
        $Decorator = new Calendar_Decorator($this->mockcal);
        $Decorator->getValidator();
    }
}
