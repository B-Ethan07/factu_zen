<?php
// src/DataFixtures/ClientFixtures.php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Invoice;
use App\Entity\InvoiceLine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Statuts possibles pour les factures
        $statuses = ['draft', 'sent', 'paid'];

        for ($i = 0; $i < 100; $i++) {
            $client = new Client();
            $client
                ->setCompanyName($faker->company)
                ->setContactName($faker->name)
                ->setEmail($faker->email)
                ->setPhone($faker->phoneNumber);

            $manager->persist($client);

            // Création de 1 à 5 factures par client
            for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
                $invoice = new Invoice();
                $invoice
                    ->setReference($faker->unique()->numerify('FACT-#####'))
                    ->setIssuedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 year')->format('Y-m-d')))
                    ->setStatus($faker->randomElement($statuses))
                    ->setClient($client);

                $manager->persist($invoice);

                // Création de 1 à 10 lignes par facture
                for ($k = 0; $k < $faker->numberBetween(1, 10); $k++) {
                    $invoiceLine = new InvoiceLine();
                    $invoiceLine
                        ->setDesignation($faker->sentence(3))
                        ->setQuantity($faker->numberBetween(1, 100))
                        ->setUnitPrice($faker->randomFloat(2, 10, 1000))
                        ->setInvoice($invoice);

                    $manager->persist($invoiceLine);
                }
            }
        }

        $manager->flush();
    }
}
