<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Cart_model extends Model {
    public function getAllCart()
    {
        return $this->db->raw("
            SELECT
                p.itemname,
                p.compatibility,
                p.description,
                p.image,
                p.price,
                c.id,
                c.quantity,
                c.total,
                c.receipt_number,
                c.checked
            FROM
                cart c
            JOIN
                products p ON c.item_id = p.id");
    }
    public function getCart($userId)
    {
        return $this->db->raw("
            SELECT
                p.itemname,
                p.compatibility,
                p.description,
                p.image,
                p.price,
                c.id,
                c.quantity,
                c.total,
                c.receipt_number,
                c.checked
            FROM
                cart c
            JOIN
                products p ON c.item_id = p.id
            WHERE
                c.user_id = ?", [$userId]);
    }
    public function getFilteredCart($userId)
    {
        $data = $this->db->raw("
            SELECT
                p.itemname,
                p.compatibility,
                p.description,
                p.image,
                p.price,
                c.id,
                c.quantity,
                c.total,
                c.receipt_number,
                c.checked
            FROM
                cart c
            JOIN
                products p ON c.item_id = p.id
            WHERE
                c.user_id = ?", [$userId]);
        $filteredData = array_filter($data, function ($cart) {
            return $cart['receipt_number'] === null;
        });
        return $filteredData;
    }
    public function searchCart($id)
    {
        return $this->db->table('cart')->where('item_id', $id)->get_all();
    }
    public function searchCartId($id)
    {
        return $this->db->table('cart')->where('id', $id)->get();
    }
    public function deleteCart($id)
    {
        return $this->db->table('cart')->where('id', $id)->delete();
    }
    public function addCart($data)
    {
        return $this->db->table('cart')->insert($data);
    }
    public function updateCart($data, $id)
    {
        return $this->db->table('cart')->where('item_id', $id)->update($data);
    }
    public function updateCartById($data, $id)
    {
        return $this->db->table('cart')->where('id', $id)->update($data);
    }
}
?>
