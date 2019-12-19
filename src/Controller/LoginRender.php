<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class LoginRender extends AbstractController {
    /**
     * @Route("/login/show")
     */
    public function show() {

        $loginCss = '/css/login.css';
        $ajaxScript = '/js/ajax.js';
        $jqueryScript = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js';
        $logoParanoid = '/img/logoAdmin_paranoid.png';
        $loadGif = '/img/load.gif';

        return $this->render('login.html.twig', [
            
            'loginCss' => $loginCss,
            'ajaxJs' => $ajaxScript,
            'jquery' => $jqueryScript,
            'logoParanoid' => $logoParanoid,
            'loadGif' => $loadGif
        ]);
    }
}
?>