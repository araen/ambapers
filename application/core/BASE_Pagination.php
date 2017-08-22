<?php
require_once( BASEPATH . 'libraries/Pagination.php' );

class BASE_Pagination extends CI_Pagination 
{
    public $pagingtag = array(
            'full_tag_open'      => '<ul class="pagination" style="margin:0; padding:0">',
            'full_tag_close'     => '</ul>',
            'first_link'         => 'First',
            'first_tag_open'     => '<li class="paginate_button active">',
            'first_tag_close'    => '</li>',
            'last_link'          => 'Last',
            'last_tag_open'      => '<li>',
            'last_tag_close'     => '</li>',
            'next_link'          => 'Next',
            'next_tag_open'      => '<li class="paginate_button next" id="example1_next">',
            'next_tag_close'     => '</li>',
            'prev_link'          => 'Prev',
            'prev_tag_open'      => '<li class="paginate_button previous disabled" id="example1_previous">',
            'prev_tag_close'     => '</li>',
            'cur_tag_open'       => '<li class="paginate_button active"><a href="#" aria-controls="example1">',
            'cur_tag_close'      => '</a></li>',
            'num_tag_open'       => '<li>',
            'num_tag_close'      => '</li>',            
        );
        
    /**
     * Initialize Preferences
     *
     * @access public
     * @param Array initialization parameters
     * @return void 
     * @override 
     */
    public function initialize($params = array())
    {
        $params = array_merge($params, $this->pagingtag);
        
        parent::initialize($params);
    }                    
}
?>
