<?php
defined('BASEPATH') or die('error');


class Language extends MY_Controller
{
	public function switchLanguage($language = "")
	{
		$langs = ['geo','eng'];
        
        if (in_array($language,$langs)) {
        	$language = ($language != "") ? $language : "eng";
            $this->session->set_userdata('site_lang', $language);
        
        }
        if (!empty($this->agent->referrer())) {
            redirect($this->agent->referrer());
        } else {
        	redirect(base_url());
        }
        
    }
}
?>