<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
    public function getUsers()
    {
        return $this->db->table('webproject')->get_all();
    }
    public function getUserByUsername($username) 
    {
        $data = $this->getUsers();
        // for($i = 0; $i < count($data); $i++){
        //     if($username === $data[$i]['username']){
        //         return [
        //             'id' => $data[$i]['id'],
        //             'password' => $data[$i]['password'],
        //             'image' => $data[$i]['image'],
        //             'email' => $data[$i]['email'],
        //             'role' => $data[$i]['role'],
        //             'status' => $data[$i]['status']
        //         ];
        //     } else {
        //         return null;
        //     }
        // }
        // return $data[1]['username'];
        foreach($data as $users){
            if($username === $users['username']){
                return [
                    'id' => $users['id'],
                    'password' => $users['password'],
                    'image' => $users['image'],
                    'email' => $users['email'],
                    'role' => $users['role'],
                    'status' => $users['status']
                ];
            }
        }
        return null;
    }
    public function searchUser($id)
    {
        return $this->db->table('webproject')->where('id', $id)->get();
    }
    public function addUser($data)
    {
        return $this->db->table('webproject')->insert($data);
    }
    public function updateUser($data, $id)
    {
        return $this->db->table('webproject')->where('id', $id)->update($data);
    }
    public function deleteUser($id)
    {
        return $this->db->table('webproject')->where('id', $id)->delete();
    }
}
?>
