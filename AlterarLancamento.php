<?php 
	require_once 'funcoes/funcoes.php';
	
	$view = new LancamentoView();
	
	$mensagem = null;
	
	$lancamento_id = empty($_REQUEST['lancamento_id']) ? '' : $_REQUEST['lancamento_id'];
	$dia = empty($_REQUEST['dia']) ? '' : $_REQUEST['dia'];
	$empresa = empty($_REQUEST['empresa']) ? '' : $_REQUEST['empresa'];
	$pago = empty($_REQUEST['pago']) ? '' : $_REQUEST['pago'];
	$pagamento = empty($_REQUEST['pagamento']) ? '' : $_REQUEST['pagamento'];
	$valor = empty($_REQUEST['valor']) ? '' : $_REQUEST['valor'];
	

	if(!empty($_REQUEST['Salvar'])){
		$lancamento_id = $resposta = $view->insert();
		if(!empty($lancamento_id)){
			$mensagem = "Dados salvos com sucesso.";
		}
		else{
			$mensagem = "Não salvo. Dados inconsistentes ou já existentes.";
		}
	}
	
	$html = '
		<section>
		<h3> Alteração de Lancamento </h3>';
		
		if(!empty($mensagem)){
			$html .= "
				<p class=\"msg\">{$mensagem}</p>
			";
		}
		
		$html .= '
			<section>
				<form action="CadastroLancamento.php" method="post">
					<fieldset>
						
						<p>
							<label>Empresa:</label>
							<input type="text" name="empresa" placeholder="ex: Ial, Itaipu , Petrobras" value="'.$empresa.'"/>
						</p>
						<p>
							<label>Data:</label>
							<input type="date" name="dia" placeholder="18/05/2017" value="'.$dia.'"/>
						</p>
						<p>
							<label>Pago:</label>
							<select name="pago">
							<option value="0">NÃO</option>
							<option value="1">SIM</option>
							</select>
						</p>
						<p>
							<label>Forma de pagamento:</label>
							<input type="text" name="pagamento" placeholder="ex: vista,crédito,cheque" value="'.$pagamento.'"/>
						</p>
						<p>
							<label>Valor:</label>
							<input type="text" name="valor" placeholder="valor" value="'.$valor.'"/>
						</p>
							<input type="submit" name="Salvar" value="Salvar" />
						</p>
						<input type="hidden" name="lancamento_id" value="'.$lancamento_id.'"/>
					</fieldset>
				</form>
				<br/>
			</section>
		';
		
		$titulo = 'Alterar Lancamento';
		require_once 'Layout.php';
					