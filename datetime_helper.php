<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('validateDate') ) {
	
	/**
	 * checkdate — Validate a Gregorian date
	Parameters :
	month
	The month is between 1 and 12 inclusive.

	day
	The day is within the allowed number of days for the given month. Leap years are taken into consideration.

	year
	The year is between 1 and 32767 inclusive.

	 *
	 * @return void
	 * @author Ayatulloh Ahad R - ayatulloh@idprogrammer.com
	 **/
	
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

}