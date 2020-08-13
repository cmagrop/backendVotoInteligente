<?php 

//damos acceso a la ruta del archivo
defined('BASEPATH') OR exit('Script no habilitado');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Login extends REST_Controller
{

    public function __construct()
    {
        header("Access-Control-Allow-Methods:PUT,GET,POST,DELETE,OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding");
        header("Access-Control-Allow-Origin: *");
        parent::__construct();
        $this->load->database();

    }  
    
    public function index_post()
    {

        $data=$this->post();
        //validacion del rut y el password
        if(!isset($data['rut']) OR !isset($data['password']) ){
        
            $respuesta= array(
                 'error'=>TRUE,
                 'mensaje'=>'La información enviada no es válida'


            );

            $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
          return;
        }


        $condiciones= array(

            'rut'=>$data['rut'],
            'password'=>$data['password']
        );

      
        //realiza consulta a la base de datos
        $query = $this->db->get_where('usuario',$condiciones);
        $usuario = $query->row(); //obtenga o no obtenga registros
        
/*
Referencia: https://www.w3adda.com/codeigniter-tutorial/codeigniter-select-query

select *
from usuario
where rut=$data['rut] and  password=$data['password']

*/
        if(!isset($usuario))
        {
              $respuesta= array(
                'error'=>TRUE,
                'mensaje'=>'Usuario y/o contraseña no validos'

              );
              $this->response($respuesta);
              return;
             
        }

        else
        {
            $respuesta= array(
                'error'=>FALSE,
                'mensaje'=>'Autentificacion exitosa'

              );
              $this->response($respuesta);
              return;

        }





       

    }



}

?>