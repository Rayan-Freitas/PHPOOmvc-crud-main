<?php

    class Postagem
    {
        public static function retornaPostagens()
        {
            $con = Connection::getConn();
        
            $sql = "SELECT * FROM posts ORDER BY id DESC";
            $sql = $con->prepare($sql);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('Postagem')){
                $resultado[] = $row;
            }

            if (!$resultado) {
                $erro = "Não foi encontrado nenhum registro no Banco de dados!";
                throw new Exception("Não foi encontrado nenhum registro no Banco de dados!");           
            }

            return $resultado;
        }

        public static function retornaPostId($idPost)
        {
            $con = Connection::getConn();

            $sql = "SELECT * FROM posts WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetchObject('Postagem');

            if (!$resultado) {
                throw new Exception("Não foi encontrado nenhum registro no Banco de dados!");         
            } else {
                $resultado->comentarios = Comentario::retornaComentarios($resultado->id);
            }
            
            return $resultado;

        }
    }