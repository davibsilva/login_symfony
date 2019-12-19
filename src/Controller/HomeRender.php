<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class HomeRender extends AbstractController {
    /**
     * @Route("/home/show")
     */
    public function show(){

        $baseCss = '/css/index.css';
        $shitClock = '/js/index.js';

        return $this->render('base.html.twig', [
            
            'baseCss' => $baseCss,
            'shitClock' => $shitClock,

        ]);
    }
}
?>