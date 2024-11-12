<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ReceiptController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->user_model->searchUser($this->session->userdata('userId'));
        $this->cart = $this->cart_model->getCart($this->session->userdata('userId'));
    }
	public function addreceipt() 
    {
        $totalamount = 0;
        foreach($this->cart as $cart){
            $totalamount += $cart['total'];
        }
        $userEmail = $this->user['email'];
        if($userEmail == null){
            $this->session->set_flashdata('message','Add a valid email first');
            $this->session->set_flashdata('toedit',$this->user);
            redirect('/profile');
        } else { // INSERT RECEIPTS THEN UPDATE CART
            $cartItems = $this->cart_model->getCart($this->session->userdata('userId'));
            $checkedItems = array_filter($cartItems, function ($item) {
                return $item['checked'] === 1;
            });
            $user_id = $this->session->userdata('userId');
            $total_amount = 0;
            foreach ($checkedItems as $item) {
                $total_amount += $item['total'];
            }
            $payment_method = $this->io->post('payment');
            $status = 'PROCESSING';
            $transac_key = $this->generateRandomString(60);
            $data = array(
                'user_id' => $user_id,
                'total_amount' => $total_amount,
                'payment_method' => $payment_method,
                'status' => $status,
                'transac_key' => $transac_key
            );
            $this->receipts_model->addReceipts($data);
            $receiptNumber = $this->receipts_model->searchReceiptsByTransacKey($transac_key);
            foreach ($checkedItems as $item) {
                $this->cart_model->updateCartById(['receipt_number' => $receiptNumber['id'], 'checked' => 0], $item['id']);
            }
            $this->session->set_flashdata('message','Checkout Successful');
            redirect($this->session->userdata('prevUrl'));
        }
    }
    private function generateRandomString($length) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $randomString;
    }

    public function orders() 
    {
        if (!$this->session->userdata('isLoggedIn')) {
            $this->session->set_flashdata('fail', 'Login First!');
            redirect('/login');
        } else {
            $userId = $this->session->userdata('userId');

            $data['userId'] = $this->session->userdata('userId');
            $data['userName'] = $this->session->userdata('userName');
            $data['userEmail'] = $this->session->userdata('userEmail');
            $data['role'] = $this->session->userdata('role');
            $data['userImage'] = $this->session->userdata('userImage');
            $data['products'] = $this->product_model->getProducts();
            $data['message'] = $this->session->flashdata('message');
            $data['cart'] = $this->cart_model->getAllCart();
            $data['filteredcart'] = $this->cart_model->getFilteredCart($userId);
            $data['receipts'] = $this->receipts_model->getReceipts();
            // echo var_dump($data['cart']);
            $this->session->set_userdata('prevUrl', $_SERVER['REQUEST_URI']);
            $this->call->view('orders', $data);
        }
    }
    
    public function changestatus($id)
    {
        $data = $this->receipts_model->searchReceipts($id);
        if($data['status'] != 'COMPLETED'){
            $newStatus = $data['status'] == 'PROCESSING' ? "PROCESSED" : ($data['status'] == 'PROCESSED'? "COMPLETED" : "");
            $this->receipts_model->updateReceipts(['status' => $newStatus], $id);
            $this->session->set_flashdata('message','Record ' . $newStatus);
            redirect('/orders');
        } else {
            echo 'hello';
        }
    }
}
?>
