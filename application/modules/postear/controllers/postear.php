<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class postear extends APP_Controller {

	public function __construct(){
		parent::__construct();

        $this->load->model('mpostear');

       	$this->module = $this->uri->segments;
		if($this->module)
		list($this->module, $this->category,$this->id_post,$this->title) = array_pad($this->module, 5, NULL);
		else
		$this->module = $this->dx_auth->get_domain();        

	}

	public function index(){
        
        $cat["domain"] = $this->module;
		$cat["brandList"] = $this->myBrand();
		$cat["TypeFixedAssetsList"] = $this->myTypeFixedAssets();
		$cat["TypeOfCurrenceList"] = $this->myTypeOfCurrence();
		$cat["ProviderList"] = $this->myProvider();
		$cat["ClassList"] = $this->myClass();
		$cat["UseList"] = $this->myUse();
		$cat["Level_obsolescenceList"] = $this->myLevel_obsolescence();
		$cat["Physical_stateList"] = $this->myPhysical_state();
		$cat["DepartamentList"] = $this->myDepartament();
		$cat["UbicationList"] = $this->myUbication();
		$cat["FamilyList"] = $this->myFamily();

		$v_['items'] = $this->parser->parse('postype/items',$cat, TRUE);
		//$v_['news'] = $this->parser->parse('postype/news',$cat, TRUE);
		$views['createpost'] = $this->parser->parse('createpost',$v_, TRUE);
		$_data['contenido'] = $this->parser->parse('ini',$views, TRUE);
		$this->init($_data);
	}
	public function myBrand(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getBrand( $_datos["id_user"]);
		return $res;
	}
	public function myTypeFixedAssets(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getTypeFixedAssets( $_datos["id_user"]);
		return $res;
	}
	public function myTypeOfCurrence(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getTypeOfCurrence( $_datos["id_user"]);
		return $res;
	}
	public function myProvider(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getProvider( $_datos["id_user"]);
		return $res;
	}
	public function myClass(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getClass( $_datos["id_user"]);
		return $res;
	}
	public function myUse(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getUse( $_datos["id_user"]);
		return $res;
	}
	public function myLevel_obsolescence(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getLevel_obsolescence( $_datos["id_user"]);
		return $res;
	}
	public function myPhysical_state(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getPhysical_state( $_datos["id_user"]);
		return $res;
	}
	public function myDepartament(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getDepartament( $_datos["id_user"]);
		return $res;
	}
	public function myUbication(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getCostCenter( $_datos["id_user"]);
		return $res;
	}
	public function myFamily(){
       $_datos["id_user"] = $this->dx_auth->get_user_id();
		$res = $this->mpostear->getFamily( $_datos["id_user"]);
		return $res;
	}	
	public function eventos(){		
		$_data['contenido'] = $this->parser->parse('events',array(), TRUE);
		$this->init($_data);
	}
	public function postype(){

        $cat["domain"] = $this->module;
		$cat["catList"] = $this->myCategory();		
		if($_GET["val"]=="_n")
		$views = $this->parser->parse('postype/news',$cat, TRUE);
		if($_GET["val"]=="_i")
		$views = $this->parser->parse('postype/items',$cat, TRUE);

		echo $views;
	}

}