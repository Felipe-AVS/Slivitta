<?php
session_start();
include_once("./conexao.php");
include_once("./componentes/avaliacao.php");

// Instancia classe Avaliacao
$avaliacao = new Avaliacao();
$avaliacao->conn = $conn;

// Contadores
$total = $avaliacao->SelectQuantidadeAvaliacao();
$pendentes = $avaliacao->SelectQuantidadePorStatus(0);
$aprovadas = $avaliacao->SelectQuantidadePorStatus(1);
$canceladas = $avaliacao->SelectQuantidadePorStatus(2);

// Listagens
$listaPendentes = $avaliacao->SelectAvaliacaoPorStatus(0);
$listaAprovadas = $avaliacao->SelectAvaliacaoPorStatus(1);
$listaRecusadas = $avaliacao->SelectAvaliacaoPorStatus(2);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Avaliações - Dashboard SlimVitta</title>

  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
  <div class="flex h-screen bg-neutral-50">

    <!-- Sidebar -->
    <div class="sidebar w-64 flex-shrink-0">
      <div class="p-6">
        <div class="flex items-center space-x-3 mb-8">
          <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-lg">S</span>
          </div>
          <div>
            <h1 class="text-xl font-bold text-primary-600">SlimVitta</h1>
            <p class="text-xs text-neutral-500">Dashboard</p>
          </div>
        </div>

        <nav class="space-y-2">
          <a href="./dashboard.php" class="sidebar-menu-item  flex items-center space-x-3 p-3">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Visão Geral</span>
          </a>
          
          <a href="./dashboard.avaliacoes.php" class="sidebar-menu-item active flex items-center space-x-3 p-3">
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
        <div class="my-6 border-t border-neutral-200">

        <!-- Menu Secundário -->
       <nav class="space-y-2">
          <a href="./middle/logout.php" class="sidebar-menu-item flex items-center space-x-3 p-3 text-red-600">
            <i class="fas fa-sign-out-alt w-5 text-center"></i>
            <span>Sair</span>
          </a>
        </nav>
      </div>
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
            <div class="text-sm text-neutral-500">Olá, <?= $_SESSION['nome'] ?? 'Usuário'; ?></div>
          </div>
        </div>
      </header>

      <!-- Conteúdo -->
      <main class="flex-1 overflow-y-auto p-6">

        <!-- Cards de Resumo -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-neutral-800"><?= $total ?></div>
                <div class="text-sm text-neutral-500">Total</div>
              </div>
              <div class="p-3 bg-primary-100 rounded-xl">
                <i class="fas fa-clipboard-list text-primary-600 text-xl"></i>
              </div>
            </div>
          </div>

          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-orange-500"><?= $pendentes ?></div>
                <div class="text-sm text-neutral-500">Pendentes</div>
              </div>
              <div class="p-3 bg-orange-100 rounded-xl">
                <i class="fas fa-clock text-orange-500 text-xl"></i>
              </div>
            </div>
          </div>

          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-green-600"><?= $aprovadas ?></div>
                <div class="text-sm text-neutral-500">Aprovadas</div>
              </div>
              <div class="p-3 bg-green-100 rounded-xl">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
              </div>
            </div>
          </div>

          <div class="dashboard-card bg-white rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-2xl font-bold text-red-500"><?= $canceladas ?></div>
                <div class="text-sm text-neutral-500">Canceladas</div>
              </div>
              <div class="p-3 bg-red-100 rounded-xl">
                <i class="fas fa-times-circle text-red-500 text-xl"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Avaliações Pendentes -->
        <div class="dashboard-card bg-white rounded-2xl p-6 mb-6" style="border: 1px solid #f59e0b;">
          <h3 class="text-lg font-semibold text-neutral-800 mb-6">Avaliações Pendentes</h3>

          <?php if (empty($listaPendentes)) { ?>
            <p class="text-neutral-500">Nenhuma avaliação pendente no momento.</p>
          <?php } else { ?>
            <div class="space-y-4">
              <?php foreach ($listaPendentes as $aval) { ?>
                <div class="evaluation-card status-pending bg-white border rounded-lg p-4">
                  <div class="flex items-center justify-between mb-3">
                    <div>
                      <div class="font-semibold text-neutral-800"><?= htmlspecialchars($aval['nomepaciente']); ?></div>
                      <div class="text-sm text-neutral-500">Data: <?= date('d/m/Y', strtotime($aval['dataavaliacao'])); ?></div>
                    </div>
                    <span class="badge badge-warning">Pendente</span>
                  </div>

                  <div class="flex justify-end space-x-2">
                    <button class="btn btn-primary btn-sm rounded-full btn-detalhes" data-id="<?= $aval['idavaliacao'] ?>">
                      <i class="fas fa-eye mr-2"></i> Ver Detalhes
                    </button>
                    <button class="btn btn-success btn-sm rounded-full btn-aprovar" data-id="<?= $aval['idavaliacao'] ?>">
                      <i class="fas fa-check mr-2"></i> Aprovar
                    </button>
                    <button class="btn btn-error btn-sm rounded-full btn-recusar" data-id="<?= $aval['idavaliacao'] ?>">
                      <i class="fas fa-times mr-2"></i> Recusar
                    </button>
                  </div>

                </div>
              <?php } ?>
            </div>
          <?php } ?>
        </div>

        <!-- Avaliações Aprovadas -->
        <div class="dashboard-card bg-white rounded-2xl p-6"  style="border: 1px solid green;">
          <h3 class="text-lg font-semibold text-neutral-800 mb-6">Avaliações Aprovadas</h3>
          <div class="overflow-x-auto">
            <table class="table  w-full">
              <thead>
                <tr>
                  <th style="text-align: center;" >Paciente</th>
                  <th style="text-align: center;">Data</th>
                  <th style="text-align: center;">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listaAprovadas as $aval) { ?>
                  <tr>
                    <td style="text-align: center;"><?= htmlspecialchars($aval['nomepaciente']); ?></td>
                    <td style="text-align: center;"><?= date('d/m/Y', strtotime($aval['dataavaliacao'])); ?></td>
                    <td style="text-align: center;"><span class="badge badge-success">Aprovada</span></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
                
                  <br>
         <div class="dashboard-card bg-white rounded-2xl p-6" style="border: 1px solid red;">
          <h3 class="text-lg font-semibold text-neutral-800 mb-6">Avaliações Recusadas</h3>
          <div class="overflow-x-auto">
            <table class="table  w-full">
              <thead>
                <tr>
                  <th style="text-align: center;">Paciente</th>
                  <th style="text-align: center;">Data</th>
                  <th style="text-align: center;">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listaRecusadas as $aval) { ?>
                  <tr>
                    <td style="text-align: center;"><?= htmlspecialchars($aval['nomepaciente']); ?></td>
                    <td style="text-align: center;"><?= date('d/m/Y', strtotime($aval['dataavaliacao'])); ?></td>
                    <td style="text-align: center;"><span class="badge badge-error">Recusada</span></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>
  <!-- Modal de Detalhes -->
  <dialog id="modal-detalhes" class="modal">
    <div class="modal-box max-w-2xl bg-primary-100">
      <h3 class="font-bold text-lg mb-4">Detalhes da Avaliação</h3>
      <div id="detalhes-conteudo" class="space-y-3">
        Carregando...
      </div>
      <div class="modal-action">
        <form method="dialog">
          <button class="btn-danger">Fechar</button>
        </form>
      </div>
    </div>
  </dialog>

 <!-- Modal de Confirmação -->
<dialog id="modal-confirmacao" class="modal">
  <div class="modal-box max-w-md bg-primary-50 border border-primary-300 rounded-xl">
    <h3 class="font-bold text-lg mb-4 text-primary-700" id="confirmacao-titulo">Confirmar ação</h3>
    <p id="confirmacao-texto" class="mb-6 text-neutral-800"></p>
    
    <form id="form-confirmacao" method="POST" action="avaliacao_acao.php">
      <input type="hidden" name="idavaliacao" id="confirmacao-id">
      <input type="hidden" name="acao" id="confirmacao-acao">
      <div class="flex justify-end gap-3">
        <button type="submit" class="btn btn-success rounded-full px-6">Confirmar</button>
        <button type="button" class="btn btn-error rounded-full px-6" onclick="document.getElementById('modal-confirmacao').close()">Cancelar</button>
      </div>
    </form>
  </div>
</dialog>

 <script>
document.addEventListener('DOMContentLoaded', () => {
  // Liga o evento aos botões de detalhes
  document.querySelectorAll('.btn-detalhes').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      verDetalhes(id);
    });
  });
});

