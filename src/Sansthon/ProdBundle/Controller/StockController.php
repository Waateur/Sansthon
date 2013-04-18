<?php

namespace Sansthon\ProdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Sansthon\ProdBundle\Entity\Stock;
use Sansthon\ProdBundle\Form\StockType;

/**
 * Stock controller.
 *
 * @Route("/stock")
 */
class StockController extends Controller {

    /**
     * Lists all Stock entities.
     *
     * @Route("/", name="stock")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $stocks = $em->getRepository('SansthonProdBundle:Stock')->getAllEvenArray();
        $etats = $em->getRepository('SansthonProdBundle:Etat')->getSumUnstocked();
        $etapes = $em->getRepository('SansthonProdBundle:Etape')->findEvenOrderedByDisplayorder();
        $types = $em->getRepository('SansthonProdBundle:Type')->findBy(array(), array("reference" => "ASC"));
        return array(
            'stocks' => $stocks,
            'etats' => $etats,
            'etapes' => $etapes,
            'types' => $types
        );
    }
   /**
     * Finds and displays a Stock entity.
     *
     * @Route("/type/{id}", name="stock_type_show" , defaults={"_format"="json"})
     * @Method("GET")
     * @Template()
     */
   /* public function showStockAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SansthonProdBundle:Stock')->findby(array("type_id" => $id));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stock entity.');
        }

        return array(
            'entities'=> $entities
        );
    }
*/
    /**
     * Lists all Stock entities.
     *
     * @Route("/export.csv", name="stock_export_csv")
     * @Method("GET")
     * 
     */
    public function exportCsvAction() {
        $em = $this->getDoctrine()->getManager();

        $stocks = $em->getRepository('SansthonProdBundle:Stock')->getAllEvenArray();
        $etats = $em->getRepository('SansthonProdBundle:Etat')->getSumUnstocked();
        $etapes = $em->getRepository('SansthonProdBundle:Etape')->findEvenOrderedByDisplayorder();
        $types = $em->getRepository('SansthonProdBundle:Type')->findBy(array(), array("reference" => "ASC"));
        $handle = fopen('php://memory', 'r+');
        $title = array("Référence", "Objectif");
        foreach ($etapes as $etape) {
            array_push($title,$etape->getNom());
        }
        fputcsv($handle, $title);

        foreach ($types as $type) {
            $row = array();
            array_push($row, $type->getReference() . " " . $type->getNom());
            array_push($row, $type->getObjectif());
            foreach ($etapes as $etape) {
                $td =array();
                if (isset($stocks[$type->getId()][$etape->getId()])) {
                    array_push($td, $stocks[$type->getId()][$etape->getId()]);
                } else {
                    array_push($td, 0);
                }
                if (isset($etats[$type->getId()][$etape->getId()]) ){
                    array_push($td, "+" . $etats[$type->getId()][$etape->getId()]);
                } else {
                    array_push($td, "+0");
                }
                array_push($row,implode("",$td));
            }
           fputcsv($handle, $row);
        }
        
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        return new Response($content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="export.csv"'
        ));
    }
}

