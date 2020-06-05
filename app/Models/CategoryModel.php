<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    public $option_id = null;
    public $db=null;
    function __construct() {
        parent::__construct();
       $this->db= \Config\Database::connect();

    }
    public function get_categories(){

        $builder = $this->db->table('categories');
        $builder->select('category_id, category_name');
        $builder->where('parent_id', 0);

        $options = $builder->get()->getResult();

        $options_arr;

        $options_arr['#'] = '-- Please Select  Main Category --';

        // Format for passing into form_dropdown function

        foreach ($options as $option) {
            $options_arr[$option->category_id] = $option->category_name;
        }

        return $options_arr;
    }

    public function sub_categories(){

        if(!is_null($this->option_id)){

            $builder = $this->db->table('categories');
            $builder->select('category_id, category_name');


            $builder->where('parent_id', $this->option_id);

            $suboptions = $builder->get()->getResult();
            // if there are suboptinos for this option...
            if(count($suboptions) > 0){
                $suboptions_arr;
                // Format for passing into jQuery loop
                foreach ($suboptions as $suboption) {
                    $suboptions_arr[$suboption->category_id] = $suboption->category_name;
                }

                return $suboptions_arr;
            }
        }

        return;
    }
}