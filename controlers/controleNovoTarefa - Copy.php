<?php
require '../../../_app/Config.inc.php';
require '../info_config.php';
$acao		= strip_tags($_POST['acao']);
$Cadastra 	= new Create;
$read 		= new Read;
$update 	= new Update;
switch ($acao){
	case 'ATUALIZAR_ORCAMENTO':
		$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$arrayOrcamento = array('pedido_orcamento_final' => $data_array['pedido_orcamento_final']);
		$update->ExeUpdate('tarefa_pedido', $arrayOrcamento, "WHERE idtarefa_pedido=:id", 'id='.$data_array['idtarefa_pedido']);

		if($update->getResult()):	
			$msg 	=  '<p>Valor cadastrado</p>';
			$data = array('acao' => 'success','msg' => $msg);
			echo json_encode($data);
		endif;
	break;
 case 'CAD_TAREFA':
 	$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
 	//var_dump($data_array);

	if($data_array['pedido_meta'] != '' || $data_array['pedido_meta'] != 0){$pedido_meta = Check::Data($data_array['pedido_meta']);}//Y-m-d
	if($data_array['pedido_data_inicio'] != '' || $data_array['pedido_data_inicio'] != 0){$pedido_data_inicio = Check::Data($data_array['pedido_data_inicio']);}//Y-m-d 	
	
	$dataAtual = strtotime(date('Y/m/d'));

if(!$data_array['idtarefa_departamento'] || !$data_array['idresponsavel'] || !$data_array['idtarefa_assunto']){
		$msg 	=  '<p>Preencha os campos</p>';
		$data = array('acao' => 'error', 'msg' => $msg);
		echo json_encode($data);
	}else if(strtotime($pedido_meta) < strtotime($pedido_data_inicio)){
		$msg 		=  '<p>Atenção! Data da meta menor do que data de inicio</p>';
		$data = array('acao' => 'error', 'msg' => $msg);
		echo json_encode($data);

	}else if(strtotime($pedido_data_inicio) > strtotime($pedido_meta)){
		$msg 		=  '<p>Atenção! Data de inicio maior do que a data de meta.</p>';
		$data = array('acao' => 'error', 'msg' => $msg);
		echo json_encode($data);

	}else if(strtotime($pedido_data_inicio) < $dataAtual){
		$msg 		=  '<p>Data de inicio não pode ser menor do que a data atual.</p>';
		$data = array('acao' => 'error', 'msg' => $msg);
		echo json_encode($data); 
	}else{
		
		$data_array['pedido_data_inicio'] 	= Check::Data($data_array['pedido_data_inicio']);
		$data_array['pedido_meta']			= Check::Data($data_array['pedido_meta']);

		$data = array(
			'idtarefa_departamento'		=> $data_array['idtarefa_departamento'],
			'idresponsavel'				=> $data_array['idresponsavel'],
			'idtarefa_assunto'			=> $data_array['idtarefa_assunto'],
			'idusuario'					=> $data_array['idusuario'],
			'pedido_titulo'				=> strip_tags($data_array['pedido_titulo']),
			'pedido_data_inicio'		=> strip_tags($data_array['pedido_data_inicio']),
			'pedido_meta'				=> strip_tags($data_array['pedido_meta']),
			'pedido_orcamento_inicio'	=> $data_array['pedido_orcamento_inicio'],
			'pedido_checklist'			=> $data_array['pedido_checklist'],
			'pedido_descricao'			=> htmlentities($data_array['pedido_descricao'],ENT_QUOTES),
		);
		$Cadastra->ExeCreate('tarefa_pedido', $data); 
		$idtarefa_pedido = $Cadastra->getResult();

		$idresponsavel = $data_array['acompanhamento_id_resposavel'];
		$total = count($idresponsavel);
		for($i=0; $i < $total; $i++){
			$data_acompanhante = array('idtarefa_pedido'=> $idtarefa_pedido,'idresponsavel'	=> $idresponsavel[$i]);
			$Cadastra->ExeCreate('tarefa_acompanhamento', $data_acompanhante);
		}

		if($Cadastra->getResult()):	
			//=>DISPARA EMAIL
			//$sendEnvio = sendMail('Assunto atendente','Mensagem para atendente',EMAIL_REMETENTE,NOME_REMETENTE,EMAIL_DESTINO,NOME_DESTINO);
			//if($sendEnvio){$msg_email =  'Email enviado com sucesso';}else{$msg_email = 'Não enviado';}
			$msg 		=  '<p>Cadastro com sucesso.</p>';
			$data = array('acao' => 'success', 'msg' => $msg);
			echo json_encode($data);  
		endif; 
	}
 break;
 default; header('Location:/sistemas/obras/');	
}//FIM DO BLOCO
?>