<?php

class Usuario
{
    public $conn = "";
    public $idusuario = "0";
    public $idcategoria = "";
    public $nome = "";
    public $celular = "";
    public $email = "";
    public $endereco = "";
    public $numero = "";
    public $bairro = "";
    public $cidade = "";
    public $cep = "";
    public $senha = "";

    public function SelectUsuario()
    {
        $sql = "SELECT
                    idusuario,
                    idcategoria,
                    nome,
                    celular,
                    email,
                    endereco,
                    numero,
                    bairro,
                    cidade,
                    cep,
                    senha
                FROM usuario
                WHERE 1=1";

        // Array para armazenar os parâmetros
        $params = [];
        $types = "";

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
        $usuarios = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $usuarios[] = $row;
        }

        // Fecha o statement
        mysqli_stmt_close($stmt);


        return $usuarios;
    }

    public function InsertUsuario()
    {
        // Verifica se o ID já existe no banco
        $check_sql = "SELECT idusuario FROM usuario WHERE idusuario = ?";
        $check_stmt = mysqli_prepare($this->conn, $check_sql);

        if (!$check_stmt) {
            echo "Erro ao preparar verificação: " . mysqli_error($this->conn);
            return false;
        }

        mysqli_stmt_bind_param($check_stmt, "i", $this->idusuario);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        $id_exists = (mysqli_stmt_num_rows($check_stmt) > 0);
        mysqli_stmt_close($check_stmt);

        if ($id_exists) {
            // UPDATE - se o ID já existe
            $sql = "
                UPDATE usuario SET
                    idcategoria = ?,
                    nome = ?,
                    celular = ?,
                    email = ?,
                    endereco = ?,
                    numero = ?,
                    bairro = ?,
                    cidade = ?,
                    cep = ?,
                    senha = ?
                WHERE idusuario = ?
            ";

            $stmt = mysqli_prepare($this->conn, $sql);

            if (!$stmt) {

                return false;
            }

            mysqli_stmt_bind_param(
                $stmt,
                "issssissssi",
                $this->idcategoria,
                $this->nome,
                $this->celular,
                $this->email,
                $this->endereco,
                $this->numero,
                $this->bairro,
                $this->cidade,
                $this->cep,
                $this->senha,
                $this->idusuario
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
                INSERT INTO usuario
                (
                    idcategoria, nome, celular, email, endereco, 
                    numero, bairro, cidade, cep, senha
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ";

            $stmt = mysqli_prepare($this->conn, $sql);

            if (!$stmt) {
                echo "Erro ao preparar INSERT: " . mysqli_error($this->conn);
                return false;
            }

            mysqli_stmt_bind_param(
                $stmt,
                "issssissss",
                $this->idcategoria,
                $this->nome,
                $this->celular,
                $this->email,
                $this->endereco,
                $this->numero,
                $this->bairro,
                $this->cidade,
                $this->cep,
                $this->senha
            );

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $this->idusuario = mysqli_insert_id($this->conn);

                return true;
            } else {

                return false;
            }
        }
    }

    public function DeleteUsuario()
    {
        if ($this->idusuario > 0) {
            $sql = "DELETE FROM usuario WHERE idusuario = ?";

            $stmt = mysqli_prepare($this->conn, $sql);

            if (!$stmt) {

                return false;
            }

            mysqli_stmt_bind_param($stmt, "i", $this->idusuario);
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

   public function LogarUsuario()
{
    // Verifica se celular e senha foram fornecidos
    if (!empty($this->celular) && !empty($this->senha)) {
        $sql = "SELECT 
                    idusuario,
                    idcategoria,
                    nome,
                    celular,
                    email,
                    endereco,
                    numero,
                    bairro,
                    cidade,
                    cep,
                    senha
                FROM usuario 
                WHERE celular = ? AND senha = ?";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        
        if (!$stmt) {
            return false;
        }
        
        // Bind dos parâmetros
        mysqli_stmt_bind_param($stmt, "ss", $this->celular, $this->senha);
        
        // Executa a query
        if (!mysqli_stmt_execute($stmt)) {
            return false;
        }
        
        // Pega o resultado
        $result = mysqli_stmt_get_result($stmt);
        
        // Verifica se encontrou o usuário
        if (mysqli_num_rows($result) == 1) {
            $usuario = mysqli_fetch_assoc($result);
            
            // Preenche os dados do objeto com os dados do banco
            $this->idusuario = $usuario['idusuario'];
            $this->idcategoria = $usuario['idcategoria'];
            $this->nome = $usuario['nome'];
            $this->email = $usuario['email'];
            $this->endereco = $usuario['endereco'];
            $this->numero = $usuario['numero'];
            $this->bairro = $usuario['bairro'];
            $this->cidade = $usuario['cidade'];
            $this->cep = $usuario['cep'];
            
            // Cria a sessão
            session_start();
            $_SESSION['idusuario'] = $this->idusuario;
            $_SESSION['idcategoria'] = $this->idcategoria;
            $_SESSION['nome'] = $this->nome;
            $_SESSION['celular'] = $this->celular;
            $_SESSION['email'] = $this->email;
            $_SESSION['endereco'] = $this->endereco;
            $_SESSION['numero'] = $this->numero;
            $_SESSION['bairro'] = $this->bairro;
            $_SESSION['cidade'] = $this->cidade;
            $_SESSION['cep'] = $this->cep;
            
            mysqli_stmt_close($stmt);
            return true;
        }
        
        mysqli_stmt_close($stmt);
    }
    
    return false;
}


}
