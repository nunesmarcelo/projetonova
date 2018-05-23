<?php
	
	function __autoload($classe){
		//require_once("dao/$classe.class.php");
		$raiz = substr(__DIR__,0, -strlen('/funcoes'));
		$finalDoNome3Letras = substr($classe,-3);
		
		$dir = '';
		if($finalDoNome3Letras === 'Dao') {
			$dir = 'dao';
		}
		if($finalDoNome3Letras === 'ler'){
			$dir = 'controller';
		}
		if($finalDoNome3Letras === 'iew'){
			$dir = 'view';
		}
		if($finalDoNome3Letras === 'del'){
			$dir = 'model';
		}
		
		$dir = "$raiz\\$dir";
		
		require_once("$dir\\$classe.class.php");
	}
	
	function debug($obj){
		$erros = debug_backtrace();
		
		echo '<pre>';
		echo var_dump($obj);
		echo '<br/>';
		
		foreach($erros as $erro){
			echo "linha: {$erro['line']}<br/>";
			$arquivoLinux = explode('/',$erro['file']);
			$arquivoLinux=array_pop($arquivoLinux);
			
			$arquivoWindows = explode('\\',$erro['file']);
			$arquivoWindows = array_pop($arquivoWindows);
			
			echo "Arquivo: $arquivoWindows<br/>";
		}
		echo '</pre>';
	}