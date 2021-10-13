<?php

    class PostController
    {
        public function index($params)
        {
            try {
                $postagem = Postagem::retornaPostId($params);

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('single.html');

                $parametros = array();
                $parametros['titulo'] = $postagem->titulo;
                $parametros['conteudo'] = $postagem->conteudo;
                $parametros['comentarios'] = $postagem->comentarios;


                $conteudo = $template->render($parametros);
                echo $conteudo;

                
            } catch (Exception $e) {
                echo "Não foi encontrado nenhum registro no Banco de dados!";
            }

        }
    }