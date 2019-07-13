<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\GoogleTranslate;
use Zend\Http\Request;
use Application\Form\TranslateForm;
use Zend\Session\Container;

class IndexController extends AbstractActionController
{
    protected $session;

    public function __construct()
    {
        $this->session = new Container('user');
        $this->session();
    }

    public function indexAction()
    {
        
        $translateForm = new TranslateForm();
        if ($this->getRequest()->isPost()) {
            $data = $this->params->fromPost();
        }
        return new ViewModel([
            'form' => $translateForm,
            'heart' => $this->session['heart'],
            'user' => $this->session['username'],
        ]);
    }

    private function session()
    {
        if ($this->session['username'] == null) {
            # code...
            $this->session->offsetSet('username', md5(rand()));
            $this->session->offsetSet('heart', 0);
        }
        return $this->session;
    }

    public function unsetAction()
    {
        $this->session->offsetUnset('username');
        $this->session->offsetUnset('heart');
        
        return $this->redirect()->toUrl('/'); 
    }

    public function resultAction()
    {
        if ($this->session['heart'] <=> 3 && $this->getRequest()->isPost()) {
            # code...
            $google = new GoogleTranslate;
            $translatedText = $google->TranslateTextToTargetAutoDetection($this->params()->fromPost()['source'],$this->params()->fromPost()['desLang']);
            $this->session['heart'] += 1;
            return new ViewModel([
                'result' => $translatedText,
                'data' => $this->params()->fromPost(),
            ]);
        }
        return $this->redirect()->toUrl('/application/limit'); 
    }

    public function limitAction()
    {

        return new ViewModel([
            'heart' => $this->session['heart'],
        ]);
    }
}
