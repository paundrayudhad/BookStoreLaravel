<?php

// app/Models/Cart.php
namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Cart
{
    protected $items;

    public function __construct()
    {
        $this->items = Session::get('cart', []);
    }

    public function add($book, $quantity = 1)
    {
        $id = $book->id;

        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] += $quantity;
        } else {
            $this->items[$id] = [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'price' => $book->price,
                'quantity' => $quantity,
                'cover' => $book->cover_image
            ];
        }

        $this->save();
    }

    public function remove($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
            $this->save();
        }
    }

    public function update($id, $quantity)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] = $quantity;
            $this->save();
        }
    }

    public function clear()
    {
        Session::forget('cart');
        $this->items = [];
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    public function count()
    {
        return count($this->items);
    }

    protected function save()
    {
        Session::put('cart', $this->items);
    }
}
