<?php

class Progresso
{
    public $conn = "";
    public $idprogresso = "0";
    public $idusuario = "";
    public $diferencapeso = "";
    public $diferencaaltura = "";

    public function SelectProgresso()
    {
        $sql = "SELECT
                    idprogresso,
                    idusuario,
                    diferencapeso,
                    diferencaaltura
                FROM progresso
                WHERE 1=1";

        // Array para armazenar os parâmetros
        $params = [];
        $types = "";

        if ($this->idprogresso > 0) {
            $sql .= " AND idprogresso = ?";
            $params[] = &$this->idprogresso;
            $types .= "i";
        }

        if ($this->idusuario > 0) {
            $sql .= " AND idusuario = ?";
            $params[] = &$this->idusuario;
            $types .= "i";
        }

        // Prepara a query
        $stmt = mysqli_prepare($this->conn, $sql);

        if (!$stmt) {
            return false;
        }

        // Bind dos parâmetros se houver
        if (!empty($params)) {
            array_unshift($params, $stmt, $types);
            call_user_func_array('mysqli_stmt_bind_param', $params);
        }

        // Executa a query
        if (!mysqli_stmt_execute($stmt)) {
            return false;
        }

        // Pega o resultado
        $result = mysqli_stmt_get_result($stmt);

        // Busca o primeiro resultado e preenche as propriedades do objeto
        if ($row = mysqli_fetch_assoc($result)) {
            $this->idprogresso = $row['idprogresso'];
            $this->idusuario = $row['idusuario'];
            $this->diferencapeso = $row['diferencapeso'];
            $this->diferencaaltura = $row['diferencaaltura'];

            mysqli_stmt_close($stmt);
            return true;
        }

        // Fecha o statement
        mysqli_stmt_close($stmt);
        return false;
    }

    public function InsertProgresso()
    {
        // Verifica se o ID já existe no banco
        $check_sql = "SELECT idprogresso FROM progresso WHERE idprogresso = ?";
        $check_stmt = mysqli_prepare($this->conn, $check_sql);

        if (!$check_stmt) {
            echo "Erro ao preparar verificação: " . mysqli_error($this->conn);
            return false;
        }

        mysqli_stmt_bind_param($check_stmt, "i", $this->idprogresso);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        $id_exists = (mysqli_stmt_num_rows($check_stmt) > 0);
        mysqli_stmt_close($check_stmt);

        if ($id_exists) {
            // UPDATE - se o ID já existe
            $sql = "
                UPDATE progresso SET
                    idusuario = ?,
                    diferencapeso = ?,
                    diferencaaltura = ?
                WHERE idprogresso = ?
            ";

            $stmt = mysqli_prepare($this->conn, $sql);

            if (!$stmt) {
                return false;
            }

            mysqli_stmt_bind_param(
                $stmt,
                "isss",
                $this->idusuario,
                $this->diferencapeso,
                $this->diferencaaltura,
                $this->idprogresso
            );

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            // INSERT - se o ID não existe
            $sql = "
                INSERT INTO progresso
                (
                    idusuario,
                    diferencapeso,
                    diferencaaltura
                )
                VALUES (?, ?, ?)
            ";

            $stmt = mysqli_prepare($this->conn, $sql);

            if (!$stmt) {
                echo "Erro ao preparar INSERT: " . mysqli_error($this->conn);
                return false;
            }

            mysqli_stmt_bind_param(
                $stmt,
                "iss",
                $this->idusuario,
                $this->diferencapeso,
                $this->diferencaaltura
            );

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $this->idprogresso = mysqli_insert_id($this->conn);
                return true;
            } else {
                return false;
            }
        }
    }

    public function DeleteProgresso()
    {
        if ($this->idprogresso > 0) {
            $sql = "DELETE FROM progresso WHERE idprogresso = ?";

            $stmt = mysqli_prepare($this->conn, $sql);

            if (!$stmt) {
                return false;
            }

            mysqli_stmt_bind_param($stmt, "i", $this->idprogresso);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function SelectProgressoPorUsuario()
    {
        $sql = "SELECT
                    idprogresso,
                    idusuario,
                    diferencapeso,
                    diferencaaltura
                FROM progresso
                WHERE idusuario = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        if (!$stmt) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "i", $this->idusuario);

        if (!mysqli_stmt_execute($stmt)) {
            return false;
        }

        $result = mysqli_stmt_get_result($stmt);

        $progressos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $progressos[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $progressos;
    }

    public function CalcularProgresso($peso_atual, $altura_atual, $peso_anterior, $altura_anterior)
    {
        // Calcular diferença de peso
        if ($peso_anterior > 0 && $peso_atual > 0) {
            $this->diferencapeso = $peso_atual - $peso_anterior;
        } else {
            $this->diferencapeso = 0;
        }

        // Calcular diferença de altura
        if ($altura_anterior > 0 && $altura_atual > 0) {
            $this->diferencaaltura = $altura_atual - $altura_anterior;
        } else {
            $this->diferencaaltura = 0;
        }

        return true;
    }

    public function CalcularPerdaPesoTotal()
    {
        $sql = "SELECT COALESCE(SUM(diferencapeso), 0) AS perda_total 
            FROM progresso 
            WHERE idusuario = ? AND diferencapeso < 0";

        $stmt = mysqli_prepare($this->conn, $sql);

        if (!$stmt) {
            return 0;
        }

        mysqli_stmt_bind_param($stmt, "i", $this->idusuario);

        if (!mysqli_stmt_execute($stmt)) {
            return 0;
        }

        mysqli_stmt_bind_result($stmt, $perda_total);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return (float)$perda_total; // Exemplo: -4.8
    }

    public function ListarPesos()
{
    $sql = "SELECT dataavaliacao, pesoregistrado AS peso FROM progresso WHERE idusuario = ? ORDER BY dataavaliacao ASC";
    $stmt = mysqli_prepare($this->conn, $sql);

    if (!$stmt) return [];

    mysqli_stmt_bind_param($stmt, "i", $this->idusuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $dados = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $dados[] = [
            'dataavaliacao' => date('d/m', strtotime($row['dataavaliacao'])),
            'peso' => (float)$row['peso']
        ];
    }

    mysqli_stmt_close($stmt);
    return $dados;
}

}