// Função para abrir modal e buscar dados
async function verDetalhes(id) {
  const modal = document.getElementById('modal-detalhes'); // ID correto
  const conteudo = document.getElementById('detalhes-conteudo'); // ID correto

  conteudo.innerHTML = '<p>Carregando...</p>';
  modal.showModal();

  try {
    const resp = await fetch(`get_avaliacao.php?id=${id}`);
    const data = await resp.json();

    if (data.sucesso) {
      const a = data.avaliacao;

      // Função para formatar data para d/m/Y
function formatDateBR(dateStr) {
  if (!dateStr) return '-';
  const date = new Date(dateStr);
  if (isNaN(date)) return '-';
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
}

// Na sua função de mostrar detalhes, dentro do innerHTML:
conteudo.innerHTML = `
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-md font-sans text-neutral-800">
    <div class="space-y-2 p-4 bg-white rounded shadow-sm border border-gray-200">
      <p><strong class="text-primary-600">ID Avaliação:</strong> ${a.idavaliacao}</p>
      <p><strong class="text-primary-600">Paciente:</strong> ${a.nomepaciente ?? '-'}</p>
      <p><strong class="text-primary-600">Data:</strong> ${formatDateBR(a.dataavaliacao)}</p>
      <p><strong class="text-primary-600">Status:</strong> ${
        a.statusavaliacao == 0
          ? '<span class="text-orange-600 font-semibold">Pendente</span>'
          : a.statusavaliacao == 1
          ? '<span class="text-green-600 font-semibold">Aprovada</span>'
          : '<span class="text-red-600 font-semibold">Recusada</span>'
      }</p>
    </div>

    <div class="space-y-2 p-4 bg-white rounded shadow-sm border border-gray-200">
      <p><strong class="text-primary-600">Principal Objetivo:</strong> ${a.principalobjetivo ?? '-'}</p>
      <p><strong class="text-primary-600">Meta Peso:</strong> ${a.metapeso ?? '-'}</p>
      <p><strong class="text-primary-600">Outros Tratamentos:</strong> ${a.outrostratamentos ?? '-'}</p>
    </div>

    <div class="col-span-2 bg-white rounded shadow-sm border border-gray-200 p-4 mt-4">
      <h4 class="font-semibold text-primary-700 mb-3 border-b border-primary-300 pb-1">Histórico de Saúde</h4>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <p><strong>Diabetes:</strong> ${a.diabetes}</p>
        <p><strong>Pressão Alta:</strong> ${a.pressaoalta}</p>
        <p><strong>Colesterol:</strong> ${a.colesterol}</p>
        <p><strong>Problemas Cardíacos:</strong> ${a.problemascardiacos}</p>
      </div>
    </div>

    <div class="col-span-2 bg-white rounded shadow-sm border border-gray-200 p-4 mt-4">
      <h4 class="font-semibold text-primary-700 mb-3 border-b border-primary-300 pb-1">Hábitos e Estilo de Vida</h4>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <p><strong>Frequência Atividade Física:</strong> ${a.frequenciaatividadefisica}</p>
        <p><strong>Alimentação:</strong> ${a.alimentacao}</p>
        <p><strong>Horas de Sono:</strong> ${a.horassono}</p>
        <p><strong>Fuma:</strong> ${a.fuma}</p>
      </div>
    </div>

    <div class="col-span-2 bg-white rounded shadow-sm border border-gray-200 p-4 mt-4">
      <h4 class="font-semibold text-primary-700 mb-3 border-b border-primary-300 pb-1">Medicamentos e Condições</h4>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <p><strong>Medicamentos:</strong> ${a.medicamentos}</p>
        <p><strong>Alergias:</strong> ${a.alergias}</p>
        <p><strong>Cirurgias:</strong> ${a.cirurgias}</p>
      </div>
    </div>
  </div>
`;

    } else {
      conteudo.innerHTML = '<p class="text-red-500">Erro ao carregar detalhes.</p>';
    }
  } catch (e) {
    conteudo.innerHTML = '<p class="text-red-500">Erro de conexão com o servidor.</p>';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  // Botões Aprovar
  document.querySelectorAll('.btn-aprovar').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      abrirConfirmacao(id, 'aprovar');
    });
  });

  // Botões Recusar
  document.querySelectorAll('.btn-recusar').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      abrirConfirmacao(id, 'recusar');
    });
  });
});

// Função para abrir o modal de confirmação
function abrirConfirmacao(id, acao) {
  const modal = document.getElementById('modal-confirmacao');
  const titulo = document.getElementById('confirmacao-titulo');
  const texto = document.getElementById('confirmacao-texto');
  const inputId = document.getElementById('confirmacao-id');
  const inputAcao = document.getElementById('confirmacao-acao');

  // Define o texto do modal
  if(acao === 'aprovar'){
    titulo.textContent = 'Aprovar Avaliação';
    texto.textContent = 'Tem certeza que deseja aprovar esta avaliação?';
  } else {
    titulo.textContent = 'Recusar Avaliação';
    texto.textContent = 'Tem certeza que deseja recusar esta avaliação?';
  }

  // Preenche os inputs escondidos
  inputId.value = id;
  inputAcao.value = acao;

  // Mostra o modal
  modal.showModal();
}

</script>

</body>

</html>