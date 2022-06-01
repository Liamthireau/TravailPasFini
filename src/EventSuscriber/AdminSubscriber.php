<?php

namespace App\EventSubscriber;

use App\Entity\Collectivite;
use App\Entity\Compte;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt']

        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        // dd($event);
        $entityInstance = $event->getEntityInstance();

        if(!$entityInstance instanceof Compte && !$entityInstance instanceof Collectivite) return;

        $entityInstance->setCreateAt(new \DateTimeImmutable());
    }

    public function setUpdatedAt(BeforeEntityUpdatedEvent $event)
    {

        $entityInstance = $event->getEntityInstance();

        if(!$entityInstance instanceof Compte && !$entityInstance instanceof Collectivite) return;

        $entityInstance->setUpdateAt(new \DateTimeImmutable());
    }
}