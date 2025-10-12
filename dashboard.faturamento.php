<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Faturamento - Dashboard SlimVitta</title>

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

    .revenue-up { color: #10b981; }
    .revenue-down { color: #ef4444; }
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
          <a href="dashboard.html" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Visão Geral</span>
          </a>
          
          <a href="avaliacoes.html" class="sidebar-menu-item flex items-center space-x-3 p-3">
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
          
          <a href="faturamento.html" class="sidebar-menu-item active flex items-center space-x-3 p-3">
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
            <h2 class="text-2xl font-bold text-neutral-800">Faturamento</h2>
            <div class="text-sm text-neutral-500">Resumo financeiro e métricas</div>
          </div>
          
          <div class="flex items-center space-x-4">
            <!-- Filtro de Período -->
            <div class="flex space-x-2">
              <select class="select select-bordered select-sm" id="periodo-select">
                <option value="hoje">Hoje</option>
                <option value="semana" selected>Esta Semana</option>
                <option value="mes">Este Mês</option>
                <option value="ano">Este Ano</option>
              </select>
            </div>
            
            <!-- Botão Exportar -->
            <button class="btn btn-outline btn-primary btn-sm rounded-full">
              <i class="fas fa-download mr-2"></i>
              Exportar
            </button>
            
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
        
        <!-- Cards Principais de Faturamento -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <!-- Faturamento Total -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div>
                <div class="text-2xl font-bold text-neutral-800" id="faturamento-total">R$ 28.540</div>
                <div class="text-sm text-neutral-500">Faturamento Total</div>
              </div>
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-money-bill-wave text-primary-600 text-xl"></i>
              </div>
            </div>
            <div class="flex items-center text-sm revenue-up">
              <i class="fas fa-arrow-up mr-1"></i>
              <span>+15% em relação ao período anterior</span>
            </div>
          </div>

          <!-- Pedidos Realizados -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div>
                <div class="text-2xl font-bold text-neutral-800" id="total-pedidos">42</div>
                <div class="text-sm text-neutral-500">Pedidos Realizados</div>
              </div>
              <div class="p-3 bg-green-100 rounded-xl">
                <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
              </div>
            </div>
            <div class="flex items-center text-sm revenue-up">
              <i class="fas fa-arrow-up mr-1"></i>
              <span>+8% em relação ao período anterior</span>
            </div>
          </div>

          <!-- Ticket Médio -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div>
                <div class="text-2xl font-bold text-neutral-800" id="ticket-medio">R$ 679</div>
                <div class="text-sm text-neutral-500">Ticket Médio</div>
              </div>
              <div class="p-3 bg-blue-100 rounded-xl">
                <i class="fas fa-chart-bar text-blue-600 text-xl"></i>
              </div>
            </div>
            <div class="flex items-center text-sm revenue-up">
              <i class="fas fa-arrow-up mr-1"></i>
              <span>+5% em relação ao período anterior</span>
            </div>
          </div>

          <!-- Novos Pacientes -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
              <div>
                <div class="text-2xl font-bold text-neutral-800" id="novos-pacientes">24</div>
                <div class="text-sm text-neutral-500">Novos Pacientes</div>
              </div>
              <div class="p-3 bg-purple-100 rounded-xl">
                <i class="fas fa-user-plus text-purple-600 text-xl"></i>
              </div>
            </div>
            <div class="flex items-center text-sm revenue-up">
              <i class="fas fa-arrow-up mr-1"></i>
              <span>+12% em relação ao período anterior</span>
            </div>
          </div>
        </div>

        <!-- Gráfico e Detalhamento -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          
          <!-- Gráfico de Faturamento -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-lg font-semibold text-neutral-800">Evolução do Faturamento</h3>
              <div class="text-sm text-neutral-500" id="periodo-texto">Esta Semana</div>
            </div>
            
            <!-- Gráfico Simulado -->
            <div class="bg-neutral-50 rounded-xl p-4 h-64 flex items-center justify-center">
              <div class="text-center">
                <i class="fas fa-chart-line text-4xl text-primary-500 mb-3"></i>
                <p class="text-neutral-600">Gráfico de evolução do faturamento</p>
                <p class="text-sm text-neutral-500">Visualização dos dados por período selecionado</p>
              </div>
            </div>
          </div>

          <!-- Produtos Mais Vendidos -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-lg font-semibold text-neutral-800">Produtos Mais Vendidos</h3>
              <div class="text-sm text-neutral-500">Período atual</div>
            </div>
            
            <div class="space-y-4">
              <!-- Produto 1 -->
              <div class="flex items-center justify-between p-3 hover:bg-neutral-50 rounded-lg">
                <div class="flex items-center space-x-3">
                  <div class="p-2 bg-primary-100 rounded-lg">
                    <i class="fas fa-capsules text-primary-600"></i>
                  </div>
                  <div>
                    <div class="font-semibold text-neutral-800">Tirzepatida 5mg</div>
                    <div class="text-sm text-neutral-500">4 semanas</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="font-semibold text-primary-600">28 vendas</div>
                  <div class="text-xs text-neutral-500">R$ 12.600</div>
                </div>
              </div>

              <!-- Produto 2 -->
              <div class="flex items-center justify-between p-3 hover:bg-neutral-50 rounded-lg">
                <div class="flex items-center space-x-3">
                  <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-capsules text-green-600"></i>
                  </div>
                  <div>
                    <div class="font-semibold text-neutral-800">Tirzepatida 2.5mg</div>
                    <div class="text-sm text-neutral-500">4 semanas</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="font-semibold text-primary-600">14 vendas</div>
                  <div class="text-xs text-neutral-500">R$ 5.320</div>
                </div>
              </div>

              <!-- Produto 3 -->
              <div class="flex items-center justify-between p-3 hover:bg-neutral-50 rounded-lg">
                <div class="flex items-center space-x-3">
                  <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-prescription text-blue-600"></i>
                  </div>
                  <div>
                    <div class="font-semibold text-neutral-800">Consulta Inicial</div>
                    <div class="text-sm text-neutral-500">Avaliação</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="font-semibold text-primary-600">24 vendas</div>
                  <div class="text-xs text-neutral-500">R$ 7.200</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabela de Transações Recentes -->
        <div class="dashboard-card bg-white rounded-2xl p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-neutral-800">Transações Recentes</h3>
            <button class="btn btn-outline btn-primary btn-sm rounded-full">
              Ver Todas
            </button>
          </div>
          
          <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
              <thead>
                <tr>
                  <th class="bg-neutral-50">Data</th>
                  <th class="bg-neutral-50">Paciente</th>
                  <th class="bg-neutral-50">Produto/Serviço</th>
                  <th class="bg-neutral-50">Valor</th>
                  <th class="bg-neutral-50">Status</th>
                  <th class="bg-neutral-50">Forma de Pagamento</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>15/01/2024</td>
                  <td>Maria Pereira</td>
                  <td>Tirzepatida 5mg - 4 semanas</td>
                  <td>R$ 450,00</td>
                  <td>
                    <span class="badge badge-success badge-sm">Pago</span>
                  </td>
                  <td>Cartão de Crédito</td>
                </tr>
                <tr>
                  <td>14/01/2024</td>
                  <td>João Silva</td>
                  <td>Tirzepatida 2.5mg - 4 semanas</td>
                  <td>R$ 380,00</td>
                  <td>
                    <span class="badge badge-success badge-sm">Pago</span>
                  </td>
                  <td>PIX</td>
                </tr>
                <tr>
                  <td>13/01/2024</td>
                  <td>Ana Costa</td>
                  <td>Consulta Inicial</td>
                  <td>R$ 300,00</td>
                  <td>
                    <span class="badge badge-success badge-sm">Pago</span>
                  </td>
                  <td>Cartão de Débito</td>
                </tr>
                <tr>
                  <td>12/01/2024</td>
                  <td>Carlos Santos</td>
                  <td>Tirzepatida 5mg - 8 semanas</td>
                  <td>R$ 900,00</td>
                  <td>
                    <span class="badge badge-success badge-sm">Pago</span>
                  </td>
                  <td>PIX</td>
                </tr>
                <tr>
                  <td>11/01/2024</td>
                  <td>Roberto Alves</td>
                  <td>Tirzepatida 5mg - 4 semanas</td>
                  <td>R$ 450,00</td>
                  <td>
                    <span class="badge badge-warning badge-sm">Pendente</span>
                  </td>
                  <td>Boleto</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </main>
    </div>
  </div>

  <script>
    // Dados por período (simulados)
    const dadosPeriodo = {
      hoje: {
        faturamento: 'R$ 2.850',
        pedidos: '8',
        ticket: 'R$ 356',
        pacientes: '3',
        periodo: 'Hoje'
      },
      semana: {
        faturamento: 'R$ 28.540',
        pedidos: '42',
        ticket: 'R$ 679',
        pacientes: '24',
        periodo: 'Esta Semana'
      },
      mes: {
        faturamento: 'R$ 98.750',
        pedidos: '156',
        ticket: 'R$ 633',
        pacientes: '89',
        periodo: 'Este Mês'
      },
      ano: {
        faturamento: 'R$ 1.245.300',
        pedidos: '1.842',
        ticket: 'R$ 676',
        pacientes: '1.156',
        periodo: 'Este Ano'
      }
    };

    // Função para atualizar os dados conforme o período selecionado
    function atualizarDadosPeriodo() {
      const periodo = document.getElementById('periodo-select').value;
      const dados = dadosPeriodo[periodo];
      
      document.getElementById('faturamento-total').textContent = dados.faturamento;
      document.getElementById('total-pedidos').textContent = dados.pedidos;
      document.getElementById('ticket-medio').textContent = dados.ticket;
      document.getElementById('novos-pacientes').textContent = dados.pacientes;
      document.getElementById('periodo-texto').textContent = dados.periodo;
    }

    // Script para menu ativo
    document.addEventListener('DOMContentLoaded', function() {
      const menuItems = document.querySelectorAll('.sidebar-menu-item');
      
      menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
          e.preventDefault();
          
          // Remove active class from all items
          menuItems.forEach(i => i.classList.remove('active'));
          
          // Add active class to clicked item
          this.classList.add('active');
        });
      });

      // Configurar evento do seletor de período
      document.getElementById('periodo-select').addEventListener('change', atualizarDadosPeriodo);
      
      // Inicializar com dados da semana
      atualizarDadosPeriodo();
    });
  </script>

</body>

</html>