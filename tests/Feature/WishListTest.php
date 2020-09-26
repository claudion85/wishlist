<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\User;
use App\Product;
class WishListTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    
     /* Test for create a new wishlist*/
     /* the route is protected by authentication */
     /* the test create a new fake user with passport authentication*/
     
    public function testCreateWishlist(){
        Passport::actingAs(
            factory(User::class)->create(),
            ['wishlist']
        );
        $wishlistData = [

            "wishlist_name" => $this->faker->name, //GENERATE A RANDOM NAME OF WISHLIST
            "items" =>$this->getListOfItemsfromProduct() //GENERATE A COMMA SEPARATED LIST OF PRODUCTS               
            ];
        
        $this->json('POST','api/wishlist',$wishlistData,['Accept'=>'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "message" => "item added successfully",
               
            ]);
    } 
   

     /* Test for generate error with empty fields*/
     /* the route is protected by authentication */
     /* the test create a new fake user with passport authentication*/
    public function testEmptyWishListFields(){
        
        Passport::actingAs(
            factory(User::class)->create(),
            ['wishlist']
        );
        $wishlistData = [
            "wishlist_name" => "",
            "items" => "",
            
            
        ];

        $this->json('POST','api/wishlist',$wishlistData,['Accept'=>'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "wishlist_name" => ["The wishlist name field is required."],
                    "items" => ["The items field is required."],
                   
                ]
            ]);
    }

    /*THIS FUNCTION EXTRACTS A LIST OF ID FROM EXISTENT
     PRODUCTS AND RETURN A RANDOM COMMA SEPARATED 
     LIST OF ID OF PRODUCTS (MIN 5, MAX 10)*/ 
    private function getListOfItemsfromProduct()
    {
        $product=Product::pluck('id')->toArray();
        
        $response=array();
        for($i=0;$i<=rand(5,10);$i++){
            $response[]=array_rand($product,1);
        }
        $response=(implode(',',$response));
        return $response;
    }
}
