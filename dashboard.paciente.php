<?php
session_start();
include_once("./componentes/avaliacao.php");
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
          <a href="./dashboard.pacientes.php" class="sidebar-menu-item active flex items-center space-x-3 p-3">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Visão Geral</span>
          </a>

          <a href="./avaliacoes.paciente.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-clipboard-list w-5 text-center"></i>
            <span>Minhas Avaliações</span>
          </a>

          <a href="#" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-shopping-cart w-5 text-center"></i>
            <span>Meus Pedidos</span>
          </a>

          <a href="#" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-user w-5 text-center"></i>
            <span>Meus Dados</span>
          </a>

          <a href="#" class="sidebar-menu-item flex items-center space-x-3 p-3">
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
                <i class="fas fa-clipboard-list text-primary-600 text-xl"></i>
              </div>
              <?php
              $avalicao = new Avaliacao();
              $avalicao->conn = $conn;
              $avalicao->idusuario = $_SESSION['idusuario'];
              $quantidadeAvaliacoes = $avalicao->SelectQuantidadeAvaliacaoPorUsuario($avalicao->idusuario);
              ?>
              <div class="text-right">
                <div class="text-2xl font-bold text-neutral-800"><?= $quantidadeAvaliacoes; ?></div>
                <div class="text-sm text-neutral-500">Realizadas</div>
              </div>
            </div>
            <h3 class="font-semibold text-neutral-700 mb-1">Minhas Avaliações</h3>
            <a href="./avaliacoes.paciente.php">
              <button class="btn btn-primary btn-sm mt-3 w-full rounded-full">
                Visualizar Avaliações
              </button>
            </a>
          </div>

          <!-- Card Pedidos -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-shopping-cart text-primary-600 text-xl"></i>
              </div>
              <div class="text-right">
                <div class="text-2xl font-bold text-neutral-800">5</div>
                <div class="text-sm text-neutral-500">Realizados</div>
              </div>
            </div>
            <h3 class="font-semibold text-neutral-700 mb-1">Meus Pedidos</h3>
            <p class="text-sm text-neutral-500">Pedidos efetuados</p>
            <button class="btn btn-outline btn-primary btn-sm mt-3 w-full rounded-full">
              Ver Pedidos
            </button>
          </div>

          <!-- Card Progresso -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-chart-line text-primary-600 text-xl"></i>
              </div>
              <div class="text-right">
                <div class="text-2xl font-bold text-neutral-800">-8kg</div>
                <div class="text-sm text-neutral-500">Perdidos</div>
              </div>
            </div>
            <h3 class="font-semibold text-neutral-700 mb-1">Meu Progresso</h3>
            <p class="text-sm text-neutral-500">Desde o início</p>
            <button class="btn btn-outline btn-primary btn-sm mt-3 w-full rounded-full">
              Ver Detalhes
            </button>
          </div>
        </div>

        <!-- Próxima Consulta e Ações Rápidas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

          <!-- Próxima Consulta -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-neutral-800 mb-4">Próxima Consulta</h3>

            <div class="bg-primary-50 rounded-xl p-4 border border-primary-200">
              <div class="flex items-center justify-between">
                <div>
                  <div class="font-semibold text-primary-700">Dr. Silva</div>
                  <div class="text-sm text-primary-600">Nutricionista</div>
                  <div class="text-xs text-primary-500 mt-1">
                    <i class="fas fa-calendar mr-1"></i>
                    20/01/2024 às 14:30
                  </div>
                </div>
                <div class="text-right">
                  <div class="badge badge-primary badge-lg">Confirmada</div>
                  <button class="btn btn-primary btn-sm mt-2 rounded-full">
                    <i class="fas fa-video mr-2"></i>
                    Entrar
                  </button>
                </div>
              </div>
            </div>

            <div class="mt-4 space-y-2">
              <button class="btn btn-outline btn-sm w-full rounded-full">
                <i class="fas fa-calendar-plus mr-2"></i>
                Agendar Nova Consulta
              </button>
              <button class="btn btn-ghost btn-sm w-full rounded-full">
                <i class="fas fa-history mr-2"></i>
                Ver Histórico
              </button>
            </div>
          </div>

          <!-- Ações Rápidas -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-neutral-800 mb-4">Ações Rápidas</h3>

            <div class="grid grid-cols-2 gap-4">
              <button class="btn btn-outline flex flex-col h-20 rounded-xl">
                <i class="fas fa-prescription text-primary-600 text-xl mb-1"></i>
                <span class="text-xs">Receitas</span>
              </button>

              <button class="btn btn-outline flex flex-col h-20 rounded-xl">
                <i class="fas fa-file-medical text-primary-600 text-xl mb-1"></i>
                <span class="text-xs">Laudos</span>
              </button>

              <button class="btn btn-outline flex flex-col h-20 rounded-xl">
                <i class="fas fa-utensils text-primary-600 text-xl mb-1"></i>
                <span class="text-xs">Dietas</span>
              </button>

              <button class="btn btn-outline flex flex-col h-20 rounded-xl">
                <i class="fas fa-dumbbell text-primary-600 text-xl mb-1"></i>
                <span class="text-xs">Exercícios</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Pedidos Recentes -->
        <div class="dashboard-card bg-white rounded-2xl p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-neutral-800">Meus Pedidos Recentes</h3>
            <button class="btn btn-outline btn-primary btn-sm rounded-full">
              Ver Todos
            </button>
          </div>

          <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
              <thead>
                <tr>
                  <th class="bg-neutral-50">Pedido</th>
                  <th class="bg-neutral-50">Produto</th>
                  <th class="bg-neutral-50">Data</th>
                  <th class="bg-neutral-50">Status</th>
                  <th class="bg-neutral-50">Valor</th>
                  <th class="bg-neutral-50">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#00123</td>
                  <td>Tirzepatida 5mg</td>
                  <td>15/01/2024</td>
                  <td>
                    <span class="badge badge-success badge-sm">Entregue</span>
                  </td>
                  <td>R$ 450,00</td>
                  <td>
                    <button class="btn btn-ghost btn-xs">
                      <i class="fas fa-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>#00122</td>
                  <td>Tirzepatida 2.5mg</td>
                  <td>10/01/2024</td>
                  <td>
                    <span class="badge badge-warning badge-sm">Processando</span>
                  </td>
                  <td>R$ 380,00</td>
                  <td>
                    <button class="btn btn-ghost btn-xs">
                      <i class="fas fa-eye"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </main>
    </div>
  </div>

</body>

</html>