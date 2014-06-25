<?php

/**
 * Description of StatusService
 *
 * @author Narendra
 */
namespace Management\Service;

use Management\Form\SignUpFilter;
use Management\Model\Login;
use Management\Model\Status;
use Zend\_session\Container;

class StatusService extends Common{

	public function __construct($em){
		parent::__construct($em);
	}

	public function getUserReport($userId, $fromDate=null, $toDate=null){
		if (!$fromDate)
			$fromDate = date('Y-m-d', strtotime("-30 days",strtotime(date('Y-m-d'))));
		if (!$toDate)
			$toDate = date('Y-m-d', strtotime("+1 days",strtotime(date('Y-m-d'))));

		$modelStatus = new Status($this->_em, $this->_session);
		$reports = $modelStatus->getUserReportData($userId, $fromDate, $toDate);
		$reports = json_decode(json_encode($reports, true));
		$reportArr = array();
		foreach ($reports as $report){
			$statusId = $report->statusId;
			$reportDate = date('Y-m-d',strtotime($report->dateAdded->date));
			$reportArr[$reportDate]->report->$statusId = array(
						'status' => $report->status,
						'description'=> $report->description,
						'jiraTicketId'=>$report->task->jiraTicketId,
						'title'=>$report->task->title,
						'reportDate'=> $reportDate
					);
			$reportArr[$reportDate]->userId = $report->user->userId;
			$reportArr[$reportDate]->name = $report->user->firstName." ".$report->user->lastName;
		}
		return json_decode(json_encode($reportArr, true));
	}

	public function getAllReports(){
		$statusModel = new Status($this->_em, $this->_session);
		$allReports = $statusModel->fetchAllUsers();
		return $allReports;
	}

	public function saveStatus($postData){
		$modelStatus = new Status($this->_em, $this->_session);
		$response = $modelStatus->saveStatus($postData);
		return $response;
	}
}