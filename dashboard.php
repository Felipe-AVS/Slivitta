<?php
include_once("./conexao.php");
include_once("./componentes/avaliacao.php");

$aval = new Avaliacao();
$aval->conn = $conn;
$status = 2;




?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - SlimVitta</title>

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
              500: '#d4a960', // dourado base
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
      overflow-x: hidden;
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

    .sidebar {
      background: linear-gradient(135deg, #f8f7f3 0%, #f0ede4 100%);
      border-right: 1px solid #e8e6e1;
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

    .stat-card {
      background: linear-gradient(135deg, #ffffff 0%, #f8f7f3 100%);
    }
  </style>
</head>

<body class="leading-relaxed">
  <!-- Layout Principal -->
  <div class="flex h-screen bg-neutral-50">

    <!-- Sidebar -->
    <div class="sidebar w-64 flex-shrink-0">
      <div class="p-6">
        <!-- Logo -->
        <div class="flex items-center space-x-3 mb-8">
          <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-lg">S</span>
          </div>
          <div>
            <h1 class="text-xl font-bold text-primary-600">SlimVitta</h1>
            <p class="text-xs text-neutral-500">Dashboard Empresarial</p>
          </div>
        </div>

        <!-- Menu de Navegação -->
        <nav class="space-y-2">
          <a href="./dashboard.php" class="sidebar-menu-item active flex items-center space-x-3 p-3">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Visão Geral</span>
          </a>

          <a href="./dashboard.avaliacoes.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-clipboard-list w-5 text-center"></i>
            <span>Avaliações</span>
          </a>

          <a href="./dashboard.pacientes.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-user-friends w-5 text-center"></i>
            <span>Pacientes</span>
          </a>

          <a href="./dashboard.pedidos.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-shopping-cart w-5 text-center"></i>
            <span>Pedidos</span>
          </a>

          <a href="./dashboard.faturamento.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-chart-line w-5 text-center"></i>
            <span>Faturamento</span>
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
    <div class="flex-1 flex flex-col overflow-hidden">

      <!-- Header -->
      <header class="bg-white border-b border-neutral-200">
        <div class="flex items-center justify-between p-6">
          <div class="flex items-center space-x-4">
            <h2 class="text-2xl font-bold text-neutral-800">Dashboard</h2>
            <div class="text-sm text-neutral-500">Bem-vindo de volta, Dr. Silva</div>
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
                    <span class="text-primary-600 font-semibold">DS</span>
                  </div>
                </div>
                <div class="hidden md:block">
                  <div class="font-semibold text-neutral-800">Dr. Silva</div>
                  <div class="text-xs text-neutral-500">Administrador</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- Conteúdo -->
      <main class="flex-1 overflow-y-auto p-6">

        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Card Avaliações -->
          <div class="dashboard-card stat-card rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-clipboard-list text-primary-600 text-xl"></i>
              </div>
              <div class="text-right">
                <div class="text-2xl font-bold text-neutral-800"><?= $aval->SelectQuantidadePorStatus($status); ?></div>
              </div>
            </div>
            <h3 class="font-semibold text-neutral-700 mb-1">Avaliações</h3>
            <p class="text-sm text-green-500">Avaliações Aprovadas</p>
            <div class="mt-3 flex items-center text-sm text-green-600">
            </div>
          </div>

          <!-- Card Pacientes -->
          <div class="dashboard-card stat-card rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-user-friends text-primary-600 text-xl"></i>
              </div>
              <div class="text-right">
                <div class="text-2xl font-bold text-neutral-800">156</div>
                <div class="text-sm text-neutral-500">Ativos</div>
              </div>
            </div>
            <h3 class="font-semibold text-neutral-700 mb-1">Pacientes</h3>
            <p class="text-sm text-green-500">Pacientes Registrados</p>
          </div>

          <!-- Card Pedidos -->
          <div class="dashboard-card stat-card rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-shopping-cart text-primary-600 text-xl"></i>
              </div>
              <div class="text-right">
                <div class="text-2xl font-bold text-neutral-800">42</div>
                <div class="text-sm text-neutral-500">Pendentes</div>
              </div>
            </div>
            <h3 class="font-semibold text-neutral-700 mb-1">Pedidos</h3>
            <p class="text-sm text-neutral-500">Pedidos para processar</p>
            <div class="mt-3 flex items-center text-sm text-orange-500">
              <i class="fas fa-clock mr-1"></i>
              <span>5 urgentes</span>
            </div>
          </div>

          <!-- Card Faturamento -->
          <div class="dashboard-card stat-card rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-chart-line text-primary-600 text-xl"></i>
              </div>
              <div class="text-right">
                <div class="text-2xl font-bold text-neutral-800">R$ 28.5k</div>
                <div class="text-sm text-neutral-500">Este mês</div>
              </div>
            </div>
            <h3 class="font-semibold text-neutral-700 mb-1">Faturamento</h3>
            <p class="text-sm text-neutral-500">Receita total</p>
            <div class="mt-3 flex items-center text-sm text-green-600">
              <i class="fas fa-arrow-up mr-1"></i>
              <span>+15% em relação ao mês passado</span>
            </div>
          </div>
        </div>

        <!-- Gráficos e Tabelas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

          <!-- Gráfico de Atividade -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-lg font-semibold text-neutral-800">Atividade Recente</h3>
              <select class="select select-bordered select-sm">
                <option>Últimos 7 dias</option>
                <option>Últimos 30 dias</option>
                <option>Este mês</option>
              </select>
            </div>

            <!-- Gráfico Simulado -->
            <div class="bg-neutral-50 rounded-xl p-4 h-64 flex items-center justify-center">
              <div class="text-center">
                <i class="fas fa-chart-bar text-4xl text-primary-500 mb-3"></i>
                <p class="text-neutral-600">Gráfico de atividade</p>
                <p class="text-sm text-neutral-500">Visualização dos dados de acesso</p>
              </div>
            </div>
          </div>

          <!-- Lista de Pacientes Recentes -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-lg font-semibold text-neutral-800">Pacientes Recentes</h3>
              <button class="btn btn-primary btn-sm rounded-full">
                <i class="fas fa-plus mr-2"></i>
                Novo
              </button>
            </div>

            <div class="space-y-4">
              <!-- Paciente 1 -->
              <div class="flex items-center justify-between p-3 hover:bg-neutral-50 rounded-lg">
                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                      <span class="text-primary-600 font-semibold">MP</span>
                    </div>
                  </div>
                  <div>
                    <div class="font-semibold text-neutral-800">Maria Pereira</div>
                    <div class="text-sm text-neutral-500">Iniciou há 2 dias</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="font-semibold text-primary-600">-3kg</div>
                  <div class="text-xs text-neutral-500">Primeira semana</div>
                </div>
              </div>

              <!-- Paciente 2 -->
              <div class="flex items-center justify-between p-3 hover:bg-neutral-50 rounded-lg">
                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                      <span class="text-primary-600 font-semibold">JS</span>
                    </div>
                  </div>
                  <div>
                    <div class="font-semibold text-neutral-800">João Silva</div>
                    <div class="text-sm text-neutral-500">1 mês de tratamento</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="font-semibold text-primary-600">-8kg</div>
                  <div class="text-xs text-neutral-500">Excelente progresso</div>
                </div>
              </div>

              <!-- Paciente 3 -->
              <div class="flex items-center justify-between p-3 hover:bg-neutral-50 rounded-lg">
                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                      <span class="text-primary-600 font-semibold">AC</span>
                    </div>
                  </div>
                  <div>
                    <div class="font-semibold text-neutral-800">Ana Costa</div>
                    <div class="text-sm text-neutral-500">2 semanas</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="font-semibold text-primary-600">-5kg</div>
                  <div class="text-xs text-neutral-500">Bom progresso</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabela de Pedidos -->
        <div class="dashboard-card bg-white rounded-2xl p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-neutral-800">Pedidos Recentes</h3>
            <button class="btn btn-outline btn-primary btn-sm rounded-full">
              Ver Todos
            </button>
          </div>

          <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
              <thead>
                <tr>
                  <th class="bg-neutral-50">Paciente</th>
                  <th class="bg-neutral-50">Produto</th>
                  <th class="bg-neutral-50">Data</th>
                  <th class="bg-neutral-50">Status</th>
                  <th class="bg-neutral-50">Valor</th>
                  <th class="bg-neutral-50">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Carlos Santos</td>
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
                  <td>Mariana Lima</td>
                  <td>Tirzepatida 2.5mg</td>
                  <td>14/01/2024</td>
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
                <tr>
                  <td>Roberto Alves</td>
                  <td>Tirzepatida 5mg</td>
                  <td>13/01/2024</td>
                  <td>
                    <span class="badge badge-error badge-sm">Pendente</span>
                  </td>
                  <td>R$ 450,00</td>
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

  <script>
    // Script para menu ativo
    document.addEventListener('DOMContentLoaded', function() {
      const menuItems = document.querySelectorAll('.sidebar-menu-item');

      menuItems.forEach(item => {
        item.addEventListener('click', function() {
          menuItems.forEach(i => i.classList.remove('active'));
          this.classList.add('active');
          // sem preventDefault()
        });
      });
    });
  </script>

</body>

</html>