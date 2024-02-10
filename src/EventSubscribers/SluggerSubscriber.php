<?php

namespace App\EventSubscribers;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Config\Doctrine\Dbal\ConnectionConfig\ReplicaConfig;

class SluggerSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return[
            BeforeEntityPersistedEvent::class => ['addSlug'],
            BeforeEntityUpdatedEvent::class => ['updatedSlug']
        ];
    }
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function addSlug(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if($entity instanceof Post){
            $slug = strtolower($this->slugger->slug($entity->getTitle()));
            $entity->setSlug($slug);
        }
    }

}