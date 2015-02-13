<?php

namespace Management\Controller;

/**
 * Description of PmController
 *
 * @author narendra.singh
 */

use Zend\View\Model\JsonModel;
class PmController extends BaseController
{

    function __construct ()
    {
        parent::__construct();
    }

    public function homeAction ()
    {

    }
    public function testAction ()
    {

    }

    public function setsessionAction ()
    {
        $projectId = $this->params()->fromQuery('projectId');
        $this->session->projectId = $projectId;
        return new JsonModel(array('projectId' => $projectId));
    }
    public function getsessionAction()
    {
        $projectId = $this->session->projectId ;
        return new JsonModel(array('projectId' => $projectId));
    }

}
