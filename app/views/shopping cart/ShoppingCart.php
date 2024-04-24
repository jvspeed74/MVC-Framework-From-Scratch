<?php
/**
 * Author : Abrar Sabel
 * Date : 4/24/24
 * File : ?{FILE_NAME}
 * Description :
 */

class ShoppingCart {
    private array $items;

    public function __construct() {
        $this->items = [];
    }

    public function addItem(Product $product, int $quantity = 1) {
        if ($quantity <= 0) {
            throw new InvalidArgumentException("Quantity must be greater than zero.");
        }

        if (isset($this->items[$product->getProductID()])) {
            $this->items[$product->getProductID()]['quantity'] += $quantity;
        } else {
            $this->items[$product->getProductID()] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }
    }

    public function removeItem(string $productID) {
        unset($this->items[$productID]);
    }

    public function updateQuantity(string $productID, int $quantity) {
        if ($quantity <= 0) {
            throw new InvalidArgumentException("Quantity must be greater than zero.");
        }

        if (isset($this->items[$productID])) {
            $this->items[$productID]['quantity'] = $quantity;
        }
    }

    public function getItems(): array {
        return $this->items;
    }

    public function getTotalPrice(): float {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }
}
