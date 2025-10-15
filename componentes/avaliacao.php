<?php

class Avaliacao
{
    public $conn = "";
    public $idavaliacao = "0";
    public $idusuario = "";
    //HISTORICO DE SAUDE
    public $diabetes = "";
    public $pressaoalta = "";
    public $colesterol = "";
    public $problemasCardiacos = "";
    //HABITOS E ESTILO DE VIDA
    public $frequenciaAtividadeFisica = "";
    public $alimentacao = "";
    public $horasSono = "";
    public $fuma = "";
    //MEDICAMENTOS
    public $medicamentos = "";
    public $alergias = "";
    public $cirurgias = "";
    //OBJETIVOS
    public $principalObjetivo = "";
    public $metaPeso = "";
    public $outrosTratamentos = "";

    public function SelectAvaliacao()
    {
        $sql = "SELECT
                    idavaliacao,
                    idusuario,
                    diabetes,
                    pressaoalta,
                    colesterol,
                    problemasCardiacos,
                    frequenciaAtividadeFisica,
                    alimentacao,
                    horasSono,
                    fuma,
                    medicamentos,
                    alergias,
                    cirurgias,
                    principalObjetivo,
                    metaPeso,
                    outrosTratamentos
                FROM avaliacao
                WHERE 1=1";

        // Array para armazenar os parâmetros
        $params = [];
        $types = "";

        if ($this->idavaliacao > 0) {
            $sql .= " AND idavaliacao = ?";
            $params[] = &$this->idavaliacao;
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

        // Busca todos os resultados
        $avaliacoes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $avaliacoes[] = $row;
        }

        // Fecha o statement
        mysqli_stmt_close($stmt);

        return $avaliacoes;
    }

    public function InsertAvaliacao()
    {
        // Verifica se o ID já existe no banco
        $check_sql = "SELECT idavaliacao FROM avaliacao WHERE idavaliacao = ?";
        $check_stmt = mysqli_prepare($this->conn, $check_sql);

        if (!$check_stmt) {
            echo "Erro ao preparar verificação: " . mysqli_error($this->conn);
            return false;
        }

        mysqli_stmt_bind_param($check_stmt, "i", $this->idavaliacao);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        $id_exists = (mysqli_stmt_num_rows($check_stmt) > 0);
        mysqli_stmt_close($check_stmt);

        if ($id_exists) {
            // UPDATE - se o ID já existe
            $sql = "
                UPDATE avaliacao SET
                    idusuario = ?,
                    diabetes = ?,
                    pressaoalta = ?,
                    colesterol = ?,
                    problemasCardiacos = ?,
                    frequenciaAtividadeFisica = ?,
                    alimentacao = ?,
                    horasSono = ?,
                    fuma = ?,
                    medicamentos = ?,
                    alergias = ?,
                    cirurgias = ?,
                    principalObjetivo = ?,
                    metaPeso = ?,
                    outrosTratamentos = ?
                WHERE idavaliacao = ?
            ";

            $stmt = mysqli_prepare($this->conn, $sql);

            if (!$stmt) {
                return false;
            }

            mysqli_stmt_bind_param(
                $stmt,
                "issssssssssssssi",
                $this->idusuario,
                $this->diabetes,
                $this->pressaoalta,
                $this->colesterol,
                $this->problemasCardiacos,
                $this->frequenciaAtividadeFisica,
                $this->alimentacao,
                $this->horasSono,
                $this->fuma,
                $this->medicamentos,
                $this->alergias,
                $this->cirurgias,
                $this->principalObjetivo,
                $this->metaPeso,
                $this->outrosTratamentos,
                $this->idavaliacao
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
                INSERT INTO avaliacao
                (
                    idusuario,
                    diabetes,
                    pressaoalta,
                    colesterol,
                    problemasCardiacos,
                    frequenciaAtividadeFisica,
                    alimentacao,
                    horasSono,
                    fuma,
                    medicamentos,
                    alergias,
                    cirurgias,
                    principalObjetivo,
                    metaPeso,
                    outrosTratamentos
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ";

            $stmt = mysqli_prepare($this->conn, $sql);

            if (!$stmt) {
                echo "Erro ao preparar INSERT: " . mysqli_error($this->conn);
                return false;
            }

            mysqli_stmt_bind_param(
                $stmt,
                "issssssssssssss",
                $this->idusuario,
                $this->diabetes,
                $this->pressaoalta,
                $this->colesterol,
                $this->problemasCardiacos,
                $this->frequenciaAtividadeFisica,
                $this->alimentacao,
                $this->horasSono,
                $this->fuma,
                $this->medicamentos,
                $this->alergias,
                $this->cirurgias,
                $this->principalObjetivo,
                $this->metaPeso,
                $this->outrosTratamentos
            );

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $this->idavaliacao = mysqli_insert_id($this->conn);
                return true;
            } else {
                return false;
            }
        }
    }

    public function DeleteAvaliacao()
    {
        if ($this->idavaliacao > 0) {
            $sql = "DELETE FROM avaliacao WHERE idavaliacao = ?";

            $stmt = mysqli_prepare($this->conn, $sql);

            if (!$stmt) {
                return false;
            }

            mysqli_stmt_bind_param($stmt, "i", $this->idavaliacao);
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

    public function SelectAvaliacaoPorUsuario()
    {
        $sql = "SELECT
                    idavaliacao,
                    idusuario,
                    diabetes,
                    pressaoalta,
                    colesterol,
                    problemasCardiacos,
                    frequenciaAtividadeFisica,
                    alimentacao,
                    horasSono,
                    fuma,
                    medicamentos,
                    alergias,
                    cirurgias,
                    principalObjetivo,
                    metaPeso,
                    outrosTratamentos
                FROM avaliacao
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

        $avaliacoes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $avaliacoes[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $avaliacoes;
    }
}