<?php

class LancamentoModel implements ArrayToObjectConverterModel{
	protected $lancamento_id;
	protected $empresa;
	protected $dia;
	protected $pago;
	protected $pagamento;
	protected $valor;
	
	public function getLancamentoId(){
		return $this->lancamento_id;
	}
	public function getEmpresa(){
		return $this->empresa;
	}
	public function getDia(){
		return $this->dia;
	}
	public function getPago(){
		return $this->pago;
	}
	public function getPagamento(){
		return $this->pagamento;
	}
	public function getValor(){
		return $this->valor;
	}
	
	
	public function setLancamentoId($lancamento_id){
		$this->lancamento_id = $lancamento_id;
	}
	public function setEmpresa($empresa){
		$this->empresa = $empresa;
	}
	public function setDia($dia){
		$this->dia = $dia;
	}
	public function setPago($pago){
		$this->pago = $pago;
	}
	public function setPagamento($pagamento){
		$this->pagamento = $pagamento;
	}
	public function setValor($valor){
		$this->valor = $valor;
	}
	
	
	public function toObject(array $array){
		$lancamento_id     = empty($array['lancamento_id']) ? null  : $array['lancamento_id'];
		$empresa     = empty($array['empresa']) ? null  : $array['empresa'];
		$dia     = empty($array['dia']) ? null  : $array['dia'];
		$pago     = empty($array['pago']) ? null  : $array['pago'];
		$pagamento     = empty($array['pagamento']) ? null  : $array['pagamento'];
		$valor     = empty($array['valor']) ? null  : $array['valor'];
		
		
		$this->setLancamentoId($lancamento_id);
		$this->setEmpresa($empresa);
		$this->setDia($dia);
		$this->setPago($pago);
		$this->setPagamento($pagamento);
		$this->setValor($valor);
	}
	
	public function valid(){
		if(empty($this->getEmpresa()) || empty($this->getDia()) || empty($this->getValor())){

			return false;
		}
		
		return true;
	}
}