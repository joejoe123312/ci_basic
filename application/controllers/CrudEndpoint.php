<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CrudEndpoint extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function loadLibraryWithTable($table)
    {
        if (is_null($table)) throw new Exception("Table cannot be null!");

        $params['tableName'] = $table;
        $this->load->library('crud', $params);
    }

    // COMMAND MANIPULATION START

    public function create()
    {
        $this->loadLibraryWithTable($this->input->get('table'));
        echo json_encode($this->crud->Create());
    }

    public function update()
    {
        $this->loadLibraryWithTable($this->input->get('table'));
        echo json_encode($this->crud->Update());
    }

    public function Delete()
    {
        $this->loadLibraryWithTable($this->input->get('table'));
        echo json_encode($this->crud->Delete());
    }

    // COMMAND MANIPULATION END 

    public function GetAllForTable()
    {
        $this->loadLibraryWithTable($this->input->get('table'));
        echo $this->crud->GetAllForTable(true, ['id', 'credentials_id']);
    }

    public function GetWhereForTable()
    {
        $entityCondition = $this->input->get("entityWhere");
        $id = $this->input->get("id");

        $this->loadLibraryWithTable($this->input->get('table'));
        echo $this->crud->GetAllForTable(true, ['id', 'credentials_id']);
    }
}
