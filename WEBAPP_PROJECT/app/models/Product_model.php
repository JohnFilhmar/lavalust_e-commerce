<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends Model {
	
    public function getProducts()
    {
        return $this->db->table('products')->get_all();
    }
    public function searchProducts($id)
    {
        return $this->db->table('products')->where('id', $id)->get();
    }
    public function deleteProduct($id)
    {
        return $this->db->table('products')->where('id', $id)->delete();
    }
    public function addProducts($data)
    {
        return $this->db->table('products')->insert($data);
    }
    public function updateProducts($data, $id)
    {
        return $this->db->table('products')->where('id', $id)->update($data);
    }
}
?>
