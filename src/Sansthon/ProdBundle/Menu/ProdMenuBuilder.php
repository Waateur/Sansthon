<?php
namespace Sansthon\ProdBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class ProdMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'Sansthon_AdminBundle_Type_list'));
        // ... add more children

        return $menu;
    }
}
