<?php

namespace App\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;

use App\Entity\Segment;

class SegmentListener
{
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $entity->recalculateAverages();
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entity->recalculateAverages();
    }
}

