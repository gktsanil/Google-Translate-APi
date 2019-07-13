<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Elements;
use Application\Model\GoogleTranslate;

class TranslateForm extends Form
{

    protected $google;

    public function __construct()
    {
        parent::__construct($name = null);
        $this->setAttribute('method', 'POST');
        $this->setAttribute('action', 'application/result');
        $this->google = new GoogleTranslate;        

        $languages = [];

        foreach ($this->google->GetAllLanguageByTargetLanguage('tr') as $key) {
            $languages[$key['code']] = $key['name'];
        }

        $this->add([
            'name' => 'desLang',
            'type' => 'select',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'desLang',
                'required' => true,
            ],
            'options' => [
                'label' => 'Hedef Dil',
                'empty_option' => 'Hedef Dil Seçiniz',
                'value_options' => $languages,
            ]
        ]);
        $this->add([
            'name' => 'source',
            'type' => 'textarea',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'source',
                'onkeyup' => 'saveValue()',
                'required' => true,
            ],
            'options' => [
                'label' => 'Metin Giriniz'
            ]
        ]);
        $this->add([
            'name' => 'search',
            'type' => 'text',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'search',
                'onkeyup' => 'getValue()'
            ],
            'options' => [
                'label' => 'Aranacak Kelime'
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'class' => 'btn btn-block btn-primary',
                'id' => 'submitBtn',
                'value' => 'Çevir'
            ]
        ]);
    }
}