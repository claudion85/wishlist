<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
class ProductTest extends TestCase
{
   
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
     /*create 10 products for test*/

     public function testInsertProducts(){
         factory(Product::class,10)->create();
         $this->assertTrue(true);
     }
}
