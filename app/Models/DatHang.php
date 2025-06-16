<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use App\Models\SanPham;
use Illuminate\Database\Eloquent\Model;

class DatHang extends Model
{
    public $items = [];
    public $tongtien = 0;
    public $tongsoluong = 0;
    protected $userId;
    protected $sessionKey;

    public function __construct($userId = null)
    {
//parent::__construct();
        $this->userId = $userId ?? (Auth::id() ?? session()->getId());
        $this->sessionKey = 'cart_' . $this->userId;

        $this->items = session($this->sessionKey, []);

        $this->refreshCart();
    }
    public function count()
    {
        return $this->tongsoluong;
    }
    public function add($product,$quantity)
    {
        if (!is_object($product)) {
            $product = SanPham::with('banggia')->findOrFail($product);
        }

         if (isset($this->items[$product->id])) {
            $this->items[$product->id]->quantity += $quantity;
        } else {
            $price = 0;
            if ($product->banggia) {
                $price = floatval($product->banggia->Gia);
            }

            $dathang_item = (object)[
                'id' => $product->id,
                'name' => $product->TenGoi,
                'image' => $product->HinhAnh,
                'price' => $price,
                'quantity' => $quantity,
            ];

            $this->items[$product->id] = $dathang_item;
        }

        session([$this->sessionKey => $this->items]);
        $this->refreshCart();
    }

    public function updateC($id, $qtt)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]->quantity = $qtt;
            session([$this->sessionKey => $this->items]);
            $this->refreshCart();
        }
    }

    public function deleteC($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
            session([$this->sessionKey => $this->items]);
            $this->refreshCart();
        }
    }

    public function clear()
    {
        session([$this->sessionKey => null]);
        $this->items = [];
        $this->tongtien = 0;
        $this->tongsoluong = 0;
    }

    public function getTotalPrice()
    {
        $total = 0;
    
        // Check if $this->items is an array or object
        if (is_array($this->items) || is_object($this->items)) {
            foreach ($this->items as $item) {
                $price = is_numeric($item->price) ? (float)$item->price : 0;
                $total += $item->quantity * $price;
            }
        }
        
        return $total;
    }
    

    public function getTotalQuantity()
    {
        $total = 0;
    
    // Check if $this->items is an array or object
    if (is_array($this->items) || is_object($this->items)) {
        foreach ($this->items as $item) {
            $total += $item->quantity;
        }
    }

    return $total;
    }
    private function refreshCart()
    {
        $this->tongsoluong = $this->getTotalQuantity();
        $this->tongtien = $this->getTotalPrice();
    }
}
