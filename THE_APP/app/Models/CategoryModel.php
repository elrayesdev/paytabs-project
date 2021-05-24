<?php

namespace App\Models;

use CodeIgniter\Model;

Class CategoryModel extends Model{

    protected $table = 'category';
    protected $primaryKey = 'id';

    public static function getByParentID($id=null){
        if ($id == "0")
            $id = null;
        $model = new CategoryModel();
        $all = $model->where([
            'parent_categoryId' => $id]
        )->findAll();
        return $all;
    }


}