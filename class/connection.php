<?php

Class Connect_passnt
{
    
    protected $host = '10.20.29.230';
    protected $user = 'dbreader';
    protected $pswd = 'PF5HbPUpr4py8';
    protected $dbname = 'passnt';
    protected $con = null;
    
    
    function __construct(){} //metodo construtor
    
    #metodo que inicia conexao 
    function open(){
        $this->con = @pg_connect("host=$this->host user=$this->user
        password=$this->pswd dbname=$this->dbname");
        return $this->con;
    }
 
    #metodo que encerra a conexao
    function close(){
        @pg_close($this->con);
    }
    
    #metodo verifica status da conexao
    function statusCon(){
        if($this->con){
        echo "<h3>O sistema está conectado à  [$this->dbname] em [$this->host].</h3>";
        exit;
    }
    else{
        echo "<h3>O sistema não está conectado à  [$this->dbname] em [$this->host].</h3>";
    }
    }


}

Class Connect_setups
{

//Local Access
//protected $host = 'SBRIPVW720019';


protected $host = 'localhost';
protected $user = 'postgres';
protected $pswd = 'schott';
protected $dbname = 'setups';
protected $con = null;
 

 
/*   
protected $host = '10.20.29.247';
protected $user = 'setups';
protected $pswd = 'processdb';
protected $dbname = 'setups';
protected $con = null;
*/
   
function __construct(){} //metodo construtor

#metodo que inicia conexao 
function open(){
    $this->con = @pg_connect("host=$this->host user=$this->user
    password=$this->pswd dbname=$this->dbname");
    return $this->con;
}

#metodo que encerra a conexao
function close(){
    @pg_close($this->con);
}

#metodo verifica status da conexao
function statusCon(){
    if($this->con){
    echo "<h3>O sistema esta conectado a�  [$this->dbname] em [$this->host].</h3>";
    exit;
}
else{
    echo "<h3>O sistema nao esta conectado a  [$this->dbname] em [$this->host].</h3>";
    }
}


}

Class Connect_users{
    //Local Access
    //protected $host = 'SBRIPVW720019';
    /*
    protected $host = 'localhost';
    protected $user = 'postgres';
    protected $pswd = 'schott';
    protected $dbname = 'integration_users';
    protected $con = null;
    */
    
     
     protected $host = '10.20.29.247';
     protected $user = 'integration_users';
     protected $pswd = 'users';
     protected $dbname = 'integration_users';
     protected $con = null;
     
    
    function __construct(){} //metodo construtor
    
    #metodo que inicia conexao
    function open(){
        $this->con = @pg_connect("host=$this->host user=$this->user
    password=$this->pswd dbname=$this->dbname");
        return $this->con;
    }
    
    #metodo que encerra a conexao
    function close(){
        @pg_close($this->con);
    }
    
    #metodo verifica status da conexao
    function statusCon(){
        if($this->con){
            echo "<h3>O sistema esta conectado a�  [$this->dbname] em [$this->host].</h3>";
            exit;
        }
        else{
            echo "<h3>O sistema nao esta conectado a  [$this->dbname] em [$this->host].</h3>";
        }
    }
    
}

?>

