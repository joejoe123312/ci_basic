<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_manipulation
{
    private $CI;

    public  $_viewName;
    public  $_pageTitle;
    public  $_renderedData;

    public function __construct($params)
    {
        $this->_viewName = $params['viewName'];
        $this->_pageTitle = $params['pageTitle'];
        $this->_renderedData = $params['renderedData'];

        $this->CI = &get_instance();
    }

    public function renderViewWithLayout()
    {
        $data['renderedView'] = $this->_viewName;
        $data['title'] = $this->_pageTitle;
        $data['renderedData'] = $this->_renderedData;

        // note: sa susunod dapat pinag sama mo na ito sa layout
        $this->CI->load->view("components/includes/header");
        $this->CI->load->view('_layout', $data);
    }
}

/* 
    IMPLEMENTATION:

    function index()
    {
        $params['viewName'] = 'MovingUp/index';
        $params['pageTitle'] = 'Manage students moving up';
        $params['renderedData'] = array();
    
        $this->load->library('view_manipulation', $params);
        $this->view_manipulation->renderViewWithLayout();
    }
*/