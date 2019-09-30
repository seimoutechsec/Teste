<?php
 
namespace Cadastro\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cadastro\Entity\Cadastro;
use Cadastro\Form\CadastroForm;
use Doctrine\ORM\EntityManager;
 
class CadastroController extends AbstractActionController
{
    protected $em;
 
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
 
        return $this->em;
    }
 
    public function indexAction()
    {        
    }
 
    public function addAction()
    {
        
    }
 
    public function editAction()
    {
        
    }
 
    public function deleteAction()
    {
        
    }
}