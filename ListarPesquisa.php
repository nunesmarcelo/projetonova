
<?php 	
	require_once 'funcoes/funcoes.php';
	
	$view = new LancamentoView();
	$dao = new LancamentoDao();


		
	
	//MANTENDO A DATA DE INICIO E DATA FINAL DA PESQUISA NAS PRÓXIMAS PÁGINAS.
	$datainicio = empty($_REQUEST['datainicio']) ? '' : $_REQUEST['datainicio'];
	//FORMATANDO A DATA PRA MOSTRAR NA TELA.
	$dataform1 = date('d/m/Y',strtotime($datainicio));
	$datafim = empty($_REQUEST['datafim']) ? '' : $_REQUEST['datafim'];
	$dataform2 = date('d/m/Y',strtotime($datafim));
	
	//PRA REMOÇÃO
	if(!empty($_REQUEST['Remover'])) {
		//QTDREMOVIDOS RECEBERÁ QTOS FORAM REMOVIDOS, SENDO QUE A DELETE RECEBE UM ARRAY DE ID'S E REMOVE OS DADOS QUE TÊM ESSE ID. 
		$qtdRemovidos = $view->delete();
		$id = ''; // Recurso não recomendado, mas resolve o erro.
		
	}

	$listalancamentos = $view->search(); //listando todos os usuários.
	if(!empty($_REQUEST['Pagar'])){
				//PEGANDO OS IDS QUE O USUÁRIO MARCOU NA CHECKBOX PRA PAGAR
				$lancamento_ids = $_REQUEST['lancamento_id'];
				//PRIMEIRO FOR PERCORRE OS IDS QUE O CARA SELECIONOU
				foreach($lancamento_ids as $idseparado){
					//SEGUNDO FOR PERCORRE A LISTA DOS LANCAMENTOS PRA ATUALIZAR O ID DA VEZ.
					foreach($listalancamentos as $lancamento){
						//QUANDO ACHAR O ID ALTERA O VALOR DE NÃO-PAGO PARA PAGO.
						if($idseparado == $lancamento->getLancamentoId()){
								
								$lancamento->setPago("1");
								$result = $dao->update($lancamento);
								
						}
					}
				}
	}

	//MESMA IDEIA DO PAGAR.
	if(!empty($_REQUEST['NaoPagar'])){
				$lancamento_ids = $_REQUEST['lancamento_id'];
				foreach($lancamento_ids as $idseparado){
					foreach($listalancamentos as $lancamento){
						if($idseparado == $lancamento->getLancamentoId()){
								
								$lancamento->setPago("0");
								$result = $dao->update($lancamento);
								
						}
					}
				}
	}

	$listalancamentos = $view->search(); //listando todos os usuários.

	$html = "
		<section>
			<h3> Lancamentos de {$dataform1} à {$dataform2} : </h3>
			<br/> 	
			<form action=\"ListarPesquisa.php\" method=\"post\">
			<table>
				<tr>
					<th>ID</th>
					<th>Empresa</th>
					<th>Data</th>
					<th>Pago</th>
					<th>Pagamento</th>
					<th>Valor</th>
					<th>Alterar</th>
				</tr>
		";
		
		
		foreach($listalancamentos as $lancamento){
			//AFUNILANDO A PESQUISA PRA SE ENCAIXAR NAS DATAS DE INICIO E FIM SELECIONADAS.
			if(strtotime($lancamento->getDia()) >= strtotime($datainicio) && strtotime($lancamento->getDia()) <= strtotime($datafim) ){
				//FORMATANDO O DIA PRO MODO BR PRA SER APRESENTADO NA TELA.
				$diaformatado = date('d/m/Y',strtotime($lancamento->getDia()));
				$html .= "
						<tr>
							<td>
								<input type=\"checkbox\" name=\"lancamento_id[]\" value=\"{$lancamento->getLancamentoId()}\"/>
							</td>
							<td>
								{$lancamento->getEmpresa()}
							</td>
							<td>
								{$diaformatado}
							</td>
							";
							
							//MOSTRA UM ICONE VERDE CASO PAGO, E VERMELHO CASO NÃO.
							if($lancamento->getPago() == 0){
								$html .= "
									<td>
										<img src=\"images/despagar.ico\" alt=\"DespagarIcon\" height=\"30px\" width\"30px\"/>
									</td>
								";
							} 
							if($lancamento->getPago() == 1){
								$html .= "
									<td>
										<img src=\"images/pagar.ico\" alt=\"PagarIcon\" height=\"30px\" width\"30px\"/>
									</td>
								";
							}	
				$html .="
							<td>
								{$lancamento->getPagamento()}
							</td>
							<td>
								{$lancamento->getValor()}
							</td>
							<td>
								<a href=\"AlterarLancamento.php?alterar=1&lancamento_id={$lancamento->getLancamentoId()}&empresa={$lancamento->getEmpresa()}&dia={$lancamento->getDia()}&pago={$lancamento->getPago()}&pagamento={$lancamento->getPagamento()}&valor={$lancamento->getValor()}\" alt=\"Alterarlancamento\">
										<img src=\"images/alterar.ico\" alt=\"AlterarIcon\" height=\"30px\" width\"30px\"/>
								</a>
							</td>
						</tr>
				";
				}
		}
		

		if(empty($listalancamentos)){
			$html .= '
					<tr>
						<td colspan="3">Nenhum lancamento cadastrado </td>
					</tr>
			';
		}	

		$html .= "
					</table>
					<br/>
					<p>
						<input type=\"submit\" name=\"Remover\" value=\"Remover\"/>
						<input type=\"submit\" name=\"Pagar\" value=\"Pagar\"/>
						<input type=\"submit\" name=\"NaoPagar\" value=\"Não-Pagar\"/>
					</p>
						<input type=\"hidden\" name=\"datainicio\" value=\"{$datainicio}\" />
						<input type=\"hidden\" name=\"datafim\" value=\"{$datafim}\" />
					
				</section>
			</form>
		";
	
		$titulo = 'Lista de lancamentos';
		require_once 'Layout.php';
					