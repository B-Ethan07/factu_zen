<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice')]
final class InvoiceController extends AbstractController
{
    #[Route('/', name: 'app_invoice')]
    public function index(): Response
    {
        return $this->redirectToRoute('client_index');
    }

    #[Route('/{id}', name: 'invoice_show')]
    public function show(Invoice $invoice): Response
    {
        return $this->render('invoices/show.html.twig', [
            'invoice' => $invoice,
            'client' => $invoice->getClient(),
            'invoiceLines' => $invoice->getInvoiceLines()
        ]);
    }
    #[Route('/invoice/new', name: 'invoice_new')]
    public function newInvoice(Request $request, ClientRepository $clientRepository): Response {
        $invoice = new Invoice();
        $form = $this->createForm('App\Form\InvoiceType', $invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $clientRepository->save($invoice->getClient(), true);
            return $this->redirectToRoute('client_index');
        }
        return $this->render('invoices/new.html.twig', [
            'invoice' => $invoice,
            'form' => $form->createView(),
            'clients' => $clientRepository->findAll(),
            'invoiceLines' => []
        ]);
    }
    #[Route('/invoice/{id}/edit', name: 'invoice_edit')]
    public function editInvoice(Request $request, Invoice $invoice, ClientRepository $clientRepository): Response
    {
        $form = $this->createForm('App\Form\InvoiceType', $invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $clientRepository->save($invoice->getClient(), true);
            return $this->redirectToRoute('client_index');
        }
        return $this->render('invoices/edit.html.twig', [
            'invoice' => $invoice,
            'form' => $form->createView(),
        ]);
    }
}

