<?php 
	require_once 'funcoes/funcoes.php';
	
	$view = new LancamentoView();
	
	$mensagem = null;
	
	$dia = empty($_REQUEST['dia']) ? '' : $_REQUEST['dia'];
	$empresa = empty($_REQUEST['empresa']) ? '' : $_REQUEST['empresa'];
	$pago = empty($_REQUEST['pago']) ? '' : $_REQUEST['pago'];
	$pagamento = empty($_REQUEST['pagamento']) ? '' : $_REQUEST['pagamento'];
	$valor = empty($_REQUEST['valor']) ? '' : $_REQUEST['valor'];


	if(!empty($_REQUEST['Salvar'])){
		$id = $resposta = $view->insert();
		if(!empty($id)){
			$mensagem = "Dados salvos com sucesso.";
		}
		else{
			$mensagem = "Não salvo. Dados inconsistentes ou já existentes.";
		}
	}
	
	$html = '
		<section div="container">
		<h3> Novo Lançamento </h3>';
		
		if(!empty($mensagem)){
			$html .= "
				<p class=\"msg\">{$mensagem}</p>
			";
		}
		
		$html .= '
			<section>
				<form action="CadastroLancamento.php" method="post">
					<fieldset>
						<div class="form-group">
							<label>Empresa:</label>
							<input class="form-control" type="text" name="empresa" placeholder="ex: IAL, ITAIPU" value="'.$empresa.'"/>
						</div>
						<div class="form-group col-md-12">
							<label>Valor:</label>
							<input class="form-control" type="text" name="valor" placeholder="ex: 650,00" value="'.$valor.'"/>
						</div>
						<div class="form-group col-md-6">
							<label>Data:</label>
							<input type="date" name="dia" placeholder="13/05/2017" value="'.$dia.'"/>
						</div>

						<div class="form-group col-md-6">
							<label>Pago:</label>
							<select name="pago">
							<option value="0">NÃO</option>
							<option value="1">SIM</option>
							</select>
						</div>
						
						<div class="form-group col-md-12">
							<label>Forma de pagamento:</label>
							<input class="form-control" type="text" name="pagamento" placeholder="ex: Vista, Prazo, Cheque" value="'.$pagamento.'"/>
						</div>
		
						<input class="btn btn-default col-md-3 col-md-offset-4" type="submit" name="Salvar" value="Salvar" />
					</fieldset>
				</form>
				<br/>
			</section>
		';
		
		$titulo = 'Cadastro de Lancamento';
		require_once 'Layout.php';
					