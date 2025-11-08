<?php

class Pedido
{
    public $conn = "";
    public $idpedido = 0;
    public $idusuario = 0;
    public $idproduto = 0;
    public $frete = 0.0;
    public $total = 0.0;
    public $taxas = 0.0;
    public $idformapagamento = 0;
    public $idpedidostatus = 0;
    public $data = "";

    // Seleciona pedidos (com filtros opcionais)
    public function SelectPedido()
    {
        $sql = "SELECT 
                    idpedido,
                    idusuario,
                    idproduto,
                    frete,
                    total,
                    taxas,
                    idformapagamento,
                    idpedidostatus,
                    data
                FROM pedido
                WHERE 1=1";

        $params = [];
        $types = "";

        if ($this->idpedido > 0) {
            $sql .= " AND idpedido = ?";
            $params[] = &$this->idpedido;
            $types .= "i";
        }

        if ($this->idusuario > 0) {
            $sql .= " AND idusuario = ?";
            $params[] = &$this->idusuario;
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

        $pedidos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pedidos[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $pedidos;
    }

    

    // Insere ou atualiza pedido
    public function InsertPedido()
    {
        // Verifica se já existe
        $check_sql = "SELECT idpedido FROM pedido WHERE idpedido = ?";
        $check_stmt = mysqli_prepare($this->conn, $check_sql);
        if (!$check_stmt) return false;

        mysqli_stmt_bind_param($check_stmt, "i", $this->idpedido);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        $exists = (mysqli_stmt_num_rows($check_stmt) > 0);
        mysqli_stmt_close($check_stmt);

        if ($exists) {
            // UPDATE
            $sql = "UPDATE pedido SET
                        idusuario = ?,
                        idproduto = ?,
                        frete = ?,
                        total = ?,
                        taxas = ?,
                        idformapagamento = ?,
                        idpedidostatus = ?,
                        data = ?
                    WHERE idpedido = ?";

            $stmt = mysqli_prepare($this->conn, $sql);
            if (!$stmt) return false;

            mysqli_stmt_bind_param(
                $stmt,
                "iidddii si",
                $this->idusuario,
                $this->idproduto,
                $this->frete,
                $this->total,
                $this->taxas,
                $this->idformapagamento,
                $this->idpedidostatus,
                $this->data,
                $this->idpedido
            );

            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            // INSERT
            $sql = "INSERT INTO pedido
                    (idusuario, idproduto, frete, total, taxas, idformapagamento, idpedidostatus, data)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($this->conn, $sql);
            if (!$stmt) return false;

            mysqli_stmt_bind_param(
                $stmt,
                "iidddiis",
                $this->idusuario,
                $this->idproduto,
                $this->frete,
                $this->total,
                $this->taxas,
                $this->idformapagamento,
                $this->idpedidostatus,
                $this->data
            );

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $this->idpedido = mysqli_insert_id($this->conn);
            }

            mysqli_stmt_close($stmt);
            return $result;
        }
    }

    // Deleta pedido
    public function DeletePedido()
    {
        if ($this->idpedido <= 0) return false;

        $sql = "DELETE FROM pedido WHERE idpedido = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "i", $this->idpedido);
        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        return $result;
    }

    // Seleciona pedidos por usuário
    public function SelectPedidoPorUsuario()
    {
        $sql = "SELECT 
                    idpedido,
                    idusuario,
                    idproduto,
                    frete,
                    total,
                    taxas,
                    idformapagamento,
                    idpedidostatus,
                    data
                FROM pedido
                WHERE idusuario = ?";

        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "i", $this->idusuario);

        if (!mysqli_stmt_execute($stmt)) return false;

        $result = mysqli_stmt_get_result($stmt);

        $pedidos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pedidos[] = $row;
        }

        mysqli_stmt_close($stmt);
        return $pedidos;
    }

    // Conta quantos pedidos um usuário possui
    public function SelectQuantidadePedidoPorUsuario($idusuario)
    {
        $sql = "SELECT COUNT(idpedido) FROM pedido WHERE idusuario = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if (!$stmt) return 0;

        mysqli_stmt_bind_param($stmt, "i", $idusuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $qtd);
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);
        return $qtd ?: 0;
    }
}
