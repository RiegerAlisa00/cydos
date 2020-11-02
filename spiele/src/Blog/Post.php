<?php

namespace App\Blog;
use App\User\User as SomeUser;
class Post implements PostInterface
{
    public $title;
    
    public $user;
    
    public function __construct()
    {
        $this->user = new SomeUser();
    }
}
?>