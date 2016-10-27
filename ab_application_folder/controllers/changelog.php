<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Changelog extends CI_Controller
{
	public function index()
	{

        //pass the information to the view
        $data['main_content'] = 'changelog_view';
        $this->load->view('layout/template', $data);

	}

	function getData(){
	 $responce->cols[]=array("id"=>"","label"=>"Topping","pattern"=>"","type"=>"string");
	 $responce->cols[]=array("id"=>"","label"=>"Slices","pattern"=>"","type"=>"number");
	 $responce->rows[]["c"]=array(array("v"=>"Mushrooms","f"=>null),array("v"=>3,"f"=>null));
	 $responce->rows[]["c"]=array(array("v"=>"Onions","f"=>null),array("v"=>1,"f"=>null));
	 $responce->rows[]["c"]=array(array("v"=>"Olives","f"=>null),array("v"=>1,"f"=>null));
	 $responce->rows[]["c"]=array(array("v"=>"Zuccini","f"=>null),array("v"=>1,"f"=>null));
	 $responce->rows[]["c"]=array(array("v"=>"Pepperoni","f"=>null),array("v"=>3,"f"=>null));
	 echo json_encode($responce);
	}
}