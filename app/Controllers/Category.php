<?php

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class  Category extends Controller
{

    public function index()
    {
        //view all main categories in main select box
        $model = new CategoryModel();
        helper('url');
        helper('form');
        $data['options'] = $model->get_categories();
        echo view('dropdown/index', $data);

    }

    function sub_categories($option_id)
    {
        $model = new CategoryModel();
        $model->option_id = $option_id;
        $suboptions = $model->sub_categories();
      //print select  for  sub category
        if (isset($suboptions) ) {
            echo "<select class=\"options\">";
            echo "<option value='' selected='selected'>-- Sub Category --</option>";

            foreach ($suboptions as $key => $value) {


                print " <option value=\"$key\"> $value</option> ";
            }
            echo "</select>";


        }
        else{echo '<label style="padding:7px;float:left; font-size:12px;">No Record Found !</label>';}
    }
}
?>