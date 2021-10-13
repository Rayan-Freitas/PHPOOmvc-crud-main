<?php

    class HomeController
    {
        public function index()
        {
            try {
                $colecaoPostagens = Postagem::retornaPostagens();
                

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('home.html');

                $parametros = array();
                $parametros['postagens'] = $colecaoPostagens;

                $conteudo = $template->render($parametros);
                echo $conteudo;

                
            } catch (Exception $e) {
                echo "Não foi encontrado nenhum registro no Banco de dados!";
            }

        }
    }