<?php

    class Comentario
    {
        public static function retornaComentarios($idPost)
        {
            $con = Connection::getConn();

            $sql = "SELECT * FROM comentarios WHERE id_postagem = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('Comentario')) {
                $resultado[] = $row;
            }

            return $resultado;
        }

        public static function inserirComent($reqPost)
        {
            $con = Connection::getConn();

            if (!empty(trim($reqPost['nome'])) and !empty(trim($reqPost['msg']))) {
                $sql = "INSERT INTO comentarios (nome, mensagem, id_postagem) VALUES (:nome, :msg, :idpost)";
                $sql = $con->prepare($sql);
                $sql->bindValue(':nome', $reqPost['nome']);
                $sql->bindValue(':msg', $reqPost['msg']);
                $sql->bindValue(':idpost', $reqPost['idPost']);
                $sql->execute();
    
                if ($sql->rowCount()) {
                    return true;
                } 
                throw new Exception("Erro ao inserir os dados");
            } else{
                throw new Exception("Preencha TODOS os campos!", 1);
            }
        }
    }