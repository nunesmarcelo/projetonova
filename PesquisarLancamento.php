<?php 
	require_once 'funcoes/funcoes.php';
	
	$view = new LancamentoView();
	
	$mensagem = null;
	
	/*if(!empty($_REQUEST['Pesquisar'])){
		$id = $resposta = $view->insert();
		if(!empty($id)){
			$mensagem = "Dados salvos com sucesso.";
		}
		else{
			$mensagem = "Não salvo. Dados inconsistentes ou já existentes.";
		}
	}*/
	
	$html = '
		<section>
		<h3> Pesquisar </h3>';
		
		if(!empty($mensagem)){
			$html .= "
				<p class=\"msg\">{$mensagem}</p>
			";
		}
		
		$html .= '
			<section>
				<form action="ListarPesquisa.php" method="post">
					<fieldset>
						
						<p>
							<label>De:</label>
							<input type="date" name="datainicio"/>
						</p>
						<p>
							<label>Até:</label>
							<input type="date" name="datafim"/>
						</p>
						<p>
							<input type="submit" name="Pesquisar" value="Pesquisar" />
						</p>
					</fieldset>
				</form>
				<br/>
			</section>
		';
		
		$titulo = 'Pesquisa de Lancamentos';
		require_once 'Layout.php';
					