<?php

class PedidoStatus
{
    public $conn = "";
    public $idpedidostatus = 0;
    public $status = "";

    // Seleciona status (com filtros opcionais)
    public function SelectPedidoStatus()
    {
        $sql = "SELECT 
                    idpedidostatus,
                    status
                FROM pedidostatus
                WHERE 1=1";

        $params = [];
        $types = "";

        if ($this->idpedidostatus > 0) {
            $sql .= " AND idpedidostatus = ?";
            $params[] = &$this->idpedidostatus;
            $types .= "i";
        }

        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        if (!empty($params)) {
            array_unshift($params, $stmt, $types);
            call_user_func_array('mysqli_stmt_bind_param', $params);
        }

        if (!mysqli_stmt_execute($stmt)) return false;

        $result = mysqli_stmt_get_result($stmt);

        $status_list = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $status_list[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $status_list;
    }

    // Insere ou atualiza status
    public function InsertPedidoStatus()
    {
        // Verifica se já existe
        $check_sql = "SELECT idpedidostatus FROM pedidostatus WHERE idpedidostatus = ?";
        $check_stmt = mysqli_prepare($this->conn, $check_sql);
        if (!$check_stmt) return false;

        mysqli_stmt_bind_param($check_stmt, "i", $this->idpedidostatus);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        $exists = (mysqli_stmt_num_rows($check_stmt) > 0);
        mysqli_stmt_close($check_stmt);

        if ($exists) {
            // UPDATE
            $sql = "UPDATE pedidostatus SET
                        status = ?
                    WHERE idpedidostatus = ?";

            $stmt = mysqli_prepare($this->conn, $sql);
            if (!$stmt) return false;

            mysqli_stmt_bind_param(
                $stmt,
                "si",
                $this->status,
                $this->idpedidostatus
            );

            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            // INSERT
            $sql = "INSERT INTO pedidostatus
                    (status)
                    VALUES (?)";

            $stmt = mysqli_prepare($this->conn, $sql);
            if (!$stmt) return false;

            mysqli_stmt_bind_param(
                $stmt,
                "s",
                $this->status
            );

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $this->idpedidostatus = mysqli_insert_id($this->conn);
            }

            mysqli_stmt_close($stmt);
            return $result;
        }
    }

    // Deleta status
    public function DeletePedidoStatus()
    {
        if ($this->idpedidostatus <= 0) return false;

        $sql = "DELETE FROM pedidostatus WHERE idpedidostatus = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "i", $this->idpedidostatus);
        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        return $result;
    }

    // Carrega um status específico nas propriedades do objeto
    public function CarregarStatus()
    {
        $sql = "SELECT 
                    status
                FROM pedidostatus
                WHERE idpedidostatus = ?";

        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "i", $this->idpedidostatus);

        if (!mysqli_stmt_execute($stmt)) return false;

        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $this->status = $row['status'];
            mysqli_stmt_close($stmt);
            return true;
        }

        mysqli_stmt_close($stmt);
        return false;
    }

    // Busca status por nome (like)
    public function SelectStatusPorNome($nome)
    {
        $sql = "SELECT 
                    idpedidostatus,
                    status
                FROM pedidostatus
                WHERE status LIKE ?";

        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        $nome_like = "%" . $nome . "%";
        mysqli_stmt_bind_param($stmt, "s", $nome_like);

        if (!mysqli_stmt_execute($stmt)) return false;

        $result = mysqli_stmt_get_result($stmt);

        $status_list = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $status_list[] = $row;
        }

        mysqli_stmt_close($stmt);
        return $status_list;
    }

    // Retorna todos os status ordenados
    public function SelectTodosStatus()
    {
        $sql = "SELECT 
                    idpedidostatus,
                    status
                FROM pedidostatus
                ORDER BY status ASC";

        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        if (!mysqli_stmt_execute($stmt)) return false;

        $result = mysqli_stmt_get_result($stmt);

        $status_list = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $status_list[] = $row;
        }

        mysqli_stmt_close($stmt);
        return $status_list;
    }

    // Conta quantos status existem
    public function SelectQuantidadeStatus()
    {
        $sql = "SELECT COUNT(idpedidostatus) FROM pedidostatus";
        $stmt = mysqli_prepare($this->conn, $sql);

        if (!$stmt) return 0;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $qtd);
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);
        return $qtd ?: 0;
    }

    // Verifica se status existe
    public function StatusExiste($idpedidostatus)
    {
        $sql = "SELECT idpedidostatus FROM pedidostatus WHERE idpedidostatus = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "i", $idpedidostatus);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $exists = (mysqli_stmt_num_rows($stmt) > 0);
        mysqli_stmt_close($stmt);

        return $exists;
    }

    // Retorna o nome do status baseado no ID
    public function GetNomeStatus($idpedidostatus)
    {
        $this->idpedidostatus = $idpedidostatus;
        if ($this->CarregarStatus()) {
            return $this->status;
        }
        return "Status não encontrado";
    }
}