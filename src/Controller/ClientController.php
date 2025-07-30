<?php
namespace App\Controller;
 
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;
 use App\Repository\ClientRepository;
 use App\Entity\Client;


 class ClientController extends AbstractController
 {
    #[Route('/clients', name: 'client_index')]
   public function showAll(ClientRepository $clientRepository)
    {
    $clients = $clientRepository->findAll();
    return $this->render('clients/index.html.twig', ["clients" =>$clients]);
    }

    #[Route('/clients/{id}', name: 'client_show')]
    public function showClient (Client $client)
    {

        return $this->render('clients/show.html.twig', ['client'=>$client]);
    }
}

/* Créer un contrôleur ClientController
Ajouter une route /clients (name: 'client_index')
Injecter le ClientRepository et appeler findAll()
Passer la liste à une vue Twig */
/* 
Ajouter une route /client/{id} (name: 'client_show')
Symfony injecte automatiquement un Client via le param converter
Afficher les données du client dans une vue */