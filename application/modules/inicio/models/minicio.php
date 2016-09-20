<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class minicio extends CI_Model {

	public function __construct(){
		parent::__construct();
		
	}
	public function getmypost($id,$id_user){
		
		$this->db->select('my.id');
		$this->db->select('my.id_user');
		$this->db->select('my.title');
		$this->db->select('my.description');
		// $this->db->select('my.item');
		$this->db->select('my.price');
		$this->db->select('my.oldprice');
		$this->db->select('my.type');
		$this->db->select('my.folio');
		$this->db->select('my.serie');
		$this->db->select('my.barcode');
		$this->db->select('my.invoice');
		$this->db->select('my.brand as brand_id');
		$this->db->select('my.type_of_currence as TypeOfCurrence_id');
		$this->db->select('my.provider as Provider_id');
		$this->db->select('my.class as Class_id');
		$this->db->select('my.use as Use_id');
		$this->db->select('my.level_obsolescence as Level_obsolescence_id');
		$this->db->select('my.physical_state as Physical_state_id');
		$this->db->select('my.ubication as Ubication_id');
		$this->db->select('my.departament as Departament_id');
		$this->db->select('my.family as Family_id');
		$this->db->select('my.frecuency as frecuencyMonth');
		//$this->db->select('artb.name as brand');
		$this->db->select('my.status');
		$this->db->select('my.id_user_assign');
		$this->db->select('GROUP_CONCAT(img.name SEPARATOR ",")  as name',false);
		$this->db->select('my.registred_on');
		$this->db->from('mypost as my');
		$this->db->join('img_post as img', "img.id_post=my.id",'left');
		//$this->db->join('app_articles_brand as artb', "artb.id=my.brand",'right');
		if($id)
		$this->db->where('my.id',$id);
		$this->db->where('my.id_user',$id_user);
		$this->db->group_by("my.id");
		$this->db->order_by('my.id desc');
		$this->db->where('my.status',1);
		// $this->db->limit(5);
		$consulta = $this->db->get();
		// echo$this->db->last_query();
		
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
		// echo$this->db->last_query();
		
		if ($consulta->num_rows() > 0){
			return $consulta->row();
		}else{
			return array();
		}		
	}
	public function saveComment($_datos){
		$datenow = date("Y-m-d h:i:s");
		$data = array(
			"id_user"=>$_datos["id_user"],
			"id_post"=>$_datos["_p_ref"],
			"comment"=>htmlspecialchars($_datos["_cm"]),
			"registred_by"=>$_datos["id_user"],
			"registred_on"=>$datenow,
			);
		$this->db->insert("comments",$data);
		$res=$this->db->insert_id();

   		if ($res){
         return $res;
		}else{
		 return false;
		}	

	}
	public function saveCommentResponse($_datos){
		$datenow = date("Y-m-d h:i:s");
		$data = array(
			"id_user"=>$_datos["id_user"],
			"id_post"=>$_datos["_p_ref"],
			"id_comment"=>$_datos["_com_r_ref"],
			"comment"=>htmlspecialchars($_datos["_cm"]),
			"registred_by"=>$_datos["id_user"],
			"registred_on"=>$datenow,
			);
		$this->db->insert("comments_response",$data);
		$res=$this->db->insert_id();

   		if ($res){
         return $res;
		}else{
		 return false;
		}	

	}	
	public function getComments($id_post="",$id_comment=""){
		
		$this->db->select('c.id as id_comment');
		$this->db->select('c.comment');
		$this->db->select('uc.username');
		$this->db->select('uc.id');
		$this->db->select('upc.imagen');
		$this->db->from('comments as c');
		$this->db->join('app_users_client as uc','uc.id=c.id_user');
		$this->db->join('app_user_profile_client as upc','upc.user_id=uc.id');
		if($id_comment)
		$this->db->where('c.id',$id_comment);
		if($id_post)
		$this->db->where('c.id_post',$id_post);
		$this->db->order_by('c.id desc');
		$consulta = $this->db->get();
		
		if ($consulta->num_rows() > 0){
	         foreach ($consulta->result_array() as $row){
	    		$row["image"]=site_url('application/assets/application/img/avatares/avatar_'.$row["id"].'/perfil/'.$row["imagen"]);
				$row["response"]=$this->getCommentsResponse($row["id_comment"]);
				$row["id_comment"]=encode_url($row["id_comment"]);
	            $data[] = $row;
	         }
	         return $data;
		}else{
			return array();
		}		
	}
	public function getCommentsResponse($id_comment="",$id=""){
		
		// $this->db->select('c.id as id_comment');
		$this->db->select('c.comment');
		$this->db->select('uc.username');
		$this->db->select('uc.id');
		$this->db->select('upc.imagen');
		$this->db->from('comments_response as c');
		$this->db->join('app_users_client as uc','uc.id=c.id_user');
		$this->db->join('app_user_profile_client as upc','upc.user_id=uc.id');
		if($id)
		$this->db->where('c.id',$id);
		if($id_comment)
		$this->db->where('c.id_comment',$id_comment);
		$this->db->order_by('c.id desc');
		$consulta = $this->db->get();
		
		if ($consulta->num_rows() > 0){
	         foreach ($consulta->result_array() as $row){
				// $row["id_comment"]=encode_url($row["id_comment"]);
	    		$row["image"]=site_url('application/assets/application/img/avatares/avatar_'.$row["id"].'/perfil/'.$row["imagen"]);
	            $data[] = $row;
	         }
	         return $data;
		}else{
			return array();
		}		
	}
	public function addCar($id="",$id_user,$id_owner){

		$consulta = $this->db->select('*')->where('id', $id)->get('mypost');
		$datenow = date("Y-m-d h:i:s");
		
		$this->db->select("id_purchase");
		$this->db->order_by('id_purchase desc');
		$this->db->limit(1);
		//$this->db->where("status",0);
		$this->db->where("id_user",$id_user);
		$this->db->where("id_post",$id);
		$query=$this->db->get("mypost_addcar");
		if($query->num_rows()){
			$row__=$query->row_array();
			$row__["id_purchase"]=$row__["id_purchase"]+1;
		}else{

			$this->db->select("id");
			$this->db->limit(1);
			$this->db->where("id_user",$id_user);
			$this->db->order_by('id_purchase desc');
			$count=$this->db->get("mypost_addcar");
			$row__exists=$count->row_array();
			if($count->num_rows())
			$row__["id_purchase"]=$row__exists["id"]+1;
			else
			$row__["id_purchase"]=1;
		}

	     foreach ($consulta->result_array() as $row){
	        $data = array(
	        		'id_post'=>$row['id'],
	        		'id_purchase'=>$row__["id_purchase"],
	        		'id_user'=>$id_user,
	        		'id_owner'=>$id_owner,
					'title'=>$row['title'],
					'description'=>$row['description'],
					'price'=>$row['price'],
					'oldprice'=>$row['oldprice'],
					'quantity'=>1,
					'id_imgpost'=>$row['id_imgpost'],
					'category'=>$row['category'],
					'type'=>$row['type'],
					'status'=>1,
					'registred_by'=>$id_user,
					'registred_on'=>$datenow,
	        		);
	     }

	     // $query=$this->db->query("select id from mypost_addcar order_by id desc limit 1");
	     // $row=$query->row_array();
	     // $str = $this->db->last_query("mypost_addcar");
		if($consulta->num_rows()){
			// $this->db->set('id_purchase',$row["id_purchase"], FALSE);
		    $insert = $this->db->insert('mypost_addcar', $data);
		}
		
	}
	public function checkCar($id="",$id_user=""){

		
		$this->db->select('id');
		$this->db->where('id_post', $id);
		$this->db->where('id_user', $id_user);
		$this->db->where('status !=', 0);
		$consulta = $this->db->get('mypost_addcar');

		if($consulta->num_rows()){
		    return true;
		}else{
			return false;
		}
		
	}
	public function updateCar($id="",$id_user=""){

		$this->db->where('id_post', $id);
		$this->db->where('id_user', $id_user);
		$this->db->where('status', 1);
		$this->db->set('quantity', 'quantity+1', FALSE);
		$this->db->update("mypost_addcar");
		
	}
  public function updatItem($_datos){
      $datenow = date("Y-m-d h:i:s");
      $data = array(
         "title"=>$_datos["title"],
         "description"=>(isset($_datos["description"])?htmlentities($_datos["description"]):""),
         "price"=>(isset($_datos["price"])? $_datos["price"] : ""),
         "oldprice"=>(isset($_datos["oldprice"])? $_datos["oldprice"] : ""),
         "stock"=>(isset($_datos["stock"])?$_datos["stock"]:""),
         "video"=>(isset($_datos["video"]) ? strip_tags($_datos["video"],'<iframe>') : ""),
         "type"=>(isset($_datos["type"])?$_datos["type"]:""),
         "barcode"=>(isset($_datos["type"])?$_datos["type"]:""),
         "invoice"=>(isset($_datos["invoice"])?$_datos["invoice"]:""),
         "brand"=>(isset($_datos["brand_id"])?$_datos["brand_id"]:""),
         "type_of_currence"=>(isset($_datos["TypeOfCurrence_id"])?$_datos["TypeOfCurrence_id"]:""),
         "provider"=>(isset($_datos["type"])?$_datos["type"]:""),
         "class"=>(isset($_datos["Class_id"])?$_datos["Class_id"]:""),
         "use"=>(isset($_datos["Use_id"])?$_datos["Use_id"]:""),
         "level_obsolescence"=>(isset($_datos["Level_obsolescence_id"])?$_datos["Level_obsolescence_id"]:""),
         "physical_state"=>(isset($_datos["Physical_state_id"])?$_datos["Physical_state_id"]:""),
         "departament"=>(isset($_datos["Departament_id"])?$_datos["Departament_id"]:""),
         "ubication"=>(isset($_datos["Ubication_id"])?$_datos["Ubication_id"]:""),
         "family"=>(isset($_datos["Family_id"])?$_datos["Family_id"]:""),
         "frecuency"=>(isset($_datos["frecuencyMonth"])?$_datos["frecuencyMonth"]:""),
         "status"=>$_datos["status"],
         "id_user_assign"=>(isset($_datos["id_user_assign"])?$_datos["id_user_assign"]:""),
         "updated_by"=>(isset($_datos["id_user"])?$_datos["id_user"]:""),
         "updated_on"=>$datenow,
         );

		$this->db->where('id', $_datos["id"]);
		$this->db->set($data);
		$res = $this->db->update("mypost");

		if($res){
			return $res;
		}else{
			return false;
		}

   } 

}