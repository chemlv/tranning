<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Backend\Model\User;
use Backend\Model\UserTable;
class UserManagerController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function editAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new User);
        $tableGateway       = new \Zend\Db\TableGateway\TableGateway('user' /* table name  */, $dbAdapter, null, $resultSetPrototype);
        $userTable = new UserTable($tableGateway);
        $rs = $userTable->getUser($id);
        return new ViewModel(array('id'=>$id,'rs'=>$rs));
    }
}
