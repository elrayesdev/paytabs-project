<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\Request;

class Category extends BaseController
{

    public function selector(){
        $data['categories'] = CategoryModel::getByParentID();

        return view('select_category', $data);
    }
    public function parent($id=null){

        $data['categories'] = CategoryModel::getByParentID($id);

        die(json_encode($data['categories']));

    }

}
