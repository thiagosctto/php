<?php

class Usuario {

    private $id;
    private $login;
    private $senha;
    private $dtcadastro;

    public function getId(){
        return $this->id;
    }
    public function setId($newId){
        $this->id = $newId;
    }

    public function getLogin(){
        return $this->login;
    }
    public function setLogin($newLogin){
        $this->login = $newLogin;
    }

    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($newSenha){
        $this->senha = $newSenha;
    }

    public function getDtCadastro(){
        return $this->dtcadastro;
    }
    public function setDtCadastro($newDtCadastro){
        $this->dtcadastro = $newDtCadastro;
    }

    public function loadById($id){
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM users WHERE id = :ID", array(
            ":ID" => $id
        ));

        if (count($result) > 0){

            $this->setData($result[0]);
        }
    }
    public static function getList(){
        $sql = new Sql();

        return $sql->select("SELECT * FROM users ORDER BY login");
    }

    public static function search($login){
        $sql = new Sql();

        return $sql->select("SELECT * FROM users WHERE login LIKE :SEARCH ORDER BY login", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login($login, $senha){
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM users WHERE login = :LOGIN AND senha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD"=>$senha
        ));

        if (count($result) > 0){

            $this->setData($result[0]);

        } else {
            throw new Exception("Login ou senha inválidos");
        }
    }

    public function setData($data){
        $this->setId($data['id']);
        $this->setLogin($data['login']);
        $this->setSenha($data['senha']);
        $this->setDtCadastro(new DateTime($data['dtcadastro']));

    }

    public function insert(){

        $sql = new Sql();

        $results = $sql->select("CALL sp_users_insert(:LOGIN, :SENHA)", array(
            'LOGIN'=>$this->getLogin(),
            'SENHA'=>$this->getSenha()
        ));

        if (count($results) > 0) {

            $this->setData($results[0]);
        }
    }

    public function update($login, $senha){
        $this->setLogin($login);
        $this->setSenha($senha);

        $sql = new Sql();

        $sql->runQuery("UPDATE users SET login = :LOGIN, senha = :SENHA WHERE id = :ID", array(
            ':LOGIN'=>$this->getLogin(),
            ':SENHA'=>$this->getSenha(),
            ':ID'=>$this->getId()
        ));
    }
    public function __construct($login = "", $senha = ""){

        $this->setLogin($login);
        $this->setSenha($senha);
    } 

    public function __toString(){
            return json_encode(array(
                "id"=>$this->getId(),
                "login"=>$this->getLogin(),
                "senha"=>$this->getSenha(),
                "dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
            ));
    }
}

?>