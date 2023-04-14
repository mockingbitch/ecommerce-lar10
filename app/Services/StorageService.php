<?php 

namespace App\Services;

use App\Models\Storage;

class StorageService
{
    public function subtractOrder(int $id, int $quantity)
    {
        $product = Storage::where('id', $id)->first();
        $result = $product['quantity'] - $quantity;
        if ($result >=0) {
            $product->update(['quantity' => $result]);
            $product->save();

            return true;
        } else {
            return false;
        }
    }

    public function update(int $id, int $request)
    {
        $product = $this->stockRepo->find($id);
        $quantity = $product->quantity;

        if (isset($request['import']) || isset($request['export'])) {
            if ($request['export']<=$quantity) {
                $newQuantity = $quantity + $request['import'] - $request['export'];
                $this->stockRepo->update($id, ['quantity'=>$newQuantity]);
                $after = $this->stockRepo->find($id);
                $quantityAfter = $after->quantity;

                if ($quantityAfter==0) { 
                    $this->stockRepo->update($id, ['status'=>0]);
                } else {
                    $this->stockRepo->update($id, ['status'=>1]);
                }

                return true;
            }

            return false;
        } 
        
        return false;
    }
}