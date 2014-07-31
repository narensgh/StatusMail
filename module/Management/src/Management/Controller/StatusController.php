<?php

namespace Management\Controller;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatusController
 *
 * @author Narendra
 */

use Management\Form\StatusForm;
use Management\Service\StatusService;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use PHPMailer;
use Libs\ManageSession; 

class StatusController extends BaseController {

    private $_session;

    function __construct() {
        $this->_session = new Container('appl');
    }

    public function indexAction() {
        $statusForm = new StatusForm($this->getEntityManager());
        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            $statusForm->setData($post);
            if ($statusForm->isValid()) {
                $serviceStatus = new StatusService($this->getEntityManager());
                if ($post['submit'] == 'Save') {
                    $response = $serviceStatus->saveStatus($post);
                    $this->redirectTo($response);
                }
            }
        }
        return new ViewModel(array('statusForm' => $statusForm));
    }

    public function reportAction() {
        $serviceStatus = new StatusService($this->getEntityManager());
        $userReport = $serviceStatus->getUserReport($this->_session->userId);
        return new ViewModel(array('reportObj' => $userReport));
    }

    public function viewallreportAction() {
        $serviceStatus = new StatusService($this->getEntityManager());
        $teamLeadId = $this->_session->userId;
        $reports = $serviceStatus->getTeamMembers($teamLeadId);
        return new ViewModel(array('teamUser' => json_decode(json_encode($reports, true))));
    }

    public function getUserReportAction() {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $userReport = $this->processReport($request);
        } else {
            $serviceStatus = new StatusService($this->getEntityManager());
            $allParams = $this->params()->fromQuery();
            $userId = $allParams['userId'];
            $reportDate = $request->getPost('reportDate');
            $userReport = $serviceStatus->getUserReport($userId);
            echo "<pre>";
            print_r($userReport);
            exit;
        }
        return new JsonModel(array('userReport' => $userReport));
    }

    private function processReport($request) {
        $serviceStatus = new StatusService($this->getEntityManager());
        $userId = $request->getPost('userId');
        $curDate = $request->getPost('curDate');
        $dateRange = $request->getPost('dateRange');
        $fromDate = date('Y-m-d', strtotime("-" . $dateRange . " days", strtotime($curDate)));
        $userReport = $serviceStatus->getUserReport($userId, $fromDate, $curDate);
        return $userReport;
    }

    public function sendreportAction() {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $usersReport = $this->processReport($request);

            $reportData = '<div style="padding: 5px; width: 758px;color: #333333;font-family:Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857;" id="report_body">';
            foreach ($usersReport as $userReport) {
                $reportData .='<div style="border-bottom: 1px solid #DDDDDD; box-shadow: 0 0 3px rgba(0, 0, 0, 0.1); margin: 0 0 10px; padding: 10px;">';
                $reportData .='<dl style="border: 1px solid #EEEEEE; margin-bottom: 20px; margin-top: 0;">';
                $reportData .='	<dt style="width:100px;"></dt>
		<dd style="background: none repeat scroll 0 0 #EEEEEE; color: #333333; padding: 8px; text-align: right;  border-bottom: 1px dashed #EEEEEE; font-size: 11px; font-style: italic; font-weight: normal; margin: 0 0 14px;">
		<b style="float: left">Narendra Singh</b>2014-04-15</dd>';
                foreach ($userReport as $report) {

                    if (isset($report->report)) {
                        foreach ($report->report as $rep) {
                            $reportData .='<dt style="width:100px;clear: left; float: left; overflow: hidden; text-align: right; text-overflow: ellipsis; white-space: nowrap; line-height: 1.42857; font-weight: bold;">';
                            $reportData .='1. <a style="color: #428BCA" target="_blank"	href="http://jira.theorchard.com/browse/';
                            $reportData .=$rep->jiraTicketId;
                            $reportData .='">';
                            $reportData .= $rep->jiraTicketId;
                            $reportData .= '</a> : </dt><dd style="margin-left: 120px;">';
                            $reportData .= $rep->title;
                            $reportData .= '</dd><dt style="width:100px; clear: left; float: left; overflow: hidden; text-align: right; text-overflow: ellipsis; white-space: nowrap; line-height: 1.42857; font-weight: bold;">Status : </dt>
									<dd style="margin-left: 120px;">';
                            $reportData .= $rep->status;
                            $reportData .= '</dd><dt style="width:100px; clear: left; float: left; overflow: hidden; text-align: right; text-overflow: ellipsis; white-space: nowrap; line-height: 1.42857; font-weight: bold;"></dt>
									<dd style="margin-left: 120px;">';
                            $reportData .= $rep->description;
                            $reportData .='</dd>';
                        }
                    }
                }
                $reportData .='</dl></div>';
            }

            $reportData .='</div>';

            echo $reportData;
            die;
        }




        $config = $this->getServiceLocator()->get('config');
        $mailerSettings = $config['mailer'];
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = 'smtp';
        $mail->SMTPAuth = true;
        $mail->Username = $mailerSettings['username'];  // SMTP username
        $mail->Password = $mailerSettings['password'];
        ;
        $mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';

        $mail->IsHTML(true); // if you are going to send HTML formatted emails
        $mail->SingleTo = false; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.

        $mail->From = "notify@test.com";
        $mail->FromName = "notify";

        $mail->addAddress("narendra.singh@synergytechservices.com", "Narendra");
// 		$mail->addAddress("sonali.dhepse@synergytechservices.com","Sonali");
// 		$mail->addAddress("amruta.nevrekar@synergytechservices.com","Amruta");
        $mail->addAddress("sadhana.dhande@synergytechservices.com", "Sadhana");

        $mail->Subject = "Orchard API Status Updates of 30th April 2014";
        $mail->Body = $reportData;

        if (!$mail->Send())
            echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
        else
            echo "Message has been sent";

        die('done');

        echo $reportData;
        die;
    }

}

?>
