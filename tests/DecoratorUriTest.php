<?php

require_once 'MockCalendarTestCase.php';

class DecoratorUriTest extends MockCalendarTestCase
{
    function testFragments() {
        $Uri = new Calendar_Decorator_Uri($this->mockcal);
        $Uri->setFragments('year','month','day','hour','minute','second');
        $this->assertEquals('year=&amp;month=&amp;day=&amp;hour=&amp;minute=&amp;second=',$Uri->this('second'));
    }
    function testScalarFragments() {
        $Uri = new Calendar_Decorator_Uri($this->mockcal);
        $Uri->setFragments('year','month','day','hour','minute','second');
        $Uri->setScalar();
        $this->assertEquals('&amp;&amp;&amp;&amp;&amp;',$Uri->this('second'));
    }
    function testSetSeperator() {
        $Uri = new Calendar_Decorator_Uri($this->mockcal);
        $Uri->setFragments('year','month','day','hour','minute','second');
        $Uri->setSeparator('/');
        $this->assertEquals('year=/month=/day=/hour=/minute=/second=',$Uri->this('second'));
    }
}
