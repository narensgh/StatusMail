<?php
namespace Management\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable 
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}
	public function userSignUp(User $user)
	{
		$data = array(
				'username' => $user->username,
				'fullname'  => $user->fullname,
				'emailid' => $user->emailid,
				'password'  => $user->password,
		);
	
		$id = (int)$user->loginid;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getAlbum($id)) {
				$this->tableGateway->update($data, array('loginid' => $id));
			} else {
				throw new \Exception('Form id does not exist');
			}
		}
	}
	public function userSignIn($post)
	{
		if(!empty($post))
		{
			$rowset = $this->tableGateway->select(array('username' => $post['username'],'password' => md5($post['password'])));
			$row = $rowset->current();
			if (!$row) {
				$row ['error'] ="Invalid username";
			}
			return $row;
		}
	}
	
	public function deleteAlbum($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}
