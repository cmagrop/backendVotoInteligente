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
   

//listar votaciones disponibles


public function index_get()
{

    $this->load->database();
    
    $query = $this->db->query("select * from votacion");
    echo json_encode($query->result());

    
}


public function index_post()
{

    $data=$this->post();//llena un arreglo con los datos de entrada
    //validacion del rut y el password
    if(!isset($data['rut']) OR !isset($data['nro_votacion']))
    {
    
        $respuesta= array(
             'error'=>TRUE,
             'mensaje'=>'La información enviada no es válida'


        );

        $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
      return;
    }

    $condiciones= array(

        'FK_rut'=>$data['rut'],
        'FK_nro_votacion'=>$data['nro_votacion']
    );

  
    //realiza consulta a la base de datos
    $query = $this->db->get_where('usuario_votacion',$condiciones);
    /*
       select *
       from usuario_votacion
       where FK_rut=$data['rut'] and FK_nro_votacion=$data['nro_votacion'];

    */
    
    $votaciones= $query->row();

    if(!isset($votaciones))
    {
          $respuesta= array(
            'error'=>TRUE,
            'mensaje'=>'Su voto ha sido registrado'

          );

         //realiza 
         $query = $this->db->insert('usuario_votacion',
    array('FK_rut' => $data['rut'],
    'FK_nro_votacion'=>$data['nro_votacion']));

          $this->response($respuesta);
          return;
         
    }

    else
    {
        $respuesta= array(
            'error'=>false,
            'mensaje'=>'Usted realizó la votación, por lo tanto no puede votar '

          );


          $this->response($respuesta);
          return;


    }

   
   

   

    


}

//listar votacionas pasadas limite 6
//listar preguntas por votacion
//seleccionar las votaciones

}

?>