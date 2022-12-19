<?php

namespace App\Controller;

use App\Entity\Technicien ;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TechnicienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TechnicienController extends AbstractController
{ 
   # #[Route('/technicien', name: 'app_technicien')]
    #public function index(): Response
    #{
     #   return $this->render('technicien/index.html.twig', [
      #      'controller_name' => 'TechnicienController',
       # ]);
    #}

    #[Route('/techniciens', name: 'all_technicine' , methods: ['GET'])]
    public function get_allTech(TechnicienRepository $techRep ){

    
        
        $techs = $this->json($techRep->findAll(),200 , [] , ['groups' => "tech : read"]);
        
        return $this->render('technicien/index.html.twig', [
            'techs' => $techs,
        ]);
    }

    #[Route('/add/techniciens', name: 'add_technicien' , methods: ['POST
    '])]
    public function add_tech(Request $request , SerializerInterface $serializer , EntityManagerInterface $em)
    {
        $jsonRecu = $request->getContent();

        $tech = $serializer->deserialize($jsonRecu , Technicien::class, 'json');

        $em->persist($tech);
        $em->flush();

        return $this->json($tech, 201, [], ['groups' => "tech : read"]);

    }
    #[Route('/', name: 'home')]
    public function home(){
        return $this->render('technicien/home.html.twig');
    }

 
}
