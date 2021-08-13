<?php

	$acao = 'recuperarTarefasPendentes';
	require 'tarefa_controller.php';

?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<!-- bootstrap cdn -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!-- fontawesome cdn -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>

	<script>
		
		function editar(id, descricaoTarefa) {

				// Criar um formulário para edição
				let form = document.createElement('form')
					// Definir atributos do form
					form.action = 'index.php?pag=index&acao=atualizar'
					form.method = 'post'
					// Definir class do Bootstrap
					form.className = 'row'
				
				// Criar um input para entrada do texto
				let inputTarefa = document.createElement('input')
					// Definir atributos do input
					inputTarefa.type = 'text'
					inputTarefa.name = 'tarefa'
					// Definir class do Bootstrap
					inputTarefa.className = 'col-9 form-control'
					// Adicionar o value da descrição da tarefa
					inputTarefa.value = descricaoTarefa

				// Criar um input hidden para guardar o id da tarefa
				let inputId = document.createElement('input')
					// Definir atributos do input
					inputId.type = 'hidden' //hidden = oculto
					inputId.name = 'id'
					inputId.value = id
				

				// Criar um button para envio do form
				let button = document.createElement('button')
					// Definir atributos do button
					button.type = 'submit'
					// Definir class do Bootstrap
					button.className = 'col-3 btn btn-info'
					// Definir valor entre as tags do button
					button.innerHTML = 'Atualizar'

				// Configurar hierarquia das tags
					// Incluir inputTarefa no form
					form.appendChild(inputTarefa)
					// Incluir o inputId no form
					form.appendChild(inputId)
					// Incluir o button no form
					form.appendChild(button)

				// // Testar
				// console.log(form)

				// Selecionar a div tarefa
				let tarefa = document.getElementById('tarefa_'+id)

				// Limpar o conteúdo interno da div para inclusão do form
				tarefa.innerHTML = ''

				// Incluir o form página
				// insertBefore -> Insert após a renderização da página
				tarefa.insertBefore(form, tarefa[0])

			}

			
			function remover(id) {
				// Forçar o request para o mesmo script com o parâmetro da ação
				location.href = 'index.php?pag=index&acao=remover&id='+id
			}

			function marcarRealizada(id) {
				location.href = 'index.php?pag=index&acao=marcarRealizada&id='+id
			}

	</script>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="index.php">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="pagina rounded">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								
								<?php
								foreach($tarefas as $indice => $tarefa) { 
									?>
									
									<div class="row mb-3 d-flex align-items-center tarefa">
										<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>"><?= $tarefa->tarefa ?></div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="escurecer fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i>

											<i class="escurecer fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>')"></i>
											<i class="escurecer fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $tarefa->id ?>)"></i>
										</div>
									</div>

								<?php } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>