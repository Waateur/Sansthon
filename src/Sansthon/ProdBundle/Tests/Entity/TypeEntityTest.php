<?php
namespace Sansthon\ProdBundle\Tests\Entity;
use Sansthon\ProdBundle\Entity\Type;
use Sansthon\ProdBundle\Entity\TypeRepository;
class TypeEntityTest extends \PHPUnit_Framework_TestCase
{
  public function testmarche()
  {
    $test =new Type();
    $this->assertEquals(true,true);
  }
}
