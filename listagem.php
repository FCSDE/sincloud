<a href="<?php echo ROOT;?>?p=novo" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Novo registro</a>	<hr>
<table class="table">		
	<thead>
		<th class="text-left">ID:</th>
		<th class="text-left">Nome:</th>
		<th class="text-left">E-mail:</th>
		<th class="text-left">Telefone:</th>
	</thead>
	<tbody>
		<?php $read->FullRead("select * from tb_agenda order by idtb_agenda desc");
			if ($read->getRowCount() >= 1){foreach ($read->getResult() as $result_agenda){extract($result_agenda);?>
		<tr class="lista<?php echo $idtb_agenda;?>">
			<td class="text-left">#<?php echo $idtb_agenda;?></td>									
			<td class="text-left"><?php echo $ag_nome;?></td>									
			<td class="text-left"><?php echo $ag_email;?></td>									
			<td class="text-left"><?php echo $ag_telefone;?></td>									
			<td class="text-right">
				<button type="button" class="btn btn-warning" data-edd="<?php echo $idtb_agenda;?>"><i class="glyphicon glyphicon-pencil"></i></button>
				<form action="<?php echo ROOT;?>/controlers/controleAgenda.php" enctype="multipart/form-data" name="exCadastro" method="post" style="float: right">
					<input type="hidden" name="idtb_agenda" value="<?php echo $idtb_agenda;?>">
					<input type="hidden" name="acao" value="EX_CADASTRO">
					<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
				</form>
			</td>									
		</tr>

		<?php /* Bloco de edição */?>
		<tr class="edd_agenda<?php echo $idtb_agenda;?>" style="display: none">
		<form action="<?php echo ROOT?>/controlers/controleAgenda.php" enctype="multipart/form-data" name="eddCadastro" method="post">
			<td class="text-left"></td>									
			<td class="text-left">
				<input type="text" class="form-control" value="<?php echo $ag_nome;?>" maxlength="100" name="ag_nome" placeholder="Nome">
			</td>									
			<td class="text-left">
				<input type="email" class="form-control" value="<?php echo $ag_email;?>" maxlength="100" name="ag_email" placeholder="Email">
			</td>									
			<td class="text-left">
				<input type="tel" class="form-control" maxlength="15" value="<?php echo $ag_telefone;?>" name="ag_telefone" placeholder="Telefone">	
			</td>
			<td class="text-right">
				<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i></button>
				<input type="hidden" name="acao" value="EDD_NOVO">
				<input type="hidden" name="idtb_agenda" value="<?php echo $idtb_agenda;?>">
			</td>
		</form>									
		</tr>							
		<?php /* Fim bloco de edição */?>
		
		<?php } } ?>
	</tbody>
</table>