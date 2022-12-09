<?php

namespace App\Repository;

use App\Entity\Card;
use App\Entity\Game;
use App\Entity\GameLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameLog>
 *
 * @method GameLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameLog[]    findAll()
 * @method GameLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameLog::class);
    }

    public function save(GameLog $entity, bool $flush = false): void
    {
        if (!empty($entity->getGameId())) {
            $reference = $this->_em->getReference(Game::class, $entity->getGameId());
            $entity->setGame($reference);
        }

        if (!empty($entity->getCardId())) {
            $reference = $this->_em->getReference(Card::class, $entity->getCardId());
            $entity->setCard($reference);
        }

        if (!empty($entity->getPlayerId())) {
            $reference = $this->_em->getReference(Player::class, $entity->getPlayerId());
            $entity->setPlayer($reference);
        }

        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GameLog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
