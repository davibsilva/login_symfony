<?php
// src/Controller/LuckyController.php
namespace App\Controller;


use App\Entity\UserTable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class Login extends AbstractController{
    /**
     *  @Route("/login/autentication")
     */
    public function loginAutentication(){ 

        //Pega dados do formulário
        $login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE; 
        $password = isset($_POST["password"]) ? addslashes(trim($_POST["password"])) : FALSE;
        $code = isset($_POST["code"]) ? addslashes(trim($_POST["code"])) : FALSE;
        
        $em = $this -> getDoctrine() -> getManager();
        $selectUser = $this->getDoctrine()->getRepository(UserTable::class);

        $user = $selectUser -> findOneBy ([
            'username' => $login ,
            'password' => $password ,
        ]);

        $email = $selectUser -> findOneBy ([
            'email' => $login ,
            'password' => $password ,
        ]);        

        $twoFactorRecord = null;
        
        $valid = false;
        $response = new Response();

        if ($login){ //Se o login não for vazio, fazer:
            if($user) { //Verificando se login digitado está no banco
                $valid = true; // Se o login estiver na base, validar
                $twoFactor = $user -> getTwoFactor();
            }else if ($email) { //Verificando caso o usuário digitar um email
               
                
                $valid = true;// Se o email digitado estiver na base, validar
                $twoFactor = $email -> getTwoFactor();
            }
        }
        
        $validationCode = null; // Variável verifica código de validacao

        if ($valid) { //se valid for igual a true
            $message = 'Login efetuado com sucesso!';

            if($twoFactor == 1) { // Se twoFactor tive um valor executa:

                //gera número aleatório e insere no usuário
                $assertCode = $email -> getTeoFactorCode();
                if(!$assertCode) {
                    $randomCode = rand(1000, 9999);
                    $email -> setTeoFactorCode($randomCode);
                    $em -> flush();
                }
                
                if($code === '') { // Quando a tela carregar será executado pois só terá o campo
                    
                    $message = "Insira o código enviado ao seu email";
                   
                }
                else {
                    $twoFactorCode= $selectUser -> findOneBy ([
                        'teoFactorCode' => $code
                    ]);
                    
                    if($twoFactorCode) {
                        $twoFactorRecord = $twoFactorCode -> getTeoFactorCode();
                    }

                    else if(!$twoFactorCode) { // Se o código for diferente do banco executa:
                        
                        $message = "Código inválido";
                        $validationCode = false;
                        
                    } else if($code == $twoFactorRecord) { // Se o código for igual ao banco executa:
                        
                        $validationCode = true;
                        $message = 'Sucesso';
                    }
                }                
                
            }
            
            $response->setContent(json_encode(array('status' => 'success', 'message' => $message, 'twoFactor' => $twoFactor, 'twoFactorCode' => $twoFactorRecord, 'validationCode' => $validationCode)));
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set('Content-Type', 'application/json');
            
        } else {
            // Se bater no if($valid) e não corresponder a condição, virá direto pra cá
            
            $response->setContent(json_encode(array('status' => 'success', 'message' => 'Login ou senha inválidos')));
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
            $response->headers->set('Content-Type', 'application/json');
            
        }
        
        return $response; 
           
        }
        
}
        
// $response = new Response();
// $response->setContent(json_encode(array('status' => 'failure', 'message' => 'Login ou senha inválidos!', 'login' => $davi['login'])));
// $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
// $response->headers->set('Content-Type', 'application/json');
// return $response;