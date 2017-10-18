<?php

namespace QS\BookingBundle\Repository;

use QS\BookingBundle\Entity\Event;

/**
 * TicketRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllByIds($tickets)
    {
        $qb = $this->createQueryBuilder('t');
        foreach ($tickets as $ticket) {
            $where = "t.id = '".$ticket->getId()."'";
            $qb->orWhere($where);
        }
        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    public function getAllByIdsEvent($tickets, Event $event)
    {
        $qb = $this->createQueryBuilder('t');
        $where = [];
        foreach ($tickets as $ticket) {
            $where[] = "t.id = '".$ticket->getId()."'";
        }
        return $qb
            ->andWhere(implode(' OR ', $where))
            ->innerJoin('t.events', 'e', 'WITH', 'e = :event')
            ->setParameters([
                'event' => $event,
            ])
            ->getQuery()
            ->getResult()
        ;
    }

    public function getAllByEvent(Event $event)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.events', 'e', 'WITH', 'e = :event')
            ->innerJoin('t.ticketPeriods', 'tp')
            ->addSelect('tp')
            ->innerJoin('tp.period', 'p')
            ->addSelect('p')
            ->setParameters([
                'event' => $event,
            ])
            ->getQuery()
            ->getResult()
        ;
    }
}
