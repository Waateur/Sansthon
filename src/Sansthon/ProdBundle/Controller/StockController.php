<?php

namespace Sansthon\ProdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sansthon\ProdBundle\Entity\Stock;
use Sansthon\ProdBundle\Form\StockType;

/**
 * Stock controller.
 *
 * @Route("/stock")
 */
class StockController extends Controller
{
    /**
     * Lists all Stock entities.
     *
     * @Route("/", name="stock")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SansthonProdBundle:Stock')->findAllArray();

        return array(
            'entities' => $entities,
        );
    }
}
