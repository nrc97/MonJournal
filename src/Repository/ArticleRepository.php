<?php


namespace App\Repository;

// Repository personnalise pour les entites 'Article', mapping a ajouter dans Entity Article
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{

    public function findTodayDQL() {

        // SQL: SELECT * FROM article WHERE date_publication LIKE '2020-11-04%'

        $dql = "SELECT a FROM App:Article a WHERE a.datePublication LIKE :theDate";

        $query = $this->getEntityManager()->createQuery($dql);
        $aujoudhui = date('Y-m-d') . "%";
        $query->setParameter('theDate', $aujoudhui);

        return $query->getResult();

    }

    public function findTodayQB() {
        $aujourdhui = date('Y-m-d') . "%";

        // On crée l'objet QueryBuilder
        $qb = $this->getEntityManager()->createQueryBuilder();

        // On construit la requete
        $query = $qb->select('a')
                    ->from('App:Article', 'a')
                    ->where(
                        $qb->expr()->like('a.datePublication', ':theDate')
                    )
                    ->setParameter('theDate', $aujourdhui)
                    ->getQuery();
        return $query->getResult();
    }

}