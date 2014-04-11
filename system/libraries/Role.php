<?php
/**
 * Created by PhpStorm.
 * User: adambull
 * Date: 10/04/2014
 * Time: 19:59
 */

class Role {
    protected function __construct() {
        $this->permissions = array();
        $this->db->load->database();
    }

} 