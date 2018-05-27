<?php
/**
 * Like Plugin
 *
 * @copyright  Copyright (c) 2014 skylzl (http://www.woyoudian.com)
 * @license    GNU General Public License 2.0
 * 
 */

class Like_Action extends Typecho_Widget implements Widget_Interface_Do
{
    private $db;

    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->db = Typecho_Db::get();        
    }
    
    /**
     * 点赞Like
     */
    public function up(){
        $cid=$this->request->filter('int')->cid;
        if($cid){
            try {
				$likesNum = Typecho_Cookie::get('__te_like');
				if(empty($likesNum)){
					$likesNum = array();
				}else{
					$likesNum = explode(',', $likesNum);
				}
				if(!in_array($cid,$likesNum)){
					$row = $this->db->fetchRow($this->db->select('likesNum')->from('table.contents')->where('cid = ?', $cid));
					$this->db->query($this->db->update('table.contents')->rows(array('likesNum' => (int)$row['likesNum']+1))->where('cid = ?', $cid));
					array_push($likesNum, $cid);
					$likesNum = implode(',', $likesNum);
					Typecho_Cookie::set('__te_like', $likesNum); //记录到cookie
					$this->response->throwJson("success");
				}
            } catch (Exception $ex) {
				echo $ex->getCode(); 
            }
        }  else {
            echo "error";
        }
      
    }

    public function action(){
        $this->on($this->request->is('up'))->up();
        $this->response->goBack();
    }
}
?>
