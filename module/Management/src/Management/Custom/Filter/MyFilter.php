<?php

namespace Management\Custom\Filter;

use Zend\Filter\FilterInterface;

class MyFilter implements FilterInterface{
	public function filter($value){
		// perform some transformation upon $value to arrive on $valueFiltered
		$value .= 'ABC';
		$valueFiltered = $value."ABC";
		return "Hello";
	}
}