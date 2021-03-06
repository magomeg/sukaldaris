<?php

namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * CategoriaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoriaRepository extends EntityRepository
{
	public function getCategoriasAlphabeticallyOrdered($currentPage)
	{
	
	    $qp = $this->createQueryBuilder('p')->select('p')->addOrderBy('p.categoria', 'ASC');

	   	$paginator = $this-> paginate($qp, $currentPage);

	   	return $paginator;

	}

	public function paginate($dql,$page=1,$limit=20){
		$paginator = new Paginator($dql);

		$paginator->getQuery() ->setFirstResult($limit * ($page - 1)) ->setMaxResults($limit);

		return $paginator;
	}
}
