<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_menuadmin extends BASE_Model
{
    protected $schema   = 'ambapers';
    protected $table    = 'menu_admin';
    protected $keys     = 'id';
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function getMenu($idrole) 
    {
        #dependcy model
        $this->load->model('model_group', 'group');

        #group
        $group  = $this->group->getData($idrole);

        #menu access
        $access = json_decode($group['access']);

        $sql    = " SELECT *
                    FROM menu_admin a
                    where id in ('". implode("','", $access) ."')
                    or level = 1
                    ORDER BY LEVEL DESC, ordered ASC";

        $menus  = $this->db->query($sql)->result_array();

        $a_data = array();
        $a_tree = array();
        $key = $parent = null;
        foreach( $menus as $row )
        {
            $a_data[$row['id']]['id']       = $row['id'];
            $a_data[$row['id']]['name']     = $row['name'];
            $a_data[$row['id']]['alias']    = $row['alias'];
            $a_data[$row['id']]['link']     = $row['link'];
            $a_data[$row['id']]['alias']    = $row['alias'];
            $a_data[$row['id']]['icon']     = $row['icon'];
            $a_data[$row['id']]['level']    = $row['level'];
            $a_data[$row['id']]['count']    += 1;

            $a_data[$row['parent']]['count']  += $a_data[$row['id']]['count'];

            $a_tree[$row['level']][$row['parent']][$row['id']] = $row['id'];

            $key    = $row['id'];
            $parent = $row['parent'];
        }

        $result['data'] = $a_data;
        $result['tree'] = $a_tree;

        return $result;
    }
}

?>
