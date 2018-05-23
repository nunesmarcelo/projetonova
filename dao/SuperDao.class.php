<?php

class SuperDao extends MysqlDbDao{
	protected $tabela;
	protected $classe;
	
	public function __construct($tabela,$classe=null){
		parent::__construct('novatransportadora');
		$this->setTabela($tabela);
		$this->setClasse($classe);
	}
	
	public function getClasse(){
		return $this->classe;
	}
	public function setClasse($classe){
		$this->classe = $classe;
	}
	
	public function getTabela(){
		return $this->tabela;
	}
	
	public function setTabela($tabela){
		$this->tabela = $tabela;
	}
	
	
	
	public function insert($arrayCamposValores){
		return parent::insert($this->getTabela(),$arrayCamposValores);
	}
	
	public function update($arrayCamposValores,$condicao){
		return parent::update($this->getTabela(),$arrayCamposValores, $condicao);
	}
	
	public function delete($condicao){
		return parent::delete($this->getTabela(),$condicao);
	}
	
	public function select($arrayCampos,$condicao){
		return parent::select($this->getTabela(),$arrayCampos,$condicao);
	}
	
	public function search($arrayCampos,$condicao){
		$matriz = parent::select($this->getTabela(),$arrayCampos,$condicao);
		
		if($matriz ===false || empty($this->getClasse())){
			return false;
		}
		
		$classe = $this->getClasse();
		
		$objetos = array();
		foreach($matriz as $registro){
			$objeto = new $classe();
			$objeto->toObject($registro);
			$objetos[]=$objeto;
		}
		
		return $objetos;
	}
}