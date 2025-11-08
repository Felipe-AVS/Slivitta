<?php
session_start();
include_once("./componentes/pedido.php"); // Inclui a classe Pedido
include_once("conexao.php");

// Instancia a classe Pedido
$pedidoComp = new Pedido();
$pedidoComp->conn = $conn;

// Filtros
$status_filter = $_GET['status'] ?? '';
$search_filter = $_GET['search'] ?? '';

// Buscar pedidos
$pedidos = $pedidoComp->SelectPedido();

// Estatísticas
$total_pedidos = count($pedidos);
$preparando = 0;
$prontos = 0;
$entregues = 0;

foreach ($pedidos as $pedido) {
    switch ($pedido['idpedidostatus']) {
        case 1: $preparando++; break;
        case 2: $prontos++; break;
        case 3: $entregues++; break;
    }
}

// Fechar conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pedidos - Dashboard SlimVitta</title>

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

    .order-row:hover {
      background-color: #f8f7f3;
    }

    .status-preparing { border-left: 4px solid #f59e0b; }
    .status-ready { border-left: 4px solid #10b981; }
    .status-delivered { border-left: 4px solid #3b82f6; }
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
          <a href="dashboard.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Visão Geral</span>
          </a>
          
          <a href="avaliacoes.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-clipboard-list w-5 text-center"></i>
            <span>Avaliações</span>
          </a>
          
          <a href="pacientes.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-user-friends w-5 text-center"></i>
            <span>Pacientes</span>
          </a>
          
          <a href="pedidos.php" class="sidebar-menu-item active flex items-center space-x-3 p-3">
            <i class="fas fa-shopping-cart w-5 text-center"></i>
            <span>Pedidos</span>
          </a>
          
          <a href="faturamento.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
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
            <h2 class="text-2xl font-bold text-neutral-800">Pedidos</h2>
            <div class="text-sm text-neutral-500">Controle de vendas e entregas</div>
          </div>
          
          <div class="flex items-center space-x-4">
            <!-- Filtros -->
           
            
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
          <!-- Total de Pedidos -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-neutral-800"><?= $total_pedidos ?></div>
                <div class="text-sm text-neutral-500">Total</div>
              </div>
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-shopping-cart text-primary-600 text-xl"></i>
              </div>
            </div>
          </div>

          <!-- Preparando -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-orange-500"><?= $preparando ?></div>
                <div class="text-sm text-neutral-500">Preparando</div>
              </div>
              <div class="p-3 bg-orange-100 rounded-xl">
                <i class="fas fa-box-open text-orange-500 text-xl"></i>
              </div>
            </div>
          </div>

          <!-- Prontos -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-green-600"><?= $prontos ?></div>
                <div class="text-sm text-neutral-500">Prontos</div>
              </div>
              <div class="p-3 bg-green-100 rounded-xl">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
              </div>
            </div>
          </div>

          <!-- Entregues -->
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-blue-600"><?= $entregues ?></div>
                <div class="text-sm text-neutral-500">Entregues</div>
              </div>
              <div class="p-3 bg-blue-100 rounded-xl">
                <i class="fas fa-truck text-blue-600 text-xl"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Lista de Pedidos -->
        <div class="dashboard-card bg-white rounded-2xl p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-neutral-800">Todos os Pedidos</h3>
            <div class="text-sm text-neutral-500"><?= $total_pedidos ?> pedidos realizados</div>
          </div>
          
          <div class="space-y-4">
            <?php if (empty($pedidos)): ?>
              <div class="text-center py-8">
                <i class="fas fa-shopping-cart text-4xl text-neutral-300 mb-4"></i>
                <p class="text-neutral-500">Nenhum pedido encontrado</p>
              </div>
            <?php else: ?>
              <?php foreach ($pedidos as $pedido): ?>
                <?php
                // Determina classe CSS baseada no status
                $status_class = '';
                $status_badge = '';
                $status_text = '';
                
                switch ($pedido['idpedidostatus']) {
                    case 1:
                        $status_class = 'status-preparing';
                        $status_badge = 'badge-warning';
                        $status_text = 'Preparando';
                        break;
                    case 2:
                        $status_class = 'status-ready';
                        $status_badge = 'badge-success';
                        $status_text = 'Pronto';
                        break;
                    case 3:
                        $status_class = 'status-delivered';
                        $status_badge = 'badge-info';
                        $status_text = 'Entregue';
                        break;
                    default:
                        $status_class = 'status-preparing';
                        $status_badge = 'badge-warning';
                        $status_text = 'Preparando';
                }
                
                // Formata data
                $data_formatada = date('d/m/Y', strtotime($pedido['data']));
                ?>
                
                <div class="order-row <?= $status_class ?> bg-white border rounded-lg p-4">
                  <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                      <div class="avatar">
                        <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                          <span class="text-primary-600 font-semibold">
                            <?= substr($pedido['nome_cliente'] ?? 'CL', 0, 2) ?>
                          </span>
                        </div>
                      </div>
                      <div>
                        <div class="font-semibold text-neutral-800">
                          <?= htmlspecialchars($pedido['nome_cliente'] ?? 'Cliente') ?>
                        </div>
                        <div class="text-sm text-neutral-500">Pedido #SLV-<?= str_pad($pedido['idpedido'], 3, '0', STR_PAD_LEFT) ?></div>
                      </div>
                    </div>
                    <div class="text-right">
                      <div class="badge <?= $status_badge ?> badge-lg"><?= $status_text ?></div>
                      <div class="text-xs text-neutral-500 mt-1"><?= $data_formatada ?></div>
                    </div>
                  </div>
                  
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                      <div class="text-sm text-neutral-500">Produto</div>
                      <div class="font-semibold"><?= htmlspecialchars($pedido['nome_produto'] ?? 'Produto') ?></div>
                    </div>
                    <div>
                      <div class="text-sm text-neutral-500">Quantidade</div>
                      <div class="font-semibold">1 unidade</div>
                    </div>
                    <div>
                      <div class="text-sm text-neutral-500">Valor</div>
                      <div class="font-semibold">R$ <?= number_format($pedido['total'], 2, ',', '.') ?></div>
                    </div>
                  </div>
                  
                  <div class="flex justify-end space-x-2">
                    <?php if ($pedido['idpedidostatus'] == 1): ?>
                      <button class="btn btn-primary btn-sm rounded-full" onclick="atualizarStatus(<?= $pedido['idpedido'] ?>, 2)">
                        <i class="fas fa-check mr-2"></i>
                        Marcar como Pronto
                      </button>
                    <?php elseif ($pedido['idpedidostatus'] == 2): ?>
                      <button class="btn btn-primary btn-sm rounded-full" onclick="atualizarStatus(<?= $pedido['idpedido'] ?>, 3)">
                        <i class="fas fa-truck mr-2"></i>
                        Marcar como Entregue
                      </button>
                    <?php else: ?>
                      <button class="btn btn-success btn-sm rounded-full" disabled>
                        <i class="fas fa-check-circle mr-2"></i>
                        Entregue
                      </button>
                    <?php endif; ?>
                    
                    <button class="btn btn-ghost btn-sm rounded-full" onclick="verDetalhes(<?= $pedido['idpedido'] ?>)">
                      <i class="fas fa-eye mr-2"></i>
                      Ver Detalhes
                    </button>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

          <!-- Paginação -->
          <div class="flex justify-between items-center mt-6">
            <div class="text-sm text-neutral-500">
              Mostrando <?= min(1, $total_pedidos) ?>-<?= min(10, $total_pedidos) ?> de <?= $total_pedidos ?> pedidos
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

  <script>
    // Função para atualizar status do pedido
   // Função para atualizar status do pedido - CORRIGIDA
function atualizarStatus(pedidoId, novoStatus) {
    if (confirm(`Deseja atualizar o status do pedido #SLV-${pedidoId.toString().padStart(3, '0')}?`)) {
        // Cria formulário para enviar via POST
        const formData = new FormData();
        formData.append('idpedido', pedidoId);
        formData.append('idpedidostatus', novoStatus);

        // Envia requisição POST
        fetch('atualizar_status.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status atualizado com sucesso!');
                location.reload(); // Recarrega a página para mostrar mudanças
            } else {
                alert('Erro ao atualizar status: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erro ao atualizar status');
        });
    }
}
    // Função para ver detalhes do pedido
    function verDetalhes(pedidoId) {
      // Redireciona para página de detalhes ou abre modal
      window.location.href = `detalhes_pedido.php?id=${pedidoId}`;
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
          
          // Navega para o link
          window.location.href = this.getAttribute('href');
        });
      });
    });
  </script>

</body>

</html>