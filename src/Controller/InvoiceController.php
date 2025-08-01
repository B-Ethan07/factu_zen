<?php

namespace App\Controller;

use App\Entity\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        return $this->render('invoice/show.html.twig', [
            'invoice' => $invoice,
            'client' => $invoice->getClient(),
            'invoiceLines' => $invoice->getInvoiceLines()
        ]);
    }
}

