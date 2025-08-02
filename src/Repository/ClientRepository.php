<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    // Créer une méthode personnalisée dans ClientRepository (avec un LIKE)
public function findCompanyByName(string $companyName): array
{
    return $this->createQueryBuilder('c')
        ->where('LOWER(c.companyName) LIKE :company_name')
        ->setParameter('company_name', mb_strtolower($companyName) . '%')
        ->orderBy('c.companyName', 'ASC')
        ->getQuery()
        ->getResult();
}

    //    /**
    //     * @return Client[] Returns an array of Client objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Client
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function save(Client $client, true $true)
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
    }
}
/* Créer une méthode personnalisée dans ClientRepository (avec un LIKE)
Créer une route /clients/search?name=…
Utiliser une requête GET pour filtrer les résultats */
