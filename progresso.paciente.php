<?php
session_start();
include_once("./componentes/usuario.php");
include_once("./conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Minha Conta - SlimVitta</title>

    <!-- DaisyUI + Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fdfcf9',
                            100: '#f8f7f3',
                            200: '#f0ede4',
                            300: '#e3dece',
                            400: '#d4c5a3',
                            500: '#d4a960',
                            600: '#b28b4f',
                            700: '#8e6e3e',
                            800: '#5c4a29',
                            900: '#3c311a',
                        },
                        neutral: {
                            50: '#ffffff',
                            100: '#f9f9f8',
                            200: '#e8e6e1',
                            300: '#d1cec7',
                            400: '#a7a39a',
                            500: '#7c776e',
                            600: '#57534e',
                            700: '#3d3a36',
                            800: '#292724',
                            900: '#1a1917',
                        },
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f9f8;
            color: #3d3a36;
        }

        .dashboard-card {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e6e1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .sidebar-menu-item {
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .sidebar-menu-item:hover {
            background-color: #f0ede4;
            transform: translateX(4px);
        }

        .sidebar-menu-item.active {
            background-color: #d4a960;
            color: white;
        }
    </style>
</head>

<body class="leading-relaxed">
    <!-- Layout Principal -->
    <div class="flex min-h-screen bg-neutral-50">

        <!-- Sidebar -->
        <div class="sidebar w-64 flex-shrink-0 bg-white border-r border-neutral-200">
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">S</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary-600">SlimVitta</h1>
                        <p class="text-xs text-neutral-500">Minha Conta</p>
                    </div>
                </div>

                <!-- Menu de Navegação -->
                <nav class="space-y-2">
                    <a href="./dashboard.paciente.php" class="sidebar-menu-item  flex items-center space-x-3 p-3">
                        <i class="fas fa-tachometer-alt w-5 text-center"></i>
                        <span>Visão Geral</span>
                    </a>

                    <a href="./avaliacoes.paciente.php" class="sidebar-menu-item  flex items-center space-x-3 p-3">
                        <i class="fas fa-clipboard-list w-5 text-center"></i>
                        <span>Minhas Avaliações</span>
                    </a>

                    <a href="#" class="sidebar-menu-item flex items-center space-x-3 p-3">
                        <i class="fas fa-shopping-cart w-5 text-center"></i>
                        <span>Meus Pedidos</span>
                    </a>

                    <a href="./dados.paciente.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
                        <i class="fas fa-user w-5 text-center"></i>
                        <span>Meus Dados</span>
                    </a>

                    <a href="./progresso.paciente.php" class="sidebar-menu-item active flex items-center space-x-3 p-3">
                        <i class="fas fa-chart-line w-5 text-center"></i>
                        <span>Meu Progresso</span>
                    </a>
                </nav>

                <!-- Separador -->
                <div class="my-6 border-t border-neutral-200"></div>

                <!-- Menu Secundário -->
                <nav class="space-y-2">
                    <a href="./middle/logout.php" class="sidebar-menu-item flex items-center space-x-3 p-3 text-red-600">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span>Sair</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Conteúdo Principal -->
        <div class="flex-1 flex flex-col">

            <!-- Header -->
            <header class="bg-white border-b border-neutral-200">
                <div class="flex items-center justify-between p-6">
                    <div class="flex items-center space-x-4">
                        <h2 class="text-2xl font-bold text-neutral-800">Minha Conta</h2>
                        <div class="text-sm text-neutral-500">Bem-vindo de volta, <?php echo $_SESSION['nome']; ?></div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notificações -->
                        <button class="btn btn-ghost btn-circle relative">
                            <i class="fas fa-bell text-neutral-600"></i>
                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-primary-500 rounded-full"></span>
                        </button>

                        <!-- Perfil -->
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" class="flex items-center space-x-3 cursor-pointer">
                                <div class="avatar">
                                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                                        <span class="text-primary-600 font-semibold">
                                            <?php echo substr($_SESSION['nome'], 0, 2); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="hidden md:block">
                                    <div class="font-semibold text-neutral-800"><?php echo $_SESSION['nome']; ?></div>
                                    <div class="text-xs text-neutral-500">Cliente</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Conteúdo -->
            <main class="flex-1 overflow-y-auto p-6">

                <!-- Cards de Resumo -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Card Avaliações -->
                    <div class="dashboard-card bg-white rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-primary-100 rounded-xl">
                                <i class="fas fa-weight text-primary-600 text-xl"></i>
                            </div>
                            <?php
                            $user = new Usuario();
                            $user->conn = $conn;
                            $user->idusuario = $_SESSION['idusuario'];
                            $user->SelectUsuario();
                            ?>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-neutral-800"><?= $user->peso; ?></div>
                                <div class="text-sm text-neutral-500">Kgs</div>
                            </div>
                        </div>
                        <h3 class="font-semibold text-neutral-700 mb-1">Meu Peso</h3>
                        <a href="./avaliacoes.paciente.php">
                        </a>
                    </div>

                    <!-- Card Pedidos -->
                    <div class="dashboard-card bg-white rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-primary-100 rounded-xl">
                                <i class="fas fa-chart-line text-primary-600 text-xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-neutral-800"><?= $_SESSION['difpeso'] ?>kg</div>
                                <div class="text-sm text-neutral-500">Perdidos</div>
                            </div>
                        </div>
                        <h3 class="font-semibold text-neutral-700 mb-1">Emagreci</h3>
                    </div>

                    <!-- Card Progresso -->
                    <div class="dashboard-card bg-white rounded-2xl p-12 text-1xl">
                        <div class="flex items-center justify-center mb-4">
                            <!-- Botão Editar Peso -->
                            <div class="p-3 bg-primary-100 rounded-xl">
                                <i class="fas fa-weight text-primary-600 text-xl"></i>
                                <button onclick="openModal('peso')" class="ml-2 text-primary-600 font-medium">Editar Peso</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Editar Peso -->
                    <div id="modalPeso" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                        <div class="bg-white rounded-2xl p-8 w-96">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-bold text-neutral-800">Editar Peso</h3>
                                <button onclick="closeModal('peso')" class="text-neutral-400 hover:text-neutral-600">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>

                            <form id="formPeso" method="POST" action="atualizar_peso.php">
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-neutral-700 mb-2">Novo Peso (kg)</label>
                                    <input
                                        type="number"
                                        name="peso"
                                        step="0.1"
                                        min="0"
                                        value="<?= $user->peso; ?>"
                                        class="w-full px-4 py-3 border border-neutral-300 bg-neutral-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        placeholder="Digite seu peso"
                                        required>
                                </div>

                                <div class="flex gap-3">
                                    <button
                                        type="button"
                                        onclick="closeModal('peso')"
                                        class="flex-1 px-4 py-3 border border-neutral-300 text-neutral-700 rounded-xl hover:bg-neutral-50 transition-colors">
                                        Cancelar
                                    </button>
                                    <button
                                        type="submit"
                                        class="flex-1 px-4 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition-colors">
                                        Salvar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <script>
                        // Funções para abrir e fechar modais
                        function openModal(tipo) {
                            if (tipo === 'peso') {
                                document.getElementById('modalPeso').classList.remove('hidden');
                                document.getElementById('modalPeso').classList.add('flex');
                            } else if (tipo === 'altura') {
                                document.getElementById('modalAltura').classList.remove('hidden');
                                document.getElementById('modalAltura').classList.add('flex');
                            }
                        }

                        function closeModal(tipo) {
                            if (tipo === 'peso') {
                                document.getElementById('modalPeso').classList.add('hidden');
                                document.getElementById('modalPeso').classList.remove('flex');
                            } else if (tipo === 'altura') {
                                document.getElementById('modalAltura').classList.add('hidden');
                                document.getElementById('modalAltura').classList.remove('flex');
                            }
                        }

                        // Fechar modal ao clicar fora do conteúdo
                        document.addEventListener('click', function(event) {
                            if (event.target.id === 'modalPeso') {
                                closeModal('peso');
                            }
                            if (event.target.id === 'modalAltura') {
                                closeModal('altura');
                            }
                        });

                        // Fechar com tecla ESC
                        document.addEventListener('keydown', function(event) {
                            if (event.key === 'Escape') {
                                closeModal('peso');
                                closeModal('altura');
                            }
                        });
                    </script>
                </div>

                <!-- Próxima Consulta e Ações Rápidas -->
                <div class="dashboard-card  rounded-xl lg:grid-cols-2 gap-6 mb-8">
                    <!-- Dados Pessoais - Versão Compacta -->
                    <div class="flex items-center justify-between p-6 mb-6">
                        <h3 class="text-lg font-semibold text-neutral-800">Meus Dados Pessoais</h3>
                        <button onclick="openModal('dadosPessoais')" class="text-primary-600 hover:text-primary-700 transition-colors">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Coluna 1 -->
                        <div class="space-y-4">
                            <div class="bg-neutral-50 rounded-xl p-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-user text-primary-600 mr-2 text-sm"></i>
                                    <span class="text-neutral-600 text-sm font-medium">Nome Completo</span>
                                </div>
                                <p class="text-neutral-800 font-semibold"><?= $user->nome; ?></p>
                            </div>

                            <div class="bg-neutral-50 rounded-xl p-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-phone text-primary-600 mr-2 text-sm"></i>
                                    <span class="text-neutral-600 text-sm font-medium">Celular</span>
                                </div>
                                <p class="text-neutral-800 font-semibold"><?= $user->celular; ?></p>
                            </div>

                            <div class="bg-neutral-50 rounded-xl p-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-id-card text-primary-600 mr-2 text-sm"></i>
                                    <span class="text-neutral-600 text-sm font-medium">CPF</span>
                                </div>
                                <p class="text-neutral-800 font-semibold"><?= $user->cpf; ?></p>
                            </div>
                        </div>

                        <!-- Coluna 2 -->
                        <div class="space-y-4">
                            <div class="bg-neutral-50 rounded-xl p-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-birthday-cake text-primary-600 mr-2 text-sm"></i>
                                    <span class="text-neutral-600 text-sm font-medium">Data Nasc.</span>
                                </div>
                                <p class="text-neutral-800 font-semibold"><?= date('d/m/Y', strtotime($user->datanascimento)); ?></p>
                            </div>

                            <div class="bg-neutral-50 rounded-xl p-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-venus-mars text-primary-600 mr-2 text-sm"></i>
                                    <span class="text-neutral-600 text-sm font-medium">Gênero</span>
                                </div>
                                <p class="text-neutral-800 font-semibold">
                                    <?php
                                    $generos = ['M' => 'Masculino', 'F' => 'Feminino', 'O' => 'Outro'];
                                    echo $generos[$user->genero] ?? $user->genero;
                                    ?>
                                </p>
                            </div>

                            <div class="bg-neutral-50 rounded-xl p-4">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-map-marker-alt text-primary-600 mr-2 text-sm"></i>
                                    <span class="text-neutral-600 text-sm font-medium">Cidade</span>
                                </div>
                                <p class="text-neutral-800 font-semibold"><?= $user->cidade; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Endereço Completo -->
                    <div class="mt-4 bg-neutral-50 rounded-xl p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-home text-primary-600 mr-2 text-sm"></i>
                            <span class="text-neutral-600 text-sm font-medium">Endereço Completo</span>
                        </div>
                        <p class="text-neutral-800 font-semibold">
                            <?= $user->endereco; ?>, <?= $user->numero; ?> - <?= $user->bairro; ?>, <?= $user->cidade; ?>
                        </p>
                    </div>
                </div>
        </div>

        </main>
    </div>



</body>

</html>