<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mapa extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mapa_model');
	}
	
	public function index()
	{
		//creamos la configuración del mapa con un array
		$config = array();
        //la zona del mapa que queremos mostrar al cargar el mapa
        //como vemos le podemos pasar la ciudad y el país
        //en lugar de la latitud y la lngitud
		$config['center'] = 'madrid,espana';
        // el zoom, que lo podemos poner en auto y de esa forma
        //siempre mostrará todos los markers ajustando el zoom	
		$config['zoom'] = '6';		
        //el tipo de mapa, en el pdf podéis ver más opciones
		$config['map_type'] = 'ROADMAP';
        //el ancho del mapa		
		$config['map_wid_poith'] = '700px';	
        //el alto del mapa	
		$config['map_height'] = '600px';	
        //inicializamos la configuración del mapa	
		$this->googlemaps->initialize($config);	
		
		//hacemos la consulta al modelo para pedirle 
		//la posición de los markers y el nombre_poi
		$data['datos'] = $this->mapa_model->get_markers();
		foreach($data['datos'] as $info_marker)
		{
			$marker = array();
            //podemos elegir DROP o BOUNCE
			$marker ['animation'] = 'DROP';
            //posición de los markers
			$marker ['position'] = $info_marker->lat.','.$info_marker->lng;
            //nombre_poi de los markers(ventana de información)	
			$marker ['nombre_poi_content'] = $info_marker->nombre_poi;
            //la id_poi del marker
			$marker['id_poi'] = $info_marker->id_poi; 
			$this->googlemaps->add_marker($marker);
 
            //podemos colocar iconos personalizados así de fácil
			//$marker ['icon'] = base_url().'imagenes/'.$fila->imagen;
 
			//si queremos que se pueda arrastrar el marker
			//$marker['draggable'] = TRUE;
			//si queremos darle una id_poi, muy útil
		}
		
		//en $data['datos']tenemos la información de cada marker para
        //poder utilizarlo en el sid_poiebar en nuestra vista mapa_view
		//$data['datos'] = $this->mapa_model->get_markers();
        //en data['map'] tenemos ya creado nuestro mapa para llamarlo en la vista
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('mapa_view',$data);
	}
}