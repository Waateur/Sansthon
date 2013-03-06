<?php

namespace Sansthon\AdminBundle\Controller\Etat;

use Admingenerator\GeneratorBundle\Controller\Doctrine\BaseController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CancelController extends BaseController
{
    /**
  *
  * Make an etat To Perte
  *
  *@Route("admin/sansthon_admin_bundle/Etat/{pk}/cancel",name="Sansthon_AdminBundle_Etat_cancel")
  *@Method("GET")
  */
     public function indexAction($pk)
    {
        try {
            $Etat = $this->getObject($pk);
            $this->process($Etat);

            $this->get('session')->setFlash('success', $this->get('translator')->trans("batch.delete.success", array(), 'Admingenerator') );
        } catch (\Exception $e) {
            $this->get('session')->setFlash('error', $this->get('translator')->trans("batch.delete.error", array(), 'Admingenerator') );
        }

        return new RedirectResponse($this->generateUrl("Sansthon_AdminBundle_Etat_list"));
    }

    protected function getObject($pk)
    {
        $Etat = $this->getDoctrine()
             ->getEntityManager()
             ->getRepository('Sansthon\ProdBundle\Entity\Etat')
             ->find($pk);

        if (!$Etat) {
            throw new \InvalidArgumentException("No Sansthon\ProdBundle\Entity\Etat found on id : $pk");
        }

        return $Etat;
    }

    protected function process(\Sansthon\ProdBundle\Entity\Etat $Etat)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo=$this->getDoctrine()
        ->getRepository('SansthonProdBundle:Etat');
        $repo->cancel($Etat);
        $em->flush();
    }
    
}
