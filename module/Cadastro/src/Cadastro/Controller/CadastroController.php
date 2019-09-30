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
        return new ViewModel(array(
            'pessoas' => $this->getEntityManager()->getRepository('\Cadastro\Entity\Cadastro')->findAll(),
        ));
    }
 
    public function addAction()
    {
        $form = new CadastroForm();
        $form->get('submit')->setValue('Add');
 
        $request = $this->getRequest();

        if ($request->isPost()) 
        {
            $cadastro = new Album();
            $form->setInputFilter($cadastro->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) 
            {
                $cadastro->exchangeArray($form->getData());
                $this->getEntityManager()->persist($cadastro);
                $this->getEntityManager()->flush();
 
                // Redirect to list of albums
                return $this->redirect()->toRoute('cadastro');
            }
        }

        return array('form' => $form); 
    }
 
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if (!$id) 
        {
            return $this->redirect()->toRoute('cadastro', array(
                'action' => 'add'
            ));
        }
 
        $album = $this->getEntityManager()->find('Cadastro\Entity\Cadastro', $id);
        
        if (!$cadastro) 
        {
            return $this->redirect()->toRoute('cadastro', array(
                'action' => 'index'
            ));
        }
 
        $form  = new CadastroForm();
        $form->bind($cadastro);
        $form->get('submit')->setAttribute('value', 'Edit');
 
        $request = $this->getRequest();

        if ($request->isPost()) 
        {
            $form->setInputFilter($cadastro->getInputFilter());
            $form->setData($request->getPost());
 
            if ($form->isValid()) 
            {
                $this->getEntityManager()->flush();
 
                // Redirect to list of albums
                return $this->redirect()->toRoute('cadastro');
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
            return $this->redirect()->toRoute('cadastro');
        }
 
        $request = $this->getRequest();

        if ($request->isPost()) 
        {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') 
            {
                $id = (int) $request->getPost('id');
                $cadastro = $this->getEntityManager()->find('Cadastro\Entity\Cadastro', $id);
                
                if ($cadastro) 
                {
                    $this->getEntityManager()->remove($cadastro);
                    $this->getEntityManager()->flush();
                }
            }
 
            // Redirect to list of albums
            return $this->redirect()->toRoute('cadastro');
        }
 
        return array(
            'id'    => $id,
            'cadastro' => $this->getEntityManager()->find('Cadastro\Entity\Cadastro', $id)
        );
    }
}