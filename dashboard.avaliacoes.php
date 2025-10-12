<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Avaliações - Dashboard SlimVitta</title>

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

    .evaluation-card {
      border-left: 4px solid #d4a960;
    }

    .status-pending {
      border-left-color: #f59e0b;
    }

    .status-approved {
      border-left-color: #10b981;
    }

    .status-cancelled {
      border-left-color: #ef4444;
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
            <p class="text-xs text-neutral-500">Dashboard</p>
          </div>
        </div>

        <!-- Menu de Navegação -->
        <nav class="space-y-2">
          <a href="./dashboard.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Visão Geral</span>
          </a>
          
          <a href="avaliacoes.html" class="sidebar-menu-item active flex items-center space-x-3 p-3">
            <i class="fas fa-clipboard-list w-5 text-center"></i>
            <span>Avaliações</span>
          </a>
          
          <a href="pacientes.html" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-user-friends w-5 text-center"></i>
            <span>Pacientes</span>
          </a>
          
          <a href="pedidos.html" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-shopping-cart w-5 text-center"></i>
            <span>Pedidos</span>
          </a>
          
          <a href="faturamento.html" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-chart-line w-5 text-center"></i>
            <span>Faturamento</span>
          </a>
        </nav>

        <!-- Separador -->
        <div class="my-6 border-t border-neutral-200"></div>

        <!-- Menu Secundário -->
        <nav class="space-y-2">
          <a href="#" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-cog w-5 text-center"></i>
            <span>Configurações</span>
          </a>
          
          <a href="#" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-question-circle w-5 text-center"></i>
            <span>Ajuda</span>
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
            <h2 class="text-2xl font-bold text-neutral-800">Avaliações</h2>
            <div class="text-sm text-neutral-500">Gerencie as avaliações dos pacientes</div>
          </div>
          
          <div class="flex items-center space-x-4">
            <!-- Filtros -->
            <div class="flex space-x-2">
              <select class="select select-bordered select-sm">
                <option>Todos os status</option>
                <option>Pendentes</option>
                <option>Aprovados</option>
                <option>Cancelados</option>
              </select>
              <input type="text" placeholder="Buscar..." class="input input-bordered input-sm">
            </div>
            
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
        
        <!-- Cards de Resumo -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <!-- Total de Avaliações -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-neutral-800">42</div>
                <div class="text-sm text-neutral-500">Total</div>
              </div>
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-clipboard-list text-primary-600 text-xl"></i>
              </div>
            </div>
          </div>

          <!-- Pendentes -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-orange-500">18</div>
                <div class="text-sm text-neutral-500">Pendentes</div>
              </div>
              <div class="p-3 bg-orange-100 rounded-xl">
                <i class="fas fa-clock text-orange-500 text-xl"></i>
              </div>
            </div>
          </div>

          <!-- Aprovadas -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-green-600">22</div>
                <div class="text-sm text-neutral-500">Aprovadas</div>
              </div>
              <div class="p-3 bg-green-100 rounded-xl">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
              </div>
            </div>
          </div>

          <!-- Canceladas -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-red-500">2</div>
                <div class="text-sm text-neutral-500">Canceladas</div>
              </div>
              <div class="p-3 bg-red-100 rounded-xl">
                <i class="fas fa-times-circle text-red-500 text-xl"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Abas de Status -->
        <div class="tabs tabs-boxed bg-neutral-100 p-1 rounded-xl mb-6">
          <a class="tab tab-active">Pendentes de Análise</a>
          <a class="tab">Aprovadas</a>
          <a class="tab">Canceladas</a>
        </div>

        <!-- Lista de Avaliações Pendentes -->
        <div class="dashboard-card bg-white rounded-2xl p-6 mb-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-neutral-800">Avaliações Pendentes de Análise</h3>
            <div class="text-sm text-neutral-500">18 avaliações aguardando análise</div>
          </div>
          
          <div class="space-y-4">
            <!-- Avaliação 1 -->
            <div class="evaluation-card status-pending bg-white border rounded-lg p-4">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                      <span class="text-primary-600 font-semibold">MP</span>
                    </div>
                  </div>
                  <div>
                    <div class="font-semibold text-neutral-800">Maria Pereira</div>
                    <div class="text-sm text-neutral-500">32 anos • IMC: 31.2</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="badge badge-warning badge-lg">Pendente</div>
                  <div class="text-xs text-neutral-500 mt-1">Enviada: 15/01/2024</div>
                </div>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                  <div class="text-sm text-neutral-500">Peso Atual</div>
                  <div class="font-semibold">84 kg</div>
                </div>
                <div>
                  <div class="text-sm text-neutral-500">Objetivo</div>
                  <div class="font-semibold">68 kg</div>
                </div>
                <div>
                  <div class="text-sm text-neutral-500">Tempo Esperado</div>
                  <div class="font-semibold">6 meses</div>
                </div>
              </div>
              
              <div class="flex justify-end space-x-2">
                <button class="btn btn-primary btn-sm rounded-full">
                  <i class="fas fa-eye mr-2"></i>
                  Ver Detalhes
                </button>
                <button class="btn btn-success btn-sm rounded-full">
                  <i class="fas fa-check mr-2"></i>
                  Aprovar
                </button>
                <button class="btn btn-error btn-sm rounded-full">
                  <i class="fas fa-times mr-2"></i>
                  Recusar
                </button>
              </div>
            </div>

            <!-- Avaliação 2 -->
            <div class="evaluation-card status-pending bg-white border rounded-lg p-4">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                      <span class="text-primary-600 font-semibold">JS</span>
                    </div>
                  </div>
                  <div>
                    <div class="font-semibold text-neutral-800">João Silva</div>
                    <div class="text-sm text-neutral-500">45 anos • IMC: 29.8</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="badge badge-warning badge-lg">Pendente</div>
                  <div class="text-xs text-neutral-500 mt-1">Enviada: 14/01/2024</div>
                </div>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                  <div class="text-sm text-neutral-500">Peso Atual</div>
                  <div class="font-semibold">92 kg</div>
                </div>
                <div>
                  <div class="text-sm text-neutral-500">Objetivo</div>
                  <div class="font-semibold">78 kg</div>
                </div>
                <div>
                  <div class="text-sm text-neutral-500">Tempo Esperado</div>
                  <div class="font-semibold">8 meses</div>
                </div>
              </div>
              
              <div class="flex justify-end space-x-2">
                <button class="btn btn-primary btn-sm rounded-full">
                  <i class="fas fa-eye mr-2"></i>
                  Ver Detalhes
                </button>
                <button class="btn btn-success btn-sm rounded-full">
                  <i class="fas fa-check mr-2"></i>
                  Aprovar
                </button>
                <button class="btn btn-error btn-sm rounded-full">
                  <i class="fas fa-times mr-2"></i>
                  Recusar
                </button>
              </div>
            </div>

            <!-- Avaliação 3 -->
            <div class="evaluation-card status-pending bg-white border rounded-lg p-4">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                      <span class="text-primary-600 font-semibold">AC</span>
                    </div>
                  </div>
                  <div>
                    <div class="font-semibold text-neutral-800">Ana Costa</div>
                    <div class="text-sm text-neutral-500">28 anos • IMC: 32.1</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="badge badge-warning badge-lg">Pendente</div>
                  <div class="text-xs text-neutral-500 mt-1">Enviada: 13/01/2024</div>
                </div>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                  <div class="text-sm text-neutral-500">Peso Atual</div>
                  <div class="font-semibold">76 kg</div>
                </div>
                <div>
                  <div class="text-sm text-neutral-500">Objetivo</div>
                  <div class="font-semibold">62 kg</div>
                </div>
                <div>
                  <div class="text-sm text-neutral-500">Tempo Esperado</div>
                  <div class="font-semibold">5 meses</div>
                </div>
              </div>
              
              <div class="flex justify-end space-x-2">
                <button class="btn btn-primary btn-sm rounded-full">
                  <i class="fas fa-eye mr-2"></i>
                  Ver Detalhes
                </button>
                <button class="btn btn-success btn-sm rounded-full">
                  <i class="fas fa-check mr-2"></i>
                  Aprovar
                </button>
                <button class="btn btn-error btn-sm rounded-full">
                  <i class="fas fa-times mr-2"></i>
                  Recusar
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Lista de Avaliações Aprovadas -->
        <div class="dashboard-card bg-white rounded-2xl p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-neutral-800">Avaliações Aprovadas</h3>
            <div class="text-sm text-neutral-500">22 avaliações aprovadas</div>
          </div>
          
          <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
              <thead>
                <tr>
                  <th class="bg-neutral-50">Paciente</th>
                  <th class="bg-neutral-50">Data</th>
                  <th class="bg-neutral-50">IMC</th>
                  <th class="bg-neutral-50">Peso Atual</th>
                  <th class="bg-neutral-50">Objetivo</th>
                  <th class="bg-neutral-50">Status</th>
                  <th class="bg-neutral-50">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="flex items-center space-x-2">
                      <div class="avatar">
                        <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                          <span class="text-primary-600 text-xs font-semibold">CS</span>
                        </div>
                      </div>
                      <span>Carlos Santos</span>
                    </div>
                  </td>
                  <td>12/01/2024</td>
                  <td>30.5</td>
                  <td>88 kg</td>
                  <td>72 kg</td>
                  <td>
                    <span class="badge badge-success badge-sm">Aprovado</span>
                  </td>
                  <td>
                    <button class="btn btn-ghost btn-xs">
                      <i class="fas fa-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="flex items-center space-x-2">
                      <div class="avatar">
                        <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                          <span class="text-primary-600 text-xs font-semibold">ML</span>
                        </div>
                      </div>
                      <span>Mariana Lima</span>
                    </div>
                  </td>
                  <td>11/01/2024</td>
                  <td>31.8</td>
                  <td>82 kg</td>
                  <td>65 kg</td>
                  <td>
                    <span class="badge badge-success badge-sm">Aprovado</span>
                  </td>
                  <td>
                    <button class="btn btn-ghost btn-xs">
                      <i class="fas fa-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="flex items-center space-x-2">
                      <div class="avatar">
                        <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                          <span class="text-primary-600 text-xs font-semibold">RA</span>
                        </div>
                      </div>
                      <span>Roberto Alves</span>
                    </div>
                  </td>
                  <td>10/01/2024</td>
                  <td>29.9</td>
                  <td>95 kg</td>
                  <td>80 kg</td>
                  <td>
                    <span class="badge badge-success badge-sm">Aprovado</span>
                  </td>
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
    // Script para abas
    document.addEventListener('DOMContentLoaded', function() {
      const tabs = document.querySelectorAll('.tab');
      
      tabs.forEach(tab => {
        tab.addEventListener('click', function() {
          // Remove active class from all tabs
          tabs.forEach(t => t.classList.remove('tab-active'));
          
          // Add active class to clicked tab
          this.classList.add('tab-active');
        });
      });
    });
  </script>

</body>

</html>