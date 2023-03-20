<?php
namespace App\Services;

class OrderService
{
    public function createSessionOrder($table, $product, $request)
    {
        $order = session()->get('order');
        $table_id = $table->id;
        $product_id = $product->id;
        
        if (null !== $order && isset($order[$table_id][$product_id])) :
            $order[$table_id][$product_id]['quantity'] += $request['quantity'] ?? 1;
            $order[$table_id][$product_id]['note'] = $request['note'] ? $order[$table_id][$product_id]['note'] . '<br/>' . $request['note'] : $order[$table_id][$product_id]['note']; //add note for product
        else :
            $order[$table_id][$product_id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request['quantity'] ?? 1,
                'image' => $product->image,
                'note' => $request['note'] ?? null
            ];
        endif;

        session()->put('order', $order);
        print_r($order);
    }
}