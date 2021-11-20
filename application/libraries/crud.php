<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud
{
    private $CI;
    private $table;

    public function __construct($params)
    {
        $this->table = $params['tableName'];

        $this->CI = &get_instance();
        $this->CI->load->model("Main_model");
        $this->CI->load->library("form_validation");
    }

    // COMMAND MANIPULATION START

    public function Create()
    {
        $returnAssoc['success'] = true;
        $returnAssoc['data'] = null;

        // form validation
        foreach ($_POST as $key => $value) {
            if ($value == null) {
                $returnAssoc['success'] = false;
                return $returnAssoc;
            }

            $insert[$key] = $value;
        }

        $id = $this->CI->Main_model->_insert($this->table, $insert);

        $returnAssoc['data'] = ["id" => $id]; // primary key of the created row in db
        return $returnAssoc;
    }

    public function Update()
    {
        $returnAssoc['success'] = true;
        $returnAssoc['data'] = null;

        // form validation
        foreach ($_POST as $key => $value) {
            if ($value == null) {
                $returnAssoc['success'] = false;
                return $returnAssoc;
            }

            $update[$key] = $value;
        }

        $id = $this->CI->Main_model->_update($this->table, "id", $update['id'], $update);

        $returnAssoc['data'] = ["id" => $id]; // primary key of the created row in db
        return $returnAssoc;
    }

    public function Delete()
    {
        $this->CI->Main_model->_delete($this->table, "id", $_POST['id']);
    }

    // COMMAND MANIPULATION END

    /*
     SUMMARY: Will get all of the rows of the specified table
     PARAMS:    hasActions(bool) will determine if the returned html string would have edit and delete button
                excludedEntites(indexed array) Array of entities(string) where every element would inhibit the creation of td tag
    */
    public function GetAllForTable($hasActions, $excludedEntites)
    {
        $result = $this->CI->Main_model->get($this->table, "id");

        $trHtmlString = "";
        $counter = 0;
        foreach ($result->result() as $entites) {
            $counter++;

            $trHtmlString .= '<tr>';

            $trHtmlString .= '<td>' . $counter . '</td>';

            foreach ($entites as $key => $value) {
                if (in_array($key, $excludedEntites)) continue;

                $trHtmlString .= '<td>' . $value . '</td>';
            }

            if ($hasActions) {
                $trHtmlString .= '
                    <td>
                    <button class="" value="' . $entites->id . '">Edit</button>
                    <button class="" value="' . $entites->id . '">Delete</button>
                    </td>
                ';
            }
            $trHtmlString .= '</tr>';
        }

        return $trHtmlString;
    }

    public function GetWhereForTable($entityCondition, $id, $hasActions, $excludedEntites)
    {
        $result = $this->CI->Main_model->get_where($this->table, $entityCondition, $id);

        $trHtmlString = "";
        $counter = 0;
        foreach ($result->result() as $entites) {
            $counter++;

            $trHtmlString .= '<tr>';

            $trHtmlString .= '<td>' . $counter . '</td>';

            foreach ($entites as $key => $value) {
                if (in_array($key, $excludedEntites)) continue;

                $trHtmlString .= '<td>' . $value . '</td>';
            }

            if ($hasActions) {
                $trHtmlString .= '
                    <td>
                    <button class="" value="' . $entites->id . '">Edit</button>
                    <button class="" value="' . $entites->id . '">Delete</button>
                    </td>
                ';
            }
            $trHtmlString .= '</tr>';
        }

        return $trHtmlString;
    }

    public function GetAllForTableWithForeignKeys()
    {
    }
}
