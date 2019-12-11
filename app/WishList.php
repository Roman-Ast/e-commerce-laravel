<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    private $items = [];
    private $totalQuantity = 0;
    private $totalPrice = 0;

    public function __construct($oldWishList)
    {
        if ($oldWishList) {
            $this->items = $oldWishList->items;
            $this->totalQantity = $oldWishList->totalQantity;
            $this->totalPrice = $oldWishList->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = [
            'quantity' => 0,
            'price' => $item->price,
            'item' => $item
        ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->item[$id];
            }
        }
        $storedItem['quantity'] += 1;
        $storedItem['price'] += $item->price * $storedItem['quantity'];
        $this->items[$id] = $storedItem;
        $this->totalQuantity += 1;
        $this->totalPrice += $item->price;
    }

    public function getContent()
    {
        return $this->items;
    }

    public function remove(string $id)
    {
        foreach ($this->items as $key => $object) {
                
            if ($object['item']->toArray()['id'] == $id) {
                
                unset($this->items[$key]);
            }
        }
        
        $this->totalQuantity -= 1;
        return $this->items;
    }

    public function clear()
    {
        $this->items = [];
        return $this->items;
    }
}
