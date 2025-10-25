<?php
session_start();
include_once("./componentes/usuario.php");
include_once("./conexao.php");

$user = new Usuario();
$user->conn = $conn;
$user->idusuario = $_SESSION['idusuario'];
$user->SelectUsuario();

// ======== Cálculos de Progresso de Perda de Peso ======== //
$peso_atual = (float)$user->peso;
$peso_inicial = (float)($_SESSION['pesoinicial'] ?? ($peso_atual + abs($_SESSION['difpeso'] ?? 0)));
$peso_perdido = max(0, $peso_inicial - $peso_atual);

$texto_progresso = "Peso Perdido";
$peso_variacao = number_format($peso_perdido, 1, ',', '.');
$progresso_percentual = round(($peso_perdido / max($peso_inicial, 1)) * 100, 1);

$pesos = [$peso_inicial, ($peso_inicial + $peso_atual) / 2, $peso_atual];
$datas = ["Início", "Meio", "Atual"];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meu Progresso - SlimVitta</title>

  <!-- DaisyUI + Tailwind -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
  <div class="flex min-h-screen bg-neutral-50">
    <!-- Sidebar -->
    <div class="sidebar w-64 flex-shrink-0 bg-white border-r border-neutral-200">
      <div class="p-6">
        <div class="flex items-center space-x-3 mb-8">
          <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-lg">S</span>
          </div>
          <div>
            <h1 class="text-xl font-bold text-primary-600">SlimVitta</h1>
            <p class="text-xs text-neutral-500">Minha Conta</p>
          </div>
        </div>

        <nav class="space-y-2">
          <a href="./dashboard.paciente.php" class="sidebar-menu-item  flex items-center space-x-3 p-3">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span>Visão Geral</span>
          </a>

          <a href="./avaliacoes.paciente.php" class="sidebar-menu-item  flex items-center space-x-3 p-3">
            <i class="fas fa-clipboard-list w-5 text-center"></i>
            <span>Minhas Avaliações</span>
          </a>

          <a href="pedido.paciente.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-shopping-cart w-5 text-center"></i>
            <span>Meus Pedidos</span>
          </a>

          <a href="./dados.paciente.php" class="sidebar-menu-item flex items-center space-x-3 p-3">
            <i class="fas fa-user w-5 text-center"></i>
            <span>Meus Dados</span>
          </a>

          <a href="progresso.paciente.php" class="sidebar-menu-item active flex items-center space-x-3 p-3">
            <i class="fas fa-chart-line w-5 text-center"></i>
            <span>Meu Progresso</span>
          </a>
        </nav>
        <div class="my-6 border-t border-neutral-200"></div>

        <nav class="space-y-2">
          <a href="./middle/logout.php" class="sidebar-menu-item flex items-center space-x-3 p-3 text-red-600">
            <i class="fas fa-sign-out-alt w-5 text-center"></i><span>Sair</span>
          </a>
        </nav>
      </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="flex-1 flex flex-col">
      <header class="bg-white border-b border-neutral-200">
        <div class="flex items-center justify-between p-6">
          <div class="flex items-center space-x-4">
            <h2 class="text-2xl font-bold text-neutral-800">Meu Progresso</h2>
            <div class="text-sm text-neutral-500">Olá, <?= $_SESSION['nome']; ?>!</div>
          </div>
        </div>
      </header>

      <!-- Conteúdo -->
      <main class="flex-1 overflow-y-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <!-- Peso Atual -->
          <div class="dashboard-card bg-white p-6 rounded-2xl text-center">
            <i class="fas fa-weight text-primary-600 text-2xl mb-2"></i>
            <h3 class="font-semibold text-neutral-700">Peso Atual</h3>
            <p class="text-3xl font-bold text-neutral-800"><?= number_format($peso_atual, 1, ',', '.'); ?> kg</p>
          </div>

          <!-- Peso Perdido -->
          <div class="dashboard-card bg-white p-6 rounded-2xl text-center">
            <i class="fas fa-fire text-primary-600 text-2xl mb-2"></i>
            <h3 class="font-semibold text-neutral-700"><?= $texto_progresso; ?></h3>
            <p class="text-3xl font-bold text-green-600">
              -<?= $peso_variacao; ?> kg
            </p>
          </div>

          <!-- Progresso -->
          <div class="dashboard-card bg-white p-6 rounded-2xl text-center">
            <i class="fas fa-chart-line text-primary-600 text-2xl mb-2"></i>
            <h3 class="font-semibold text-neutral-700">Progresso Total</h3>
            <p class="text-3xl font-bold text-neutral-800"><?= $progresso_percentual; ?>%</p>
          </div>
        </div>

        <!-- Gráfico -->
        <div class="dashboard-card bg-white mt-4 p-8 rounded-2xl w-full max-w-5xl mx-auto">
          <h3 class="text-xl font-semibold text-neutral-800 mb-4">Evolução do Peso</h3>
          <canvas id="graficoProgresso"></canvas>
        </div>
      </main>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('graficoProgresso').getContext('2d');
    const chartColor = '#16a34a';

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?= json_encode($datas); ?>,
        datasets: [{
          label: 'Evolução do Peso (kg)',
          data: <?= json_encode($pesos); ?>,
          borderColor: chartColor,
          backgroundColor: chartColor + '33',
          fill: true,
          tension: 0.3,
          pointRadius: 5,
          pointBackgroundColor: chartColor,
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            reverse: true, // mostra visualmente a perda como descida
            title: {
              display: true,
              text: 'Peso (kg)'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Período'
            }
          }
        }
      }
    });
  </script>
</body>

</html>