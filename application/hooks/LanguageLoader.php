<?php

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        #parr($ci);
        //$ci->load->helper('language');
        $site_lang = $ci->session->userdata('site_lang');

        if ($site_lang) {
            $ci->lang->load('main',$site_lang);
            $ci->config->set_item('language', $site_lang);
        } else {
            $ci->lang->load('main',$site_lang);
        }
    }
}
?>