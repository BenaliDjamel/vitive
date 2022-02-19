<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


final class ProjectTest extends TestCase
{

     /**
     * @test
     */
    public function sum_of_two_numbers(): void
    {
        $this->assertEquals(5, 2 + 3);
    }

   
}




