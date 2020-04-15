<?php

  class Users extends Entity
{
    protected $account;
    
    public function __construct($request = [])
    {
        parent::__construct($request);
        $this->isAnonymous();
    }

    protected function init(): void {
        $query = <<<SQL
CREATE TABLE IF NOT EXISTS usuarios (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
correo VARCHAR(225) NOT NULL,
clave VARCHAR(225) NOT NULL
)
SQL;
    
        if(!$this->database->query($query)) {
            throw new \Exception($this->database->error);
        }
    }

    public function login():bool {

        $clave = md5($this->request['password']);
        $query = sprintf("SELECT id FROM usuarios WHERE correo = '%s' AND clave = '%s'",
            $this->request['email'],
            $clave 
    );    
    
    $result = $this->database->query($query);
    if(1 == $result->num_rows) {
        $account = $result->fetch_object();
        $account->correo = $this->request['correo'];
        $_SESSION['account'] = $account;

                 return TRUE;
            }
        return FALSE;

       }

    public function isAnonymous(): bool {
        
        if(!is_null($this->account)) {
            return FALSE;
        }

        if(!empty($_SESSION['account'])) {
            $this->account = $_SESSION['account'];
            return FALSE;
        }
        return TRUE;
    }

   
}