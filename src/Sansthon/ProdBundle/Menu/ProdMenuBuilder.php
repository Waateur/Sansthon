<?php

namespace Sansthon\ProdBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class ProdMenuBuilder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root',array("route" => "welcome"));
        $menu->setChildrenAttribute('class', 'nav');
        // ... add more children
        $encours = $menu->addChild("En cours",array("uri"=>"#"));
        $encours->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
        $encours->setChildrenAttributes(array('class' => 'dropdown-menu'));
        $encours->setAttributes(array('class' => 'dropdown'));
        //$item->setExtra('translation_domain', $menu->getExtra('translation_domain'));
        $encours->setExtra('caret', true);
        $encours->addChild("Classer par Référence",array('route' => 'etat_by_type'));
        $encours->addChild("Classer par Personne", array('route' => 'etat_by_personne'));
        $encours->addChild("Classer par Etape", array('route' => 'etat_by_etape'));
        
        
        
        $menu->addChild('Rapport Global', array('route' => 'stock'));
        // ... add more children
        $item = $menu->addChild("Exporter",array("uri"=>"#"));
        $item->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
        $item->setChildrenAttributes(array('class' => 'dropdown-menu'));
        $item->setAttributes(array('class' => 'dropdown'));
        //$item->setExtra('translation_domain', $menu->getExtra('translation_domain'));
        $item->setExtra('caret', true);
        //$menu->setExtra('request_uri', $menu->getExtra('request_uri'));
        $item->addChild("Rapport Global",array('route' => 'stock_export_csv'));
        
        $menu->addChild('Admin', array('route' => 'Sansthon_AdminBundle_Type_list'));
        return $menu;
    }

}
