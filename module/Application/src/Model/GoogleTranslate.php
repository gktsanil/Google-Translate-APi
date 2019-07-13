<?php

namespace Application\Model;

use Google\Cloud\Translate\TranslateClient;

class GoogleTranslate
{

    protected $key = 'AIzaSyD7iZUyuvC4u18FpJTY2EYYrmiNV4HiWR0';
    protected $translate;

    public function __construct()
    {
        $this->translate = new TranslateClient([
            'key' => $this->key
        ]);
    }

    public function GetAllLanguageByTargetLanguage($target) : array
    {
        $languages = $this->translate->localizedLanguages([
            'target' => $target
        ]);

        return $languages;
    }

    public function GetAllLanguageCodeSupported() : array
    {
        $languages = $this->translate->languages();

        return $languages;
    }

    public function DetectLanguageByText($input) : array
    {
        $result = $this->translate->detectLanguage($input);
        return $result;
    }
    
    public function TranslateTextToTargetAutoDetection($input, $target) : array
    {
        $result = $this->translate->translate($input, [
            'target' => $target
        ]);

        return $result;
    }

}