<?php
namespace Sansthon\ProdBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class ProdMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');
        $menu->addChild('Admin', array('route' => 'Sansthon_AdminBundle_Type_list'));
        $menu->addChild('Rapport', array('route' => 'stock'));
        // ... add more children

        return $menu;
    }
}
