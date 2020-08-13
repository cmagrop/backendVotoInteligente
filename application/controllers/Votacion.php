<?php 

//damos acceso a la ruta del archivo
defined('BASEPATH') OR exit('Script no habilitado');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Votacion extends REST_Controller
{

    public function __construct()
    {
        header("Access-Control-Allow-Methods:PUT,GET,POST,DELETE,OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding");
        header("Access-Control-Allow-Origin: *");
        parent::__construct();
        $this->load->database();

    } 
    public function index()
    {
        echo "Hola mundo";
    
    }

//listar votaciones disponibles


public function index_get()
{

    $this->load->database();
    
    $query = $this->db->query("select * from votacion");
    echo json_encode($query->result());

    
}

//listar votacionas pasadas limite 6
//listar preguntas por votacion
//seleccionar las votaciones

}

?>