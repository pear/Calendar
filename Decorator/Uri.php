<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Harry Fuecks <hfuecks@phppatterns.com>                      |
// |          Lorenzo Alberton <l dot alberton at quipo dot it>           |
// +----------------------------------------------------------------------+
//
// $Id$
//
/**
 * @package Calendar
 * @version $Id$
 */

/**
 * Allows Calendar include path to be redefined
 * @ignore
 */
if (!defined('CALENDAR_ROOT')) {
    define('CALENDAR_ROOT', 'Calendar'.DIRECTORY_SEPARATOR);
}

/**
 * Load Calendar decorator base class
 */
require_once CALENDAR_ROOT.'Decorator.php';

/**
 * Decorator to help with building HTML links for navigating the calendar<br />
 * <code>
 * $Day = new Calendar_Day(2003, 10, 23);
 * $Uri = & new Calendar_Decorator_Uri($Day);
 * $Uri->setFragments('year', 'month', 'day');
 * echo $Uri->getPrev(); // Displays year=2003&month=10&day=22
 * </code>
 * @package Calendar
 * @access public
 */
class Calendar_Decorator_Uri extends Calendar_Decorator
{
    /**
     * Uri fragments for year, month, day etc.
     * @var array
     * @access private
     */
    var $uris = array();

    /**
     * String to seperate fragments with
     * @var string
     * @access private
     */
    var $separator = '&';

    /**
     * To output a "scalar" string - variable names omitted
     * @var boolean
     * @access private
     */
    var $scalar = false;

    /**
     * Constructs Calendar_Decorator_Uri
     * @param object subclass of Calendar
     * @access public
     */
    function Calendar_Decorator_Uri(&$Calendar)
    {
        parent::Calendar_Decorator($Calendar);
    }

    /**
     * Sets the URI fragment names
     * @param string URI fragment for year
     * @param string (optional) URI fragment for month
     * @param string (optional) URI fragment for day
     * @param string (optional) URI fragment for hour
     * @param string (optional) URI fragment for minute
     * @param string (optional) URI fragment for second
     * @return void
     * @access public
     */
    function setFragments($y, $m=null, $d=null, $h=null, $i=null, $s=null) {
        if (!is_null($y)) $this->uris['Year']   = $y;
        if (!is_null($m)) $this->uris['Month']  = $m;
        if (!is_null($d)) $this->uris['Day']    = $d;
        if (!is_null($h)) $this->uris['Hour']   = $h;
        if (!is_null($i)) $this->uris['Minute'] = $i;
        if (!is_null($s)) $this->uris['Second'] = $s;
    }

    /**
     * Sets the separator string between fragments
     * @param string separator e.g. /
     * @return void
     * @access public
     */
    function setSeparator($separator)
    {
        $this->separator = $separator;
    }

    /**
     * Puts Uri decorator into "scalar mode" - URI variable names are not
     * returned
     * @param boolean (optional)
     * @return void
     * @access public
     */
    function setScalar($state=true)
    {
        $this->scalar = $state;
    }

    /**
     * Gets the URI string for the previous calendar unit
     * @param string calendar unit to fetch uri for (year,month,week or day etc)
     * @return string
     * @access public
     */
    function prev($method)
    {
        $method = 'prev'.$method;
        $stamp  = $this->{$method}('timestamp');
        return $this->buildUriString($method, $stamp);
    }

    /**
     * Gets the URI string for the current calendar unit
     * @param string calendar unit to fetch uri for (year,month,week or day etc)
     * @return string
     * @access public
     */
    function this($method)
    {
       $method = 'this'.$method;
        $stamp  = $this->{$method}('timestamp');
        return $this->buildUriString($method, $stamp);
    }

    /**
     * Gets the URI string for the next calendar unit
     * @param string calendar unit to fetch uri for (year,month,week or day etc)
     * @return string
     * @access public
     */
    function next($method)
    {
        $method = 'next'.$method;
        $stamp  = $this->{$method}('timestamp');
        return $this->buildUriString($method, $stamp);
    }

    /**
     * Build the URI string
     * @param string method substring
     * @param int timestamp
     * @return string build uri string
     * @access private
     */
    function buildUriString($method, $stamp)
    {
        $uriString = '';
        $cE = & $this->getEngine();
        $separator = '';
        foreach ($this->uris as $unit => $uri) {
            $call = 'stampTo'.$unit;
            $uriString .= $separator;
            if (!$this->scalar) $uriString .= $uri.'=';
            $uriString .= $cE->{$call}($stamp);
            $separator = $this->separator;
            if (strtolower($stamp) == strtolower($method)) {
                break;
            }
        }
        return $uriString;
    }
}
?>