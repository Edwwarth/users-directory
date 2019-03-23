<?php declare(strict_types = 1);

namespace App\Controllers;

use Http\Request;
use Http\Response;
use App\Template\Renderer;
use App\Models\User;

class Homepage
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

    public function show()
    {
        $data = [
            'name' => $this->request->getParameter('name', 'stranger'),
            'menuItems' => [['href' => '/', 'text' => 'Homepage']],
        ];
        $html = $this->renderer->render('Homepage', $data);
        $this->response->setContent($html);
    }
    
    public function login()
    {
        if(isset($_POST['logIn'])){
            if(isset($_POST['email']) && isset($_POST['password'])){
                $email=$_POST['email'];
                $password=$_POST['password'];
                $usuario = new User();
                if($usuario -> logIn($email, $password)){ 
                    $_SESSION['id']=$usuario -> getIdUsuario();
                    $_SESSION['entity']="Usuario";
                    echo "<script>location.href = 'buscar'</script>";
                }
            }
        }
        $data = [
            'name' => $this->request->getParameter('par', 'Datos no validos'),
            'menuItems' => [['href' => '/', 'text' => 'Homepage']],
        ];
        $html = $this->renderer->render('Homepage', $data);
        
        $this->response->setContent($html);
    }

    public function registro()
    {
        $nombre="";
        if(isset($_POST['nombre'])){
            $nombre=$_POST['nombre'];
        }
        $pais="";
        if(isset($_POST['pais'])){
            $pais=$_POST['pais'];
        }
        $email="";
        if(isset($_POST['email'])){
            $email=$_POST['email'];
        }
        $password="";
        if(isset($_POST['password'])){
            $password=$_POST['password'];
        }
        if(isset($_POST['insert'])){
            $userCon = new User();
            if($userCon -> existEmail($email)){
                echo "Ya existes en el sistema";
            }else{
                $newUsuario = new User("", $nombre, $pais, $email, $password);
                $newUsuario -> insert();
                $user = new User();
                if($user -> logIn($email,$password)){
                    $_SESSION['id']=$user -> getIdUsuario();
                    $_SESSION['entity']="Usuario";
                    echo "<script>location.href = 'buscar'</script>";
                }
            }
        }
        $data = [
            'name' => $this->request->getParameter('par', 'Datos no validos'),
            'menuItems' => [['href' => '/', 'text' => 'Homepage']],
        ];
        $html = $this->renderer->render('Registration', $data);
        
        $this->response->setContent($html);
    }
}