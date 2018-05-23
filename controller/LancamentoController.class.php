<?php
	
	class LancamentoController{
		public function search(){
			$dao = new LancamentoDao();
			return $dao->search();
		}
		
		public function insert($lancamento){
			if(!$lancamento->valid()){
				return false;
			}
			
			$dao = new LancamentoDao();

			if(!empty($lancamento->getLancamentoId())){
				return $dao->update($lancamento);
			}
			
			return $dao->insert($lancamento);
		}

		public function delete($lancamentos_ids){
			$dao = new lancamentoDao();
			return $dao->delete($lancamentos_ids);
		}
	}