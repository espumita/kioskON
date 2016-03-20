<?php

class Register{
    
    private $data;
    private $db;
	
    public function showForm(){
        
        if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register']) ){
            
            $this->data = array(
                "email/email"           => $_POST["email"],
                "password/string"       => $_POST["password"],
                "re-password/string"    => $_POST["re-password"],
                "username/string"       => $_POST["username"],
                "type/string"           => $_POST["type"],
            );
            
            include "../model/operationsDB.php";
            if( $this->check($this->data) ){
                
                $this->data = array(
                    "email"     => $this->data['email/email'],
                    "password"  => md5( $this->data['password/string'] ),
                    "table"     => 'users',
                    "username"  => $this->data['username/string'],
                    "type"      => $this->data["type/string"],
                );
                
                if( $this->db->insert($this->data) ){
                    echo "Registro realizado correctamente";
                    return;
                }else{
                    echo "Hubo problemas al crear la cuenta";
                }
                
                
            }else{
                echo "rellene los campos correctamente";
            }
            
        }
        
        include "../view/register.php";
        
    }
    
    public function check(array $data) {
        
        $this->db = new operationsDB();
        if( $this->db->exist(array( 'table' => 'users', 'username' => $data['username/string'] )) ){
            echo "el usuario ya existe<br/>";
            return false;
        }
        
        if( $this->db->exist(array( 'table' => 'users', 'email' => $data['email/email'] )) ){
            echo "el email ya existe<br/>";
            return false;
        }
        
        if( $data["password/string"] != $data["re-password/string"] ){
            echo "las contraseñas no coinciden<br/>";
            return false;
        }
        
        foreach( $data as $key => $value ){
            
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

$showRegister = new Register();
echo $showRegister->showForm();
        
   
    


