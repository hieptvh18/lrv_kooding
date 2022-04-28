<?php
namespace App\Http\Services\ShoppingCart;
// define interface chua cac method de handle cart
interface ShoppingCart{
    
    public function add():void;
    public function remove();
    public function all():array;
    public function clear():void;



}

?>