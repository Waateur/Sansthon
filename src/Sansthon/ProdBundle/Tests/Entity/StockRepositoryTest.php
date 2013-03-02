<?php 
namespace Sansthon\ProdBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Sansthon\ProdBundle\Entity\Etape;
use Sansthon\ProdBundle\Entity\Type;
class StockRepositoryFunctionalTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $stockRepo;
    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getEntityManager()
        ;
      $this->stockRepo= $this->em->getRepository('SansthonProdBundle:Stock');
    }

    public function testGetByEtapeAndType(){
         // Creation des Objets pour test 
        $etape = new Etape();
        $etape->setNom("EtapeTest1");
        $type = new Type();
        $type->setNom("TypeTest1");
        $this->em->persist($etape);
        $this->em->persist($type);
        $this->em->flush();
        $stock=$this->stockRepo->getByEtapeAndType($etape,$type);
        $this->assertEquals(0,$stock->getValue());
        //*/
        $stock->setValue(25);
        $stock->save();
        $stock2=$this->stockRepo->getByEtapeAndType($etape,$type);
        $this->assertEquals(25,$stock2->getValue());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
}
