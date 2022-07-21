<?php

namespace App\Controller\Admin;

use App\Entity\Publications;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PublicationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Publications::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Publications')
            ->setEntityLabelInSingular('Publication')
            ->setSearchFields(['titre', 'user.username', 'contenu', 'categorie.nom'])
            ->setDefaultSort(['createdAt' => 'DESC', 'titre' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        //IdField::new('id');
        yield TextField::new('titre');
        yield SlugField::new('slug')->setTargetFieldName('titre')->hideOnIndex();
        yield TextField::new('contenu');
        yield TextField::new('featuredText');
        yield DateTimeField::new('createdAt');
        yield AssociationField::new('categorie');
        yield AssociationField::new('user');
        //TextEditorField::new('description');
    }
}