<?php
namespace Sansthon\AdminBundle\Menu;
use Admingenerator\GeneratorBundle\Menu\AdmingeneratorMenuBuilder;
use symfony\component\httpfoundation\request;

class AdminMenuBuilder extends AdmingeneratorMenuBuilder {

  /**
   * @param Request $request
   * @param Router  $router
   */
  public function createAdminMenu(Request $request)
  {
    $menu = parent::createAdminMenu($request);

    /**
     * Translation domain is passed down to child elements
     * in addNavLinkURI, addNavLinkRoute, addDropdownMenu methods.
     */
    //$menu->setExtra('translation_domain', 'Admingenerator');
    $produitmenu =$this->addDropdownMenu($menu,'Production');
    $this->addNavLinkRoute($produitmenu,'Gestions des en cours','Sansthon_AdminBundle_Etat_list');
    $this->addNavLinkRoute($produitmenu,'Gestions des pertes','Sansthon_AdminBundle_Perte_list');
    $this->addNavLinkRoute($produitmenu,'Gestions des stocks','Sansthon_AdminBundle_Stock_list');
    
    $refmenu=$this->addDropdownMenu($menu,'Références');
    $this->addNavLinkRoute($refmenu,'Gestions des références','Sansthon_AdminBundle_Type_list');
    
    $rolemenu =$this->addDropdownMenu($menu,'Personnes et Roles');
    $this->addNavLinkRoute($rolemenu,'Gestion des Personnes','Sansthon_AdminBundle_Personne_list');
    $this->addNavLinkRoute($rolemenu,'Gestion des Roles','Sansthon_AdminBundle_Role_list');

    $etapemenu =$this->addDropdownMenu($menu,'Etape');
    $this->addNavLinkRoute($etapemenu,'Gestion des étapes','Sansthon_AdminBundle_Etape_list');
    /*$this->addNavLinkRoute($etapemenu,'Creation des chemins','Sansthon_AdminBundle_Etapefille_list');*/

    
    return $menu;
  }
}
