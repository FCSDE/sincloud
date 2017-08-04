<?php
require '../../../_app/Config.inc.php';
require '../info_config.php';
$acao		= strip_tags($_POST['acao']);
$Cadastra 	= new Create;
$read 		= new Read;
$update 	= new Update;
switch ($acao){
	case 'COMENTARIO_TAREFA':
		$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if(!$data_array['idtarefa_pedido'] || !$data_array['com_texto']){
			$msg 		=  '<p>Preencha os campos</p>';
			$data = array('acao' => 'error', 'msg' => $msg);
			echo json_encode($data); 
		}else{
			$arrayDados = array(
				'idtarefa_pedido'	=> $data_array['idtarefa_pedido'],
				'idusuario'			=> $data_array['idusuario'],
				'com_ativo'			=> 1,
				'com_texto'			=> htmlentities($data_array['com_texto'],ENT_QUOTES),
			);
			$Cadastra->ExeCreate('tarefa_comentario', $arrayDados);
			if($Cadastra->getResult()):	
			//=>DISPARA EMAIL
			//$sendEnvio = sendMail('Assunto atendente','Mensagem para atendente',EMAIL_REMETENTE,NOME_REMETENTE,EMAIL_DESTINO,NOME_DESTINO);
			//if($sendEnvio){$msg_email =  'Email enviado com sucesso';}else{$msg_email = 'Não enviado';}

			$read->FullRead("select p.nome as 'nome_responsavel', u.id from usuario as u inner join pessoa as p on u.pessoa_id=p.id where u.empreendimento_id=21 and u.id ='".$data_array['idusuario']."' ");
			if ($read->getRowCount() >= 1){ foreach ($read->getResult() as $resultUsuario){extract($resultUsuario);}}

			$retrono = '<div class="list_custom_header"><div><p>'.$nome_responsavel.' - '.date('d/m/Y H:i:s').'<br>'.html_entity_decode($data_array['com_texto']).'</p></div></div>';

			$msg = '<p>Dados cadastrados com sucesso.</p>';
			$data = array('acao' => 'success', 'msg' => $msg, 'retorno'=>$retrono);
			echo json_encode($data);  
			endif;
		}
	break;

	case 'FINALIZAR_TAREFA':
		$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		$arrayTarefa = array('pedido_finalizado' => 1, 'pedido_data_final'=>date('Y-m-d H:i:s'), 'idusuario_que_finalizou'=>$data_array['usuario_id']);
		$update->ExeUpdate('tarefa_pedido', $arrayTarefa, "WHERE idtarefa_pedido = :id", 'id='.$data_array['idtarefa_pedido']);

		$tarefaAcompanhamento = array('acom_finalizado' => 1,'acom_data'=>date('Y-m-d H:i:s'));
		$update->ExeUpdate('tarefa_acompanhamento', $tarefaAcompanhamento, "WHERE idtarefa_pedido = :id", 'id='.$data_array['idtarefa_pedido']);

		if($update->getResult()):	
			$msg 	=  '<p>Finalizado com sucesso.</p>';
			$data = array('acao' => 'success','msg' => $msg);
			echo json_encode($data);
		endif;
	break;

 default; header('Location:/sistemas/obras/');	
}//FIM DO BLOCO
?>
