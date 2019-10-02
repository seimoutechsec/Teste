<?php
 
namespace Pessoa\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pessoa\Entity\Pessoa;
use Pessoa\Form\PessoaForm;
use Doctrine\ORM\EntityManager;
 
class PessoaController extends AbstractActionController
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
        return new ViewModel(array(            
            'pessoas' => $this->getEntityManager()->getRepository('\Pessoa\Entity\Pessoa')->findAll(),                     
        ));
    }
 
    public function addAction()
    {
        $form = new PessoaForm();
        $form->get('submit')->setValue('Add');
 
        $request = $this->getRequest();

        if ($request->isPost()) 
        {
            $pessoa = new Pessoa();
            $form->setInputFilter($pessoa->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) 
            {
                $pessoa->exchangeArray($form->getData());
                $this->getEntityManager()->persist($pessoa);
                $this->getEntityManager()->flush();
 
                // Redirect to list of pessoas
                return $this->redirect()->toRoute('pessoa');
            }
        }

        return array('form' => $form); 
    }
 
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if (!$id) 
        {
            return $this->redirect()->toRoute('pessoa', array(
                'action' => 'add'
            ));
        }
 
        $pessoa = $this->getEntityManager()->find('Pessoa\Entity\Pesssoa', $id);
        
        if (!$pessoa) 
        {
            return $this->redirect()->toRoute('pessoa', array(
                'action' => 'index'
            ));
        }
 
        $form  = new PessoaForm();
        $form->bind($pessoa);
        $form->get('submit')->setAttribute('value', 'Edit');
 
        $request = $this->getRequest();

        if ($request->isPost()) 
        {
            $form->setInputFilter($pessoa->getInputFilter());
            $form->setData($request->getPost());
 
            if ($form->isValid()) 
            {
                $this->getEntityManager()->flush();
 
                // Redirect to list of pessoas
                return $this->redirect()->toRoute('pessoa');
            }
        }
 
        return array(
            'id' => $id,
            'form' => $form,
        );
    }
 
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) 
        {
            return $this->redirect()->toRoute('pessoa');
        }
 
        $request = $this->getRequest();

        if ($request->isPost()) 
        {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') 
            {
                $id = (int) $request->getPost('id');
                $pessoa = $this->getEntityManager()->find('Pessoa\Entity\Pessoa', $id);
                
                if ($pessoa) 
                {
                    $this->getEntityManager()->remove($pessoa);
                    $this->getEntityManager()->flush();
                }
            }
 
            // Redirect to list of albums
            return $this->redirect()->toRoute('pessoa');
        }
 
        return array(
            'id'    => $id,
            'pessoas' => $this->getEntityManager()->find('Pessoa\Entity\Pessoa', $id)
        );
    }
}