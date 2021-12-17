<?php

namespace App\Models;

class Algoritma{

    public function encrypt($plainText)
    {
        return base64_encode($plainText);
    }

    public function decrypt($chiperText)
    {
        return base64_decode($chiperText);
    }
    
}