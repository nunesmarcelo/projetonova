<?php
	
	
	class LancamentoView{
		public function search(){
			$controller = new LancamentoController();
			return $controller->search();
		}	
		
		public function insert(){
			$lancamento = new LancamentoModel();
			$lancamento->setEmpresa($_REQUEST['empresa']);
			$lancamento->setDia($_REQUEST['dia']);
			$lancamento->setPago($_REQUEST['pago']);
	        $lancamento->setPagamento($_REQUEST['pagamento']);
			$lancamento->setValor($_REQUEST['valor']);

			$lancamento_id = empty($_REQUEST['lancamento_id']) ? null : $_REQUEST['lancamento_id'];
			$lancamento->setLancamentoId($lancamento_id);
			
			$controller = new LancamentoController();
			return $controller->insert($lancamento);
		}

		public function delete(){
			if(empty($_REQUEST['lancamento_id'])){
				return 0;
			}
			$lancamentos_ids = $_REQUEST['lancamento_id'];
			$controller = new LancamentoController();
			return $controller->delete($lancamentos_ids);
		}
	}