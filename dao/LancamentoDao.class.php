<?php

class LancamentoDao extends SuperDao{
	public function __construct(){
		parent::__construct('lancamentos','LancamentoModel');
	}
	
	public function search($campos = array(),$condicao = array()){
		$campos = empty($campos) ? array('*') : $campos;
		$condicao = empty($restricoes) ? '1' : $restricoes;
		
		return parent::search($campos , $condicao);
	}
	
	public function insert($lancamento){
		$arrayCamposValores['empresa'] = $lancamento->getEmpresa();
		$arrayCamposValores['dia'] = $lancamento->getDia();
		$arrayCamposValores['pago'] = $lancamento->getPago();
		$arrayCamposValores['pagamento']= $lancamento->getPagamento();
		$arrayCamposValores['valor'] = $lancamento->getValor();
		return parent::insert($arrayCamposValores);
	}

	public function update($lancamento){
		

		$arrayCamposValores['empresa'] = $lancamento->getEmpresa();
		$arrayCamposValores['dia'] = $lancamento->getDia();
		$arrayCamposValores['pago'] = $lancamento->getPago();
		$arrayCamposValores['pagamento']= $lancamento->getPagamento();
		$arrayCamposValores['valor'] = $lancamento->getValor();
		$condicao = "lancamento_id = {$lancamento->getlancamentoId()}";

		return parent::update($arrayCamposValores,$condicao);
	}

	public function delete($ids){
		$ids = implode(',',$ids);
		$condicao = "lancamento_id in($ids)"; // "id Usuario in (1,3,4,10, ... , n)"
		
		//retorna quantos foram removidos.
		return parent::delete($condicao);
	}
}