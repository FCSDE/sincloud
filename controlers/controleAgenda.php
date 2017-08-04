<?php
require '../_app/Config.inc.php';
$acao		= strip_tags($_POST['acao']);
$Cadastra 	= new Create;
$read 		= new Read;
$update 	= new Update;
$deleta		= new Delete;
switch ($acao){
	case 'ADD_NOVO':
		$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		unset($data_array['acao']);
		if(!$data_array['ag_nome'] || $data_array['ag_nome'] ==''){
				$msg = '<div class="alert alert-warning" role="alert">
				<strong>Atenção!</strong> Preencha os campos</div>';
			$data = array('acao' => 'error','msg' => $msg);
			echo json_encode($data);
		}else{			
			$Cadastra->ExeCreate('tb_agenda', $data_array);	
			$idtb_agenda = $Cadastra->getResult();		
			if($Cadastra->getResult()):				
				$msg = '<div class="alert alert-success" role="alert">
				<strong>Info!</strong> Cadastro com sucesso</div>';
				$data = array('acao' => 'success', 'msg' => $msg);
				echo json_encode($data); 
			endif; 
		}
	break;	

	case 'EDD_NOVO':
		$data_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		unset($data_array['acao']);
		$id = $data_array['idtb_agenda'];
		unset($data_array['idtb_agenda']);
		if(!$data_array['ag_nome']){
				$msg = '<div class="alert alert-warning" role="alert">
				<strong>Atenção!</strong> Preencha os campos</div>';
			$data = array('acao' => 'error','msg' => $msg);
			echo json_encode($data);
		}else{	
			$update->ExeUpdate('tb_agenda', $data_array, "WHERE idtb_agenda=:id", 'id='.$id);
			if($update->getResult()):
				$tr ='<td class="text-left">#'.$id.'</td>';									
				$tr .='<td class="text-left">'.$data_array['ag_nome'].'</td>';									
				$tr .='<td class="text-left">'.$data_array['ag_email'].'</td>';									
				$tr .='<td class="text-left">'.$data_array['ag_telefone'].'</td>';
				$tr .='<td class="text-right">';
				$tr .='<button type="button" class="btn btn-warning" data-edd="'.$id.'"><i class="glyphicon glyphicon-pencil"></i></button>';
				$tr .='<form action="'.ROOT.'/controlers/controleAgenda.php" enctype="multipart/form-data" name="exCadastro" method="post" style="float: right">';
				$tr .='<input type="hidden" name="idtb_agenda" value="'.$id.'">';
				$tr .='<input type="hidden" name="acao" value="EX_CADASTRO">';
				$tr .='<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>';
				$tr .='</form>';
				$tr .='</td>';
				$data = array('acao' => 'success','idtb_agenda'=>$id,'tr'=>$tr);
				echo json_encode($data);
			endif;			
		}
	break;	

	case 'EX_CADASTRO':
			$dataArray = filter_input_array(INPUT_POST, FILTER_DEFAULT);
			$deleta->ExeDelete('tb_agenda', "WHERE idtb_agenda = :id", 'id='.$dataArray['idtb_agenda']);       
			if($deleta->getResult()):       
				$data = array('acao' => 'success','idtb_agenda'=>$dataArray['idtb_agenda']);
				echo json_encode($data);
			endif;	
		
	break;

 default; header('Location:/index.php/');	
}
?>