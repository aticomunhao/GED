<?php namespace Entity;

/**
 * @Entity @Table(name="produtos")
 **/
class Produtos
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $descricao;
    
    

    public function getId()
    {
        return $this->id ;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($name)
    {
        $this->descricao = $name;
    }
    
    
}