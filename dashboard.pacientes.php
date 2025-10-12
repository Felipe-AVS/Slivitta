<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pacientes - Dashboard SlimVitta</title>

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

    .patient-row:hover {
      background-color: #f8f7f3;
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
          <a href="dashboard.html" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Visão Geral</span>
          </a>
          
          <a href="avaliacoes.html" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-clipboard-list w-5 text-center"></i>
            <span>Avaliações</span>
          </a>
          
          <a href="pacientes.html" class="sidebar-menu-item active flex items-center space-x-3 p-3">
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
            <h2 class="text-2xl font-bold text-neutral-800">Pacientes</h2>
            <div class="text-sm text-neutral-500">Gerencie todos os pacientes cadastrados</div>
          </div>
          
          <div class="flex items-center space-x-4">
            <!-- Filtros e Busca -->
            <div class="flex space-x-2">
              <select class="select select-bordered select-sm">
                <option>Todos os status</option>
                <option>Ativos</option>
                <option>Inativos</option>
                <option>Em tratamento</option>
              </select>
              <input type="text" placeholder="Buscar paciente..." class="input input-bordered input-sm">
            </div>
            
            <!-- Botão Novo Paciente -->
            <button class="btn btn-primary btn-sm rounded-full" onclick="document.getElementById('modal-novo-paciente').showModal()">
              <i class="fas fa-plus mr-2"></i>
              Novo Paciente
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
        
        <!-- Cards de Resumo -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <!-- Total de Pacientes -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-neutral-800">156</div>
                <div class="text-sm text-neutral-500">Total</div>
              </div>
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-user-friends text-primary-600 text-xl"></i>
              </div>
            </div>
          </div>

          <!-- Ativos -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-green-600">142</div>
                <div class="text-sm text-neutral-500">Ativos</div>
              </div>
              <div class="p-3 bg-green-100 rounded-xl">
                <i class="fas fa-user-check text-green-600 text-xl"></i>
              </div>
            </div>
          </div>

          <!-- Em Tratamento -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-blue-600">89</div>
                <div class="text-sm text-neutral-500">Em Tratamento</div>
              </div>
              <div class="p-3 bg-blue-100 rounded-xl">
                <i class="fas fa-heartbeat text-blue-600 text-xl"></i>
              </div>
            </div>
          </div>

          <!-- Novos Este Mês -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-orange-500">24</div>
                <div class="text-sm text-neutral-500">Novos Este Mês</div>
              </div>
              <div class="p-3 bg-orange-100 rounded-xl">
                <i class="fas fa-user-plus text-orange-500 text-xl"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabela de Pacientes -->
        <div class="dashboard-card bg-white rounded-2xl p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-neutral-800">Todos os Pacientes</h3>
            <div class="text-sm text-neutral-500">156 pacientes cadastrados</div>
          </div>
          
          <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
              <thead>
                <tr>
                  <th class="bg-neutral-50">Paciente</th>
                  <th class="bg-neutral-50">Idade</th>
                  <th class="bg-neutral-50">IMC</th>
                  <th class="bg-neutral-50">Peso Atual</th>
                  <th class="bg-neutral-50">Status</th>
                  <th class="bg-neutral-50">Última Consulta</th>
                  <th class="bg-neutral-50">Ações</th>
                </tr>
              </thead>
              <tbody>
                <!-- Paciente 1 -->
                <tr class="patient-row">
                  <td>
                    <div class="flex items-center space-x-3">
                      <div class="avatar">
                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                          <span class="text-primary-600 font-semibold">MP</span>
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Maria Pereira</div>
                        <div class="text-sm text-neutral-500">maria.pereira@email.com</div>
                      </div>
                    </div>
                  </td>
                  <td>32 anos</td>
                  <td>31.2</td>
                  <td>84 kg</td>
                  <td>
                    <span class="badge badge-success badge-sm">Ativo</span>
                  </td>
                  <td>15/01/2024</td>
                  <td>
                    <div class="flex space-x-1">
                      <button class="btn btn-ghost btn-xs" onclick="editarPaciente(1)">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-ghost btn-xs">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="btn btn-ghost btn-xs text-error" onclick="excluirPaciente(1)">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Paciente 2 -->
                <tr class="patient-row">
                  <td>
                    <div class="flex items-center space-x-3">
                      <div class="avatar">
                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                          <span class="text-primary-600 font-semibold">JS</span>
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">João Silva</div>
                        <div class="text-sm text-neutral-500">joao.silva@email.com</div>
                      </div>
                    </div>
                  </td>
                  <td>45 anos</td>
                  <td>29.8</td>
                  <td>92 kg</td>
                  <td>
                    <span class="badge badge-success badge-sm">Ativo</span>
                  </td>
                  <td>14/01/2024</td>
                  <td>
                    <div class="flex space-x-1">
                      <button class="btn btn-ghost btn-xs" onclick="editarPaciente(2)">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-ghost btn-xs">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="btn btn-ghost btn-xs text-error" onclick="excluirPaciente(2)">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Paciente 3 -->
                <tr class="patient-row">
                  <td>
                    <div class="flex items-center space-x-3">
                      <div class="avatar">
                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                          <span class="text-primary-600 font-semibold">AC</span>
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Ana Costa</div>
                        <div class="text-sm text-neutral-500">ana.costa@email.com</div>
                      </div>
                    </div>
                  </td>
                  <td>28 anos</td>
                  <td>32.1</td>
                  <td>76 kg</td>
                  <td>
                    <span class="badge badge-warning badge-sm">Inativo</span>
                  </td>
                  <td>10/01/2024</td>
                  <td>
                    <div class="flex space-x-1">
                      <button class="btn btn-ghost btn-xs" onclick="editarPaciente(3)">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-ghost btn-xs">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="btn btn-ghost btn-xs text-error" onclick="excluirPaciente(3)">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Paciente 4 -->
                <tr class="patient-row">
                  <td>
                    <div class="flex items-center space-x-3">
                      <div class="avatar">
                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                          <span class="text-primary-600 font-semibold">CS</span>
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">Carlos Santos</div>
                        <div class="text-sm text-neutral-500">carlos.santos@email.com</div>
                      </div>
                    </div>
                  </td>
                  <td>38 anos</td>
                  <td>30.5</td>
                  <td>88 kg</td>
                  <td>
                    <span class="badge badge-success badge-sm">Ativo</span>
                  </td>
                  <td>12/01/2024</td>
                  <td>
                    <div class="flex space-x-1">
                      <button class="btn btn-ghost btn-xs" onclick="editarPaciente(4)">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-ghost btn-xs">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="btn btn-ghost btn-xs text-error" onclick="excluirPaciente(4)">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Paginação -->
          <div class="flex justify-between items-center mt-6">
            <div class="text-sm text-neutral-500">
              Mostrando 1-4 de 156 pacientes
            </div>
            <div class="join">
              <button class="join-item btn btn-sm">«</button>
              <button class="join-item btn btn-sm btn-active">1</button>
              <button class="join-item btn btn-sm">2</button>
              <button class="join-item btn btn-sm">3</button>
              <button class="join-item btn btn-sm">»</button>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- Modal Novo Paciente -->
  <dialog id="modal-novo-paciente" class="modal">
    <div class="modal-box max-w-4xl">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      </form>
      <h3 class="font-bold text-lg mb-6">Cadastrar Novo Paciente</h3>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Nome Completo</span>
          </label>
          <input type="text" class="input input-bordered" placeholder="Digite o nome completo">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">E-mail</span>
          </label>
          <input type="email" class="input input-bordered" placeholder="email@exemplo.com">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Telefone</span>
          </label>
          <input type="tel" class="input input-bordered" placeholder="(11) 99999-9999">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Data de Nascimento</span>
          </label>
          <input type="date" class="input input-bordered">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Peso Atual (kg)</span>
          </label>
          <input type="number" class="input input-bordered" placeholder="Ex: 75.5">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Altura (cm)</span>
          </label>
          <input type="number" class="input input-bordered" placeholder="Ex: 170">
        </div>
        
        <div class="form-control md:col-span-2">
          <label class="label">
            <span class="label-text">Condições de Saúde</span>
          </label>
          <textarea class="textarea textarea-bordered h-24" placeholder="Informe condições pré-existentes, alergias, etc."></textarea>
        </div>
      </div>
      
      <div class="modal-action">
        <form method="dialog">
          <button class="btn">Cancelar</button>
        </form>
        <button class="btn btn-primary">Cadastrar Paciente</button>
      </div>
    </div>
  </dialog>

  <!-- Modal Editar Paciente -->
  <dialog id="modal-editar-paciente" class="modal">
    <div class="modal-box max-w-4xl">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      </form>
      <h3 class="font-bold text-lg mb-6">Editar Paciente</h3>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Nome Completo</span>
          </label>
          <input type="text" class="input input-bordered" value="Maria Pereira">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">E-mail</span>
          </label>
          <input type="email" class="input input-bordered" value="maria.pereira@email.com">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Telefone</span>
          </label>
          <input type="tel" class="input input-bordered" value="(11) 99999-9999">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Data de Nascimento</span>
          </label>
          <input type="date" class="input input-bordered" value="1992-05-15">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Peso Atual (kg)</span>
          </label>
          <input type="number" class="input input-bordered" value="84">
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Altura (cm)</span>
          </label>
          <input type="number" class="input input-bordered" value="164">
        </div>
        
        <div class="form-control md:col-span-2">
          <label class="label">
            <span class="label-text">Condições de Saúde</span>
          </label>
          <textarea class="textarea textarea-bordered h-24">Nenhuma condição pré-existente relatada.</textarea>
        </div>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Status</span>
          </label>
          <select class="select select-bordered">
            <option>Ativo</option>
            <option>Inativo</option>
            <option>Em tratamento</option>
          </select>
        </div>
      </div>
      
      <div class="modal-action">
        <form method="dialog">
          <button class="btn">Cancelar</button>
        </form>
        <button class="btn btn-primary">Salvar Alterações</button>
      </div>
    </div>
  </dialog>

  <script>
    // Funções para gerenciar pacientes
    function editarPaciente(id) {
      document.getElementById('modal-editar-paciente').showModal();
    }

    function excluirPaciente(id) {
      if (confirm('Tem certeza que deseja excluir este paciente?')) {
        // Lógica para excluir paciente
        alert('Paciente excluído com sucesso!');
      }
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
    });
  </script>

</body>

</html>