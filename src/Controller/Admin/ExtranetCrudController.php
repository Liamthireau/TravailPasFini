<?php

namespace App\Controller\Admin;

use App\Entity\Extranet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExtranetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Extranet::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
