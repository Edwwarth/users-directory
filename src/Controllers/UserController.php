<?php declare(strict_types = 1);

namespace App\Controllers;

use Http\Request;
use Http\Response;
use App\Template\Renderer;
use App\Models\User;
use \ArrayIterator;

class UserController
{
    private $request;
    private $response;
    private $renderer;

    public function __construct(
        Request $request, 
        Response $response,
        Renderer $renderer
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }

    public function buscar()
    {
        if(!empty($_SESSION['id']) && $_SESSION['id']!="" && $_SESSION['entity']=="Usuario"){
            $html = $this->renderer->render('BuscarUsuario', "");
            $this->response->setContent($html);
        }else{
            $html = $this->renderer->render('Homepage', "");
            $this->response->setContent($html);
        }
        
    }
    public function buscarAjax($param)
    {
        if(!empty($_SESSION['id']) && $_SESSION['id']!="" && $_SESSION['entity']=="Usuario"){
            $usuario = new User();
            if(!empty($param)){
                $usuarios = $usuario -> search($param['search']);
                $counter = 1;
                $complexType = array();
                foreach ($usuarios as $currentUsuario){
                    $simpleType = array('nombre' => $currentUsuario -> getNombre(),
                                        'pais' => $currentUsuario -> getPais(),
                                        'email' => $currentUsuario -> getEmail() );
                    array_push($complexType, $simpleType  );
                }
            }
            $template_data['complex'] = new ArrayIterator( $complexType );
            $html = $this->renderer->render('BuscarUsuarioAjax', $template_data);
            $this->response->setContent($html);
        }else{
            $html = $this->renderer->render('Homepage', "");
            $this->response->setContent($html);
        }
        
    }
    public function logout(){
        if(isset($_GET['logOut'])){
            $_SESSION['id']="";
        }
        $html = $this->renderer->render('Homepage', "");
        $this->response->setContent($html);
    }
    
    
}