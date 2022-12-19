<?php

namespace App\Controller;

use App\Entity\Server;
use App\Repository\ServerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ServerController extends AbstractController
{
    #[Route('/server', name: 'app_server')]
    public function index(): Response
    {
        return $this->render('server/index.html.twig', [
            'controller_name' => 'ServerController',
        ]);
    }
    #[Route('/servers', name: 'all_server' , methods: ['GET'])]
    public function get_allserver(ServerRepository $servRep ){

    
        
        
        $server = $this->json($servRep->findAll(),200 , [] , ['groups' => "server : read"]);
        return $this->render('server/listes.html.twig', [
            'server' => $server,
        ]);
    }
    #[Route('/add/server', name: 'add_server' , methods: ['POST
    '])]
    public function add_serv(Request $request , SerializerInterface $serializer , EntityManagerInterface $em)
    {
        $jsonRecu = $request->getContent();

        $server = $serializer->deserialize($jsonRecu , Server::class, 'json');

        $em->persist($server);
        $em->flush();

        return $this->json($server, 201, [], ['groups' => "server : read"]);

    }


}
