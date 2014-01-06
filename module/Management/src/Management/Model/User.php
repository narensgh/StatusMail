<?php
namespace Management\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User implements InputFilterAwareInterface
{
	public $username;
	public $fullname;
	public $emailid;
	public $password;
	public $loginid;
	protected $inputFilter;
	public function exchangeArray($data)
	{
		$this->username = (!empty($data['username'])) ? $data['username'] : null;
		$this->fullname = (!empty($data['fullname'])) ? $data['fullname'] : null;
		$this->emailid  = (!empty($data['emailid'])) ? $data['emailid'] : null;
		$this->password  = (!empty($data['password'])) ? md5($data['password']) : null;
	}
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();	
			$inputFilter->add(array(
					'name'     => 'fullname',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
	
			$inputFilter->add(array(
					'name'     => 'emailid',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
			$inputFilter->add(array(
					'name'     => 'username',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
			$inputFilter->add(array(
					'name'     => 'password',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 6,
											'max'      => 10,
									),
							),
					),
			));
	
			$this->inputFilter = $inputFilter;
		}	
		return $this->inputFilter;
	}	
}
