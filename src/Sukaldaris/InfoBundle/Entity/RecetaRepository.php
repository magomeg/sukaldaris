<?php

namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * RecetaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecetaRepository extends EntityRepository
{

	public function getLatestRecetas($limit = null)
	{
		$qp = $this->createQueryBuilder('r')->select('r')->addOrderBy('r.fecha_publicacion', 'ASC');

		if (false === is_null($limit))
			$qp->setMaxResults($limit);

		return $qp->getQuery()->getResult();
	}
}
