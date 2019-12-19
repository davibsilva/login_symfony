<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class RegisterRender extends AbstractController {
    /**
     * @Route("/register/show")
     */
    public function show() {

      

        return $this->render('register.html.twig', [
    
        ]);
    }
}
?>