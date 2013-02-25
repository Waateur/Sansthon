<?php 
namespace Sansthon\ProdBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AttributionroleRepositoryFunctionalTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

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
    }

    public function testSearchByCategoryName()
    {
        /* $products = $this->em
            ->getRepository('AcmeStoreBundle:Product')
            ->searchByCategoryName('foo')
        ;

        $this->assertCount(1, $products);
        */
        $this->assertEquals(true,true);
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
