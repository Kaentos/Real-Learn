<?php
    include("bd.php");
    include("funcoes.php");

    if ( isset($_POST["nomeDisciplina"]) ) {
        
        
        $disciplina = array(
            "nome" => $_POST["nomeDisciplina"]
        );

        if ( strlen($disciplina["nome"]) <= 4 ) {
            mostraAlert("Nome de disciplina muito curto!");
            gotoFormGestao();
            die();
        }

        $query = "
            SELECT *
            FROM Disciplina
            WHERE LOWER(nome) = LOWER(:nome);
        ";
        $stmt = $dbo -> prepare($query);
        $stmt -> execute($disciplina);
        if ($stmt -> rowCount() > 0) {
            mostraAlert("Nome de disciplina já existente!");
            gotoFormGestao();
            die();
        }

        $query = "
            INSERT INTO Disciplina (nome) VALUES (:nome);
        ";
        $stmt = $dbo -> prepare($query);
        $stmt -> execute($disciplina);
        if ($stmt -> rowCount() > 0) {
            mostraAlert("Adicionou disciplina!");
            gotoFormGestao();
            die();
        } else {
            die("<h1>Erro critico, por favor proceda ao pedido de debug.</h1>");
        }
        

    } else {
        mostraAlert("Campos de disciplina inválidos!");
        gotoFormGestao();
        die();
    }
    

?>