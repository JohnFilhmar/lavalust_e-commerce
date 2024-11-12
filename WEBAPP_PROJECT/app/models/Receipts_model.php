<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Receipts_model extends Model {
    public function getReceipts()
    {
        return $this->db->table('receipts')->get_all();
    }
    public function getReceiptsByStatus($stat)
    {
        return $this->db->table('receipts')->where('status', $stat)->get_all();
    }
    public function searchReceipts($id)
    {
        return $this->db->table('receipts')->where('id', $id)->get();
    }
    public function searchReceiptsByUser($user_id)
    {
        return $this->db->table('receipts')->where('user_id', $user_id)->get_all();
    }
    public function searchReceiptsByTransacKey($key)
    {
        return $this->db->table('receipts')->where('transac_key', $key)->get();
    }
    public function addReceipts($data)
    {
        return $this->db->table('receipts')->insert($data);
    }
    public function updateReceipts($data, $id)
    {
        return $this->db->table('receipts')->where('id', $id)->update($data);
    }
    public function deleteReceipts($id)
    {
        return $this->db->table('receipts')->where('id', $id)->delete();
    }
}
?>
