<?php

namespace App\Controller\Admin;

use App\Entity\Collectivite;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CollectiviteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Collectivite::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            EmailField::new('mail'),
            IntegerField::new('siren'),
            IntegerField::new('nic'),
            DateTimeField::new('createAt')->hideOnForm(),
            DateTimeField::new('updateAt')->hideOnForm()
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Collectivite) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable());
        parent::persistEntity($entityManager, $entityInstance);
    }

}
