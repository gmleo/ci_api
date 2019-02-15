<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

  const DB_TABLE = 'users';


  public function all()
  {
    $query = $this->db->get(self::DB_TABLE);
    return $query->num_rows() ? $query->result() : array();
  }

  public function get_by_user_id($id='')
  {
    $this->db->where('id', $id);
    $query = $this->db->get(self::DB_TABLE);
    return $query->num_rows() ? $query->row() : array();
  }

  public function insert($data=array())
  {
    $this->db->insert(self::DB_TABLE, $data);
    $id = $this->db->insert_id();

    return  $id;
  }

  public function update($id='', $data = array())
  {
    $this->db->where('id', $id);
    return $this->db->update(self::DB_TABLE, $data);
  }

  public function delete($id='')
  {
    $this->db->where('id', $id);
    return $this->db->update(self::DB_TABLE, array('status' => 0));
  }

  public function login($user='', $pass='')
  {
    $this->db->where('username', $user);
    $this->db->where('password', crypt($pass, '$2a$07$YourSaltIsA22ChrString$'));
    $query = $this->db->get(self::DB_TABLE); // echo $this->db->last_query();
    return $query->num_rows() ? $query->row() : array();
  }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
