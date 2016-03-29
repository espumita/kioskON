<?php

class EditUser{
    
    private $data;
    private $checkData;
    private $db;
    
    public function __construct() {
        
        $_SESSION['id'] = 144;
        if( ! $_SESSION )
            return;
        
        include "../model/operationsDB.php";
        $this->db = new operationsDB();
        $this->data = $this->db->get(array(
            "table"     => 'users',
            "user_id"   => $_SESSION['id'],
        ));
        
    }
	
    public function showForm(){
        
        if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit']) ){
            
            if( $_POST['username'] !== $this->data['username'] )
                $this->checkData['username/string'] = $_POST['username'];
            
            if( $_POST['password'] !== $this->data['password'] )
                $this->checkData['password/string'] = $_POST['password'];
            
            if( $_POST['email'] !== $this->data['email'] )
                $this->checkData['email/email'] = $_POST['email'];
            
            if( $this->check($this->checkData) ){
                
                $this->data['table'] = "users";
                
                if( isset($this->checkData['username/string']) )
                    $this->data['username'] = $this->checkData['username/string'];
                
                if( isset($this->checkData['email/email']) )
                    $this->data['email'] = $this->checkData['email/email'];
                
                if( isset($this->checkData['password/string']) )
                    $this->data['password'] = $this->checkData['password/string'];
                
                if( $this->db->update($this->data) ){
                    echo "Cambios realizados correctamente";
                    return;
                }else{
                    echo "Hubo problemas al editar la cuenta";
                }
                
                
            }else{
                echo "rellene los campos correctamente";
            }
            
        }
        
        include "../view/editUser.php";
        
    }
    
    public function check() {
        
        if( isset($this->checkData['username/string']) ){
            if( $this->db->exist(array( 'table' => 'users', 'username' => $this->checkData['username/string'] )) ){
                echo "el usuario ya existe<br/>";
                return false;
            }
        }
        
        if( isset($this->checkData['email/email']) ){
            if( $this->db->exist(array( 'table' => 'users', 'email' => $this->checkData['email/email'] )) ){
                echo "el email ya existe<br/>";
                return false;
            }
        }
        
        if( isset($this->checkData['password/string']) ){
            if( $this->checkData['password/string'] != $_POST['re-password'] ){
                echo "las contraseñas no coinciden<br/>";
                return false;
            }
        }
        
        foreach( $this->checkData as $key => $value ){
            
            if( basename($key) == "email" ){
                if( ! strpos($value, "@") || ! strpos($value, ".") ){
                    echo "email incorrecto<br/>";
                    return false;
                }
            }
            
            if( basename($key) == "string" ){
                if( ! is_string($value) || empty($value) || strlen(trim($value)) == 0 ){
                    echo substr( $key , 0, strpos($key, "/") ) . " incorrecto<br/>";
                    return false;
                }
            }
            
        }
        
        return true;

    }
    
}

$showEdit = new EditUser();
echo $showEdit->showForm();
        
   
    



