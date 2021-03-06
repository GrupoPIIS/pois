<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Pois_model extends CI_Model{

	//Contructor correspondiente de la clase. Carga la base de datos.
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//Hace un SELECT * FROM pois
	function getPois(){
		$query = $this->db->get('pois');
		if($query->num_rows() > 0) return $query;
		else return NULL;
	}

	//Hace un SELECT * FROM pois WHERE id = $id
	function getPoi($id){
		$this->db->where('id_poi', $id);
		$query = $this->db->get('pois');
		if($query->num_rows() > 0) return $query;
		else return NULL;
	}

	//Hace un INSERT INTO pois VALUES datos = $data
	function newPoi($data){
		$this->db->insert('pois', array(
										'lng' 		=> $data['lng'],
										'lat' 		=> $data['lat'],
										'nombre_poi'=> $data['nombre_poi'],
										'txt_rep'	=> $data['txt_rep'],
										'direccion'	=> $data['direccion'],
										'id_usuario'=> $data['id_usuario']
										)
						);
		/*$this->db->insert('id_poi_id_cat', array(
												'id_poi'		=> $data['direccion'],
												'id_categoria'	=> $data['id_usuario']
											)
						);*/
	}

	//Hace un UPDATE pois SET datos = $data WHERE id = $id
	function updatePoi($id, $data){
		$this->db->where('id_poi', $id);
		$query = $this->db->update('pois', $data);
		//Tabla relacion
	}

	//Hace un DELETE FROM pois WHERE id = $id
	function deletePoi($id){
		$this->db->where('id_poi', $id);
		$this->db->delete('pois');
	}
}