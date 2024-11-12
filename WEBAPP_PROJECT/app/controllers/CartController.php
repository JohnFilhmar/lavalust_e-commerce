<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class CartController extends Controller {
    public function addToCart($id)
    {
        if($this->session->userdata('isLoggedIn')){
            $item = $this->product_model->searchProducts($id);
            $oldcart = $this->cart_model->searchCart($id);
            $newcart = array_filter($oldcart, function ($cart) {
                return $cart['receipt_number'] === null;
            });
            if(!$newcart){
                $bind = array(
                    'item_id' => $id,
                    'user_id' => $this->session->userdata('userId'),
                    'quantity' => 1,
                    'total' => $item['price'],
                    'checked' => 1,
                );
                $this->cart_model->addCart($bind);
                $this->updateProductQuantity($id, 1);
                $this->session->set_flashdata('message', 'Item Added to the Cart!');
                redirect('/');
            } else {
                foreach($newcart as $c) {
                    if (!$c || $c['receipt_number'] !== null) {
                        $bind = array(
                            'item_id' => $id,
                            'user_id' => $this->session->userdata('userId'),
                            'quantity' => 1,
                            'total' => $item['price'],
                            'checked' => 1,
                        );
                        $this->cart_model->addCart($bind);
                        $this->updateProductQuantity($id, 1);
                        $this->session->set_flashdata('message', 'Item Added to the Cart!');
                        redirect('/');
                    }elseif ($c && $c['receipt_number'] === null) {
                        $newQuantity = $c['quantity'] + 1;
                        $bind = array(
                            'quantity' => $newQuantity,
                            'total' => $item['price'] * $newQuantity,
                        );
                        $this->cart_model->updateCart($bind, $id);
                        $this->updateProductQuantity($id, 1);
                        $this->session->set_flashdata('message', 'Item Added to the Cart!');
                        redirect('/');
                    }
                }
            }
        } else {
            $this->session->set_flashdata('fail','Login First!');
            redirect('/login');
        }
    }    
    
    private function updateProductQuantity($id, $quantityChange)
    {
        $products = $this->product_model->searchProducts($id);
        $currentQuantity = $products['quantity'];
        $this->product_model->updateProducts(['quantity' => $currentQuantity - $quantityChange],$id);
    }

    public function changeCheck($id)
    {
        $item = $this->cart_model->searchCartId($id);
        $newCheck = $item['checked'] == true ? 0 : 1;
        // echo var_dump($newCheck);
        $bind = array(
            'checked' => $newCheck,
        );
        $this->cart_model->updateCartById($bind, $id);
        $this->session->set_flashdata('message',$item['checked'] == true ? "Excluded for checkout!" : "Included for checkout!");
        redirect($this->session->userdata('prevUrl'));
    }

    public function remove($id)
    {
        $data = $this->cart_model->searchCartId($id);
        if ($data) {
            $product = $this->product_model->searchProducts($data['item_id']);
            if ($product) {
                $newQuantity = $product['quantity'] + $data['quantity'];
                $this->product_model->updateProducts(['quantity' => $newQuantity], $data['item_id']);
                $this->cart_model->deleteCart($id);
                $this->session->set_flashdata('message', 'Successfully Removed!');
            } else {
                $this->session->set_flashdata('message', 'Error: Product not found.');
            }
        } else {
            $this->session->set_flashdata('message', 'Error: Cart item not found.');
        }
        redirect('/');
    }
    
}
?>
