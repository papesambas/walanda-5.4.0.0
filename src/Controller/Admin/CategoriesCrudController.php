<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categories::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Publications Catégories')
            ->setEntityLabelInSingular('Publication Catégorie')
            ->setSearchFields(['nom'])
            ->setDefaultSort(['couleur' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        //yield IdField::new('id')->onlyOnIndex;
        yield TextField::new('nom');
        yield SlugField::new('slug')->setTargetFieldName('nom')->hideOnIndex();
        yield TextField::new('description');
        yield ColorField::new('couleur');


        //TextEditorField::new('description'),
    }
}