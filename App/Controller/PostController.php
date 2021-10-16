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
                $parametros['idPost'] = $postagem->id;
                $parametros['titulo'] = $postagem->titulo;
                $parametros['conteudo'] = $postagem->conteudo;
                $parametros['comentarios'] = $postagem->comentarios;


                $conteudo = $template->render($parametros);
                echo $conteudo;

                
            } catch (Exception $e) {
                echo "Não foi encontrado nenhum registro no Banco de dados!";
            }
        }
        public function addComent()
        {
            try {
                Comentario::inserirComent($_POST);
                header('Location:?pagina=post&id='.$_POST['id'].'');
            } catch (Exception $e) {
                echo '<script>alert("FALHA AO INSERIR COMENTÁRIO: '.$e->getMessage().'")</script>';
                echo '<script>location.href="?pagina=home"</script>';
            }
        }
    }