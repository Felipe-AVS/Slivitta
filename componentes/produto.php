<?php

class Produto
{
    public $conn = "";
    public $idproduto = 0;
    public $produto = "";
    public $valor = "";

    // Seleciona produtos (com filtros opcionais)
    public function SelectProduto()
    {
        $sql = "SELECT 
                    idproduto,
                    produto,
                    valor
                FROM produto
                WHERE 1=1";

        $params = [];
        $types = "";

        if ($this->idproduto > 0) {
            $sql .= " AND idproduto = ?";
            $params[] = &$this->idproduto;
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

        $produtos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $produtos[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $produtos;
    }

    // Insere ou atualiza produto
    public function InsertProduto()
    {
        // Verifica se já existe
        $check_sql = "SELECT idproduto FROM produto WHERE idproduto = ?";
        $check_stmt = mysqli_prepare($this->conn, $check_sql);
        if (!$check_stmt) return false;

        mysqli_stmt_bind_param($check_stmt, "i", $this->idproduto);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        $exists = (mysqli_stmt_num_rows($check_stmt) > 0);
        mysqli_stmt_close($check_stmt);

        if ($exists) {
            // UPDATE
            $sql = "UPDATE produto SET
                        produto = ?,
                        valor = ?
                    WHERE idproduto = ?";

            $stmt = mysqli_prepare($this->conn, $sql);
            if (!$stmt) return false;

            mysqli_stmt_bind_param(
                $stmt,
                "sdi",
                $this->produto,
                $this->valor,
                $this->idproduto
            );

            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            // INSERT
            $sql = "INSERT INTO produto
                    (produto, valor)
                    VALUES (?, ?)";

            $stmt = mysqli_prepare($this->conn, $sql);
            if (!$stmt) return false;

            mysqli_stmt_bind_param(
                $stmt,
                "sd",
                $this->produto,
                $this->valor
            );

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $this->idproduto = mysqli_insert_id($this->conn);
            }

            mysqli_stmt_close($stmt);
            return $result;
        }
    }

    // Deleta produto
    public function DeleteProduto()
    {
        if ($this->idproduto <= 0) return false;

        $sql = "DELETE FROM produto WHERE idproduto = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "i", $this->idproduto);
        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        return $result;
    }

    // Busca produtos por nome (like)
    public function SelectProdutoPorNome($nome)
    {
        $sql = "SELECT 
                    idproduto,
                    produto,
                    valor
                FROM produto
                WHERE produto LIKE ?";

        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        $nome_like = "%" . $nome . "%";
        mysqli_stmt_bind_param($stmt, "s", $nome_like);

        if (!mysqli_stmt_execute($stmt)) return false;

        $result = mysqli_stmt_get_result($stmt);

        $produtos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $produtos[] = $row;
        }

        mysqli_stmt_close($stmt);
        return $produtos;
    }

    // Busca produtos por faixa de valor
    public function SelectProdutoPorValor($valor_min, $valor_max)
    {
        $sql = "SELECT 
                    idproduto,
                    produto,
                    valor
                FROM produto
                WHERE valor BETWEEN ? AND ?";

        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "dd", $valor_min, $valor_max);

        if (!mysqli_stmt_execute($stmt)) return false;

        $result = mysqli_stmt_get_result($stmt);

        $produtos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $produtos[] = $row;
        }

        mysqli_stmt_close($stmt);
        return $produtos;
    }

    // Conta quantos produtos existem
    public function SelectQuantidadeProdutos()
    {
        $sql = "SELECT COUNT(idproduto) FROM produto";
        $stmt = mysqli_prepare($this->conn, $sql);

        if (!$stmt) return 0;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $qtd);
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);
        return $qtd ?: 0;
    }

    // Busca produtos mais caros
    public function SelectProdutosMaisCaros($limite = 10)
    {
        $sql = "SELECT 
                    idproduto,
                    produto,
                    valor
                FROM produto
                ORDER BY valor DESC
                LIMIT ?";

        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "i", $limite);

        if (!mysqli_stmt_execute($stmt)) return false;

        $result = mysqli_stmt_get_result($stmt);

        $produtos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $produtos[] = $row;
        }

        mysqli_stmt_close($stmt);
        return $produtos;
    }

    // Busca produtos mais baratos
    public function SelectProdutosMaisBaratos($limite = 10)
    {
        $sql = "SELECT 
                    idproduto,
                    produto,
                    valor
                FROM produto
                ORDER BY valor ASC
                LIMIT ?";

        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "i", $limite);

        if (!mysqli_stmt_execute($stmt)) return false;

        $result = mysqli_stmt_get_result($stmt);

        $produtos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $produtos[] = $row;
        }

        mysqli_stmt_close($stmt);
        return $produtos;
    }

    // Formata valor para exibição (R$)
    public function FormatarValor($valor)
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    // Verifica se produto existe
    public function ProdutoExiste($idproduto)
    {
        $sql = "SELECT idproduto FROM produto WHERE idproduto = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "i", $idproduto);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $exists = (mysqli_stmt_num_rows($stmt) > 0);
        mysqli_stmt_close($stmt);

        return $exists;
    }
}