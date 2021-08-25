<?php

namespace App\Infrastructure\Database\Doctrine;

use App\Domain\Forecast\Forecast;
use App\Domain\Forecast\ForecastRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ForecastRepository extends ServiceEntityRepository implements ForecastRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Forecast::class);
    }

    public function save(Forecast $forecast): void
    {
        $this->_em->persist($forecast);
        $this->_em->flush();
    }

    public function getLatest(): array
    {
        $qb = $this->createQueryBuilder('f');
        $qb->orderBy('f.dateTime', 'DESC')
            ->setMaxResults(10);

        return $qb->getQuery()->getResult();
    }
}
