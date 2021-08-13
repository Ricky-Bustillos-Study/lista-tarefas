<?php

    // Esses requires estão no contexto do arquivo tarefa_controller da pasta pública, logo, precisa utilizar o diretório baseado onde está o arquivo original.
    require "../../app_ListaTarefas/tarefa.model.php";
    require "../../app_ListaTarefas/tarefa.service.php";
    require "../../app_ListaTarefas/conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if( $acao == 'inserir') {

        // Requisição da class Tarefa (tarefa.model.php)
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        // Requisição da conexão (conexao.php)
        $conexao = new Conexao();

        // Requisição das Operações da Tarefa (CRUD)
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header('Location: nova_tarefa.php?inclusao=1');

    } else if ($acao == 'recuperar') {

        // Requisição da class Tarefa (tarefa.model.php)
        $tarefa = new Tarefa();

        // Requisição da conexão (conexao.php)
        $conexao = new Conexao();

        // Requisição das Operações da Tarefa (CRUD)
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();

    } else if ($acao == 'atualizar') {

        // Requisição da class Tarefa (tarefa.model.php)
        $tarefa = new Tarefa();
        // Recuperando valores enviados pelo form
        $tarefa
            ->__set('id', $_POST['id'])
            ->__set('tarefa', $_POST['tarefa']);

        // Requisição da conexão (conexao.php)
        $conexao = new Conexao();

        // Requisição das Operações da Tarefa (CRUD)
        $tarefaService = new TarefaService($conexao, $tarefa);
        // 1 = TRUE // 0 = FALSE
        if($tarefaService->atualizar()) {
            if( isset($_GET['pag']) && $_GET['pag'] == 'index' ) {
                header('location: index.php');
            } else {
                header('location: todas_tarefas.php');
            }
        }
    } else if ($acao == 'remover') {

        // Requisição da class Tarefa (tarefa.model.php)
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        // Requisição da conexão (conexao.php)
        $conexao = new Conexao();

        // Requisição das Operações da Tarefa (CRUD)
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        if( isset($_GET['pag']) && $_GET['pag'] == 'index' ) {
            header('location: index.php');
        } else {
            header('location: todas_tarefas.php');
        }

    } else if ($acao == 'marcarRealizada') {

        // Requisição da class Tarefa (tarefa.model.php)
        $tarefa = new Tarefa();
        $tarefa
            ->__set('id', $_GET['id'])
            ->__set('id_status', 2);

        // Requisição da conexão (conexao.php)
        $conexao = new Conexao();

        // Requisição das Operações da Tarefa (CRUD)
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->marcarRealizada();

        if( isset($_GET['pag']) && $_GET['pag'] == 'index' ) {
            header('location: index.php');
        } else {
            header('location: todas_tarefas.php');
        }
    } else if ($acao == 'recuperarTarefasPendentes') {
        $tarefa = new Tarefa();
        $tarefa->__set('id_status', 1);

        // Requisição da conexão (conexao.php)
        $conexao = new Conexao();

        // Requisição das Operações da Tarefa (CRUD)
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperarTarefasPendentes();
    }


?>