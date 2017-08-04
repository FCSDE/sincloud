<a href="<?php echo ROOT;?>?p=listagem" class="btn btn-warning"><i class="glyphicon glyphicon-th-list"></i> Lista de cadastro</a><hr>
<form action="<?php echo ROOT?>/controlers/controleAgenda.php" enctype="multipart/form-data" name="addCadastro" method="post">
	<div class="form-group col-md-8">
		<label for="ag_nome">Nome:</label>
		<input type="text" class="form-control" id="ag_nome"  maxlength="100" name="ag_nome" placeholder="Nome">
		
		<label for="ag_email">E-mail</label>
		<input type="email" class="form-control"  maxlength="100" id="ag_email" name="ag_email" placeholder="Email">
		
		<label for="ag_telefone">Telefone</label>
		<input type="tel" class="form-control" maxlength="15" id="ag_telefone" name="ag_telefone" placeholder="Telefone">
	</div>
	<div class="form-group col-md-8">								
	<input type="hidden" name="acao" value="ADD_NOVO">
	<button  type="submit" class="btn btn-success">Salvar</button>
	</div>
	<div class="msg col-md-8"></div>								
</form>								
