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

            $row = $result[0];

            $this->setId($row['id']);
            $this->setLogin($row['login']);
            $this->setSenha($row['senha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));
        }
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