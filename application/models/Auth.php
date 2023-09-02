<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllPosts() {
        $result = json_decode(ecurl('GET','kodesurat?search='.$search.'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start),true);
    }
}

?>