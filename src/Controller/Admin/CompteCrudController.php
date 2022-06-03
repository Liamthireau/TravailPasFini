<?php

namespace App\Controller\Admin;

use App\Entity\Compte;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use JetBrains\PhpStorm\Pure;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteCrudController extends AbstractCrudController
{
    const ACTION_DUPLICATE = 'duplicate';



    public static function getEntityFqcn(): string
    {
        return Compte::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUPLICATE)
            ->linkTocrudAction('duplicateCompte')
            ->addCssClass('btn btn-info');
        return $actions
            ->add(Crud::PAGE_EDIT, $duplicate)
            ->reorder(Crud::PAGE_EDIT, [self::ACTION_DUPLICATE, Action::SAVE_AND_RETURN]);
    }

    public function duplicateCompte(
        AdminContext $context,
        EntityManagerInterface $entityManager,
        AdminUrlGenerator $adminUrlGenerator): Response
    {
        /** @var Compte $compte */
        $compte = $context->getEntity()->getInstance();

        $duplicateCompte = clone $compte;
        parent::persistEntity($entityManager, $duplicateCompte);

        $url = $adminUrlGenerator->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicateCompte->getId())
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('collectivite'),
            TextField::new('prenom', 'Prénom'),
            TextField::new('nom', 'Nom'),
            EmailField::new('mail', 'Mail'),
            BooleanField::new('referent', 'Référent des comptes collectivités'),
            AssociationField::new('extranets'),
            AssociationField::new('etat')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
               $queryBuilder->where('entity.id = 1');
            }),
            DateTimeField::new('createAt')->hideOnForm(),
            DateTimeField::new('updateAt')->hideOnForm()
        ];
    }

}
