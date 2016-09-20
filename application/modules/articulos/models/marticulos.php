<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class marticulos extends CI_Model {

	public function __construct(){
		parent::__construct();
        $this->id_user = $this->dx_auth->getUserDomain();
		
	}
	
	public function savemypost($_datos){
		$datenow = date("Y-m-d h:i:s");
		$data = array(
			"id_user"=>$_datos["id_user"],
			"title"=>$_datos["title"],
			"item"=>$_datos["item"],
			"description"=>($_datos["description"] ? $_datos["description"] : $_datos["descritem"]),
			"price"=>htmlentities($_datos["price"]),
			"oldprice"=>htmlentities($_datos["oldprice"]),
			"id_imgitem"=>htmlentities($_datos["id_imgitem"]),
			"video"=>(isset($_datos["video"]) ? htmlentities($_datos["video"]) : ""),
			"stock"=>htmlentities($_datos["stock"]),
			"category"=>($_datos["category"] ? $_datos["category"] : $_datos["categoryNew"]),
			"registred_by"=>$_datos["id_user"],
			"registred_on"=>$datenow,
			);
		$data = $this->db->insert("items",$data);
		return $data;

	}
   public function updatePost($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "title"=>$_datos["title"],
         "description"=>htmlentities($_datos["description"]),
         "price"=>(isset($_datos["price"])?$_datos["price"]:""),
         "oldprice"=>(isset($_datos["oldprice"])?$_datos["oldprice"]:""),
         "stock"=>(isset($_datos["stock"])?$_datos["stock"]:""),
         "category"=>$_datos["category"],
         "video"=>(isset($_datos["video"]) ? htmlentities(strip_tags($_datos["video"],'<iframe>')) : ""),
         "updated_by"=>$_datos["id_user"],
         "updated_on"=>$datenow,
         );
      $this->db->where("id",decode_url($_datos["_w"]));
      $result = $this->db->update("mypost",$data);
      
      if(isset($_datos["id_imgpost"]))
      foreach ($_datos["id_imgpost"] as $k => $v) {
         if(!$this->get_imgExists(decode_url($v),decode_url($_datos["_w"]))){ //si la imagen no existe osea, es nueva, se inserta.
            $dataInsert=array("id_post"=>decode_url($_datos["_w"]));
            $this->db->where("id",decode_url($v));
            $this->db->update("img_post",$dataInsert);
         }
      }
      return array("id_post"=>decode_url($_datos["_w"]));;

   }
   public function delete_post($id){

      $this->db->where('id', $id);
      $this->db->delete('mypost');

   }   
   public function insert_img($name){
      $data = array( 'name' => $name);
      $this->db->insert('img_post', $data);
      return $this->db->insert_id();
   }
   public function delete_file($file_id){
      $file = $this->get_file($file_id);

      if (!$this->db->where('id', $file_id)->delete('img_post'))
      return FALSE;

      @unlink(FCPATH.'application/assets/application/img/post/post_'.$this->id_user["id"].'/'.$file->name);  
      return TRUE;
   }
   public function get_imgExists($file_id,$id_post){
            $this->db->select("name");
            $this->db->where('id', $file_id);
            if($id_post)
            $this->db->where('id_post', $id_post);
            $res = $this->db->get("img_post");
            return $res->result_array();
   }
   public function get_file($file_id){
      return $this->db->select("name")
            ->from('img_post')
            ->where('id', $file_id)
            ->get()
            ->row();
   }
   public function getIdImage($name){
      if(!$name)
      return false;

      return $this->db->select("id")
            ->from('img_post')
            ->where('name', $name)
            ->limit(1)
            ->get()
            ->row();
   }   
     
   public function getmypost($id="",$id_user="",$order_by="",$search=""){
      
      $this->db->select('my.id');
      $this->db->select('my.title');
      $this->db->select('my.description');
      $this->db->select('my.price');
      $this->db->select('my.oldprice');
      $this->db->select('my.stock');
      $this->db->select('my.video');
      $this->db->select('my.registred_on');
      $this->db->select('GROUP_CONCAT(img.name SEPARATOR ",")  as name',false);
      $this->db->select('GROUP_CONCAT(img.id SEPARATOR ",")  as id_img',false);
      $this->db->select('my.type');
      $this->db->select('my.registred_by');
      $this->db->from('mypost as my');
      $this->db->join('img_post as img', "img.id_post=my.id",'left');
      if($id)
      $this->db->where('my.id',$id);
      $this->db->where('my.id_user',$id_user);
      $this->db->like('my.title',$search,'after');
      $this->db->group_by("my.id");
      if($order_by==1):
         $this->db->order_by('my.title asc');
      elseif($order_by==2):
      elseif($order_by==3):
         $this->db->order_by('my.registred_on desc');
      elseif($order_by==4):
         $this->db->order_by('my.type desc');      
      else:
         $this->db->order_by('my.id desc');
      endif;
      //$this->db->limit(2);
      $consulta = $this->db->get();
      // $this->db->order_by($order_by==1 ? 'my.id desc' : 'my.title' ? $order_by==2 : 'cat.name asc');
      
      if ($consulta->num_rows() > 0){
         foreach ($consulta->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }
   public function getmypost_addcar($id_user){
      
      $this->db->select('my.id');
      $this->db->select('my.id_user');
      $this->db->select('my.id_owner');
      $this->db->select('my.title');
      $this->db->select('my.description');
      $this->db->select('my.price');
      $this->db->select('my.oldprice');
      $this->db->select('my.quantity');
      $this->db->select('cat.id as id_category');
      $this->db->select('cat.name as category');
      $this->db->select('GROUP_CONCAT(img.name SEPARATOR ",")  as name',false);
      $this->db->select('GROUP_CONCAT(img.id SEPARATOR ",")  as id_img',false);
      $this->db->select('my.type');
      $this->db->select('my.registred_by');
      $this->db->from('mypost_addcar as my');
      $this->db->join('img_post as img', "img.id_post=my.id_post",'right');
      $this->db->join('app_articles_category as cat', "cat.id=my.category",'right');
      $this->db->where('my.id_user',$id_user);
      $this->db->where('my.status',1);
      $this->db->group_by("my.id");
      $this->db->order_by('my.id desc');
      $consulta = $this->db->get();
      if ($consulta->num_rows() > 0){
         foreach ($consulta->result_array() as $row){
            $data[] = $row;
         }
         return $data;
      }else{
         return array();
      }
   }   
   public function checkMyPost($id){
      
      $this->db->select('id');
      $this->db->where('id',$id);
      $consulta = $this->db->get("mypost");
      
      if ($consulta->num_rows() > 0){
         return $consulta->row();
      }else{
         return array();
      }     
   } 
   public function pay_purchase($id=""){

      $this->db->where('id_user', $id);
      $this->db->set('status', 0);
      $this->db->update("mypost_addcar");
      
   }     

}