<?php
// $Id$

require_once('simple_include.php');
require_once('calendar_include.php');

require_once('./decorator_test.php');

class TestOfDecoratorUri extends TestOfDecorator {
    function TestOfDecoratorUri() {
        $this->UnitTestCase('Test of Calendar_Decorator_Uri');
    }
    function testFragments() {
        $Uri = new Calendar_Decorator_Uri($this->mockcal);
        $Uri->setFragments('year','month','day','hour','minute','second');
        $this->assertEqual('year=&month=&day=&hour=&minute=&second=',$Uri->this('second'));
    }
    function testScalarFragments() {
        $Uri = new Calendar_Decorator_Uri($this->mockcal);
        $Uri->setFragments('year','month','day','hour','minute','second');
        $Uri->setScalar();
        $this->assertEqual('&&&&&',$Uri->this('second'));
    }
    function testSetSeperator() {
        $Uri = new Calendar_Decorator_Uri($this->mockcal);
        $Uri->setFragments('year','month','day','hour','minute','second');
        $Uri->setSeparator('/');
        $this->assertEqual('year=/month=/day=/hour=/minute=/second=',$Uri->this('second'));
    }
}

if (!defined('TEST_RUNNING')) {
    define('TEST_RUNNING', true);
    $test = &new TestOfDecoratorUri();
    $test->run(new HtmlReporter());
}
?>