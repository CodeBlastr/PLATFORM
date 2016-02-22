<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Bookmarks extends Entity
{

	public function findPopular(Query $query, array $options)
    {
        return $query->where([1 = 1]);
    }
}