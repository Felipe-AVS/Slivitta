<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Avaliação Médica - SlimVitta</title>

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

    .questionnaire-card {
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e8e6e1;
      transition: all 0.3s ease;
    }

    .section-complete {
      border-left: 4px solid #10b981;
      background-color: #f0fdf4;
    }

    .section-incomplete {
      border-left: 4px solid #d4a960;
    }

    .custom-input {
      background-color: #e8e6e1;
      border: 1px solid #d1cec7;
    }

    .custom-input:focus {
      background-color: #ffffff;
      border-color: #d4a960;
    }

    @media (max-width: 768px) {
      .mobile-padding {
        padding: 1rem;
      }
      
      .mobile-text {
        font-size: 0.875rem;
      }
    }
  </style>
</head>

<body class="leading-relaxed">
  <!-- Header -->
  <header class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-neutral-200">
    <div class="max-w-2xl mx-auto px-4 py-3 flex items-center justify-between">
      <!-- Logo -->
      <a href="./index.html" class="text-xl font-bold text-primary-600 tracking-tight">SlimVitta</a>
      
      <div class="text-sm text-neutral-500 mobile-text">
        Avaliação Médica
      </div>
    </div>
  </header>

  <!-- Conteúdo Principal -->
  <main class="max-w-2xl mx-auto mobile-padding py-6">
    
    <!-- Cabeçalho do Questionário -->
    <div class="text-center mb-6">
      <h1 class="text-2xl font-bold text-primary-700 mb-3">Questionário de Saúde</h1>
      <p class="text-neutral-600 mobile-text">
        Suas respostas nos ajudarão a entender melhor seu perfil de saúde
      </p>
    </div>

    <!-- Questionário com Colapsáveis -->
    <div class="space-y-4" id="questionario">

      <!-- Seção 1: Dados Pessoais -->
      <div class="collapse collapse-arrow questionnaire-card section-incomplete" id="section-1">
        <input type="checkbox" checked />
        <div class="collapse-title flex items-center space-x-3 text-xl font-medium">
          <div class="flex-shrink-0">
            <i class="fas fa-user text-primary-600"></i>
          </div>
          <div class="flex-1 text-left">
            <span>Dados Pessoais</span>
            <div class="text-sm font-normal text-neutral-500 mt-1">
              Informações básicas
            </div>
          </div>
        </div>
        <div class="collapse-content">
          <div class="space-y-4 pt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="form-control">
                <label class="label">
                  <span class="label-text font-medium">Data de Nascimento</span>
                </label>
                <input type="date" class="input custom-input input-sm">
              </div>
              
              <div class="form-control">
                <label class="label">
                  <span class="label-text font-medium">Gênero</span>
                </label>
                <select class="select custom-input select-sm">
                  <option disabled selected>Selecione</option>
                  <option>Feminino</option>
                  <option>Masculino</option>
                  <option>Prefiro não informar</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="form-control">
                <label class="label">
                  <span class="label-text font-medium">Peso Atual (kg)</span>
                </label>
                <input type="number" class="input custom-input input-sm" placeholder="Ex: 75.5" step="0.1">
              </div>
              
              <div class="form-control">
                <label class="label">
                  <span class="label-text font-medium">Altura (cm)</span>
                </label>
                <input type="number" class="input custom-input input-sm" placeholder="Ex: 170">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Seção 2: Histórico de Saúde -->
      <div class="collapse collapse-arrow questionnaire-card section-incomplete" id="section-2">
        <input type="checkbox" />
        <div class="collapse-title flex items-center space-x-3 text-xl font-medium">
          <div class="flex-shrink-0">
            <i class="fas fa-heartbeat text-primary-600"></i>
          </div>
          <div class="flex-1 text-left">
            <span>Histórico de Saúde</span>
            <div class="text-sm font-normal text-neutral-500 mt-1">
              Condições médicas existentes
            </div>
          </div>
        </div>
        <div class="collapse-content">
          <div class="space-y-6 pt-4">
            <!-- Diabetes -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Você tem diagnóstico de diabetes?</span>
              </label>
              <div class="space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="diabetes" class="radio radio-primary radio-sm" value="sim">
                  <span class="text-sm">Sim, diabetes tipo 1</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="diabetes" class="radio radio-primary radio-sm" value="tipo2">
                  <span class="text-sm">Sim, diabetes tipo 2</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="diabetes" class="radio radio-primary radio-sm" value="nao">
                  <span class="text-sm">Não</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="diabetes" class="radio radio-primary radio-sm" value="pre">
                  <span class="text-sm">Pré-diabetes</span>
                </label>
              </div>
            </div>

            <!-- Pressão Arterial -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Você tem pressão alta (hipertensão)?</span>
              </label>
              <div class="space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="hipertensao" class="radio radio-primary radio-sm" value="sim">
                  <span class="text-sm">Sim</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="hipertensao" class="radio radio-primary radio-sm" value="nao">
                  <span class="text-sm">Não</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="hipertensao" class="radio radio-primary radio-sm" value="nao-sei">
                  <span class="text-sm">Não sei</span>
                </label>
              </div>
            </div>

            <!-- Colesterol -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Você tem colesterol alto?</span>
              </label>
              <div class="space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="colesterol" class="radio radio-primary radio-sm" value="sim">
                  <span class="text-sm">Sim</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="colesterol" class="radio radio-primary radio-sm" value="nao">
                  <span class="text-sm">Não</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="colesterol" class="radio radio-primary radio-sm" value="nao-sei">
                  <span class="text-sm">Não sei</span>
                </label>
              </div>
            </div>

            <!-- Problemas Cardíacos -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Você tem ou já teve problemas cardíacos?</span>
              </label>
              <div class="space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="cardiaco" class="radio radio-primary radio-sm" value="sim">
                  <span class="text-sm">Sim</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="cardiaco" class="radio radio-primary radio-sm" value="nao">
                  <span class="text-sm">Não</span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Seção 3: Hábitos e Estilo de Vida -->
      <div class="collapse collapse-arrow questionnaire-card section-incomplete" id="section-3">
        <input type="checkbox" />
        <div class="collapse-title flex items-center space-x-3 text-xl font-medium">
          <div class="flex-shrink-0">
            <i class="fas fa-running text-primary-600"></i>
          </div>
          <div class="flex-1 text-left">
            <span>Hábitos e Estilo de Vida</span>
            <div class="text-sm font-normal text-neutral-500 mt-1">
              Seu dia a dia e rotina
            </div>
          </div>
        </div>
        <div class="collapse-content">
          <div class="space-y-6 pt-4">
            <!-- Atividade Física -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Com que frequência você pratica atividade física?</span>
              </label>
              <div class="space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="atividade" class="radio radio-primary radio-sm" value="diariamente">
                  <span class="text-sm">Diariamente</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="atividade" class="radio radio-primary radio-sm" value="3-4x">
                  <span class="text-sm">3-4 vezes por semana</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="atividade" class="radio radio-primary radio-sm" value="1-2x">
                  <span class="text-sm">1-2 vezes por semana</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="atividade" class="radio radio-primary radio-sm" value="raramente">
                  <span class="text-sm">Raramente</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="atividade" class="radio radio-primary radio-sm" value="nunca">
                  <span class="text-sm">Nunca</span>
                </label>
              </div>
            </div>

            <!-- Alimentação -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Como você descreveria sua alimentação?</span>
              </label>
              <div class="space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="alimentacao" class="radio radio-primary radio-sm" value="saudavel">
                  <span class="text-sm">Muito saudável</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="alimentacao" class="radio radio-primary radio-sm" value="razoavel">
                  <span class="text-sm">Razoavelmente saudável</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="alimentacao" class="radio radio-primary radio-sm" value="pouco-saudavel">
                  <span class="text-sm">Pouco saudável</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="alimentacao" class="radio radio-primary radio-sm" value="nada-saudavel">
                  <span class="text-sm">Nada saudável</span>
                </label>
              </div>
            </div>

            <!-- Sono -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Quantas horas você dorme por noite?</span>
              </label>
              <div class="space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="sono" class="radio radio-primary radio-sm" value="menos-5">
                  <span class="text-sm">Menos de 5 horas</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="sono" class="radio radio-primary radio-sm" value="5-6">
                  <span class="text-sm">5-6 horas</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="sono" class="radio radio-primary radio-sm" value="7-8">
                  <span class="text-sm">7-8 horas</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="sono" class="radio radio-primary radio-sm" value="mais-8">
                  <span class="text-sm">Mais de 8 horas</span>
                </label>
              </div>
            </div>

            <!-- Tabagismo -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Você fuma?</span>
              </label>
              <div class="space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="fuma" class="radio radio-primary radio-sm" value="sim">
                  <span class="text-sm">Sim, regularmente</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="fuma" class="radio radio-primary radio-sm" value="socialmente">
                  <span class="text-sm">Socialmente</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="fuma" class="radio radio-primary radio-sm" value="parei">
                  <span class="text-sm">Parei de fumar</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="fuma" class="radio radio-primary radio-sm" value="nunca">
                  <span class="text-sm">Nunca fumei</span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Seção 4: Medicamentos e Alergias -->
      <div class="collapse collapse-arrow questionnaire-card section-incomplete" id="section-4">
        <input type="checkbox" />
        <div class="collapse-title flex items-center space-x-3 text-xl font-medium">
          <div class="flex-shrink-0">
            <i class="fas fa-pills text-primary-600"></i>
          </div>
          <div class="flex-1 text-left">
            <span>Medicamentos e Alergias</span>
            <div class="text-sm font-normal text-neutral-500 mt-1">
              Uso atual de medicamentos
            </div>
          </div>
        </div>
        <div class="collapse-content">
          <div class="space-y-6 pt-4">
            <!-- Medicamentos Atuais -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Quais medicamentos você usa atualmente?</span>
              </label>
              <div class="space-y-3">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" value="pressao">
                  <span class="text-sm">Medicamentos para pressão</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" value="diabetes">
                  <span class="text-sm">Medicamentos para diabetes</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" value="colesterol">
                  <span class="text-sm">Medicamentos para colesterol</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" value="ansiedade">
                  <span class="text-sm">Ansiolíticos/antidepressivos</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" value="outros">
                  <span class="text-sm">Outros medicamentos</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" value="nenhum">
                  <span class="text-sm">Não uso medicamentos</span>
                </label>
              </div>
            </div>

            <!-- Alergias -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Você tem alguma alergia a medicamentos?</span>
              </label>
              <textarea class="textarea custom-input textarea-sm h-16" placeholder="Descreva suas alergias, se houver..."></textarea>
            </div>

            <!-- Cirurgias -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Já fez alguma cirurgia? Se sim, qual?</span>
              </label>
              <textarea class="textarea custom-input textarea-sm h-16" placeholder="Descreva cirurgias anteriores..."></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- Seção 5: Objetivos e Expectativas -->
      <div class="collapse collapse-arrow questionnaire-card section-incomplete" id="section-5">
        <input type="checkbox" />
        <div class="collapse-title flex items-center space-x-3 text-xl font-medium">
          <div class="flex-shrink-0">
            <i class="fas fa-bullseye text-primary-600"></i>
          </div>
          <div class="flex-1 text-left">
            <span>Objetivos e Expectativas</span>
            <div class="text-sm font-normal text-neutral-500 mt-1">
              O que você espera do tratamento
            </div>
          </div>
        </div>
        <div class="collapse-content">
          <div class="space-y-6 pt-4">
            <!-- Objetivo Principal -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Qual seu principal objetivo com o tratamento?</span>
              </label>
              <div class="space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="objetivo" class="radio radio-primary radio-sm" value="emagrecer">
                  <span class="text-sm">Emagrecer</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="objetivo" class="radio radio-primary radio-sm" value="controle-glicemico">
                  <span class="text-sm">Controle glicêmico (açúcar no sangue)</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="objetivo" class="radio radio-primary radio-sm" value="saude-geral">
                  <span class="text-sm">Melhorar saúde geral</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-neutral-50 rounded">
                  <input type="radio" name="objetivo" class="radio radio-primary radio-sm" value="autoestima">
                  <span class="text-sm">Melhorar autoestima</span>
                </label>
              </div>
            </div>

            <!-- Peso Desejado -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Qual peso você gostaria de alcançar? (kg)</span>
              </label>
              <input type="number" class="input custom-input input-sm" placeholder="Ex: 65.0" step="0.1">
            </div>

            <!-- Tratamentos Anteriores -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Já tentou outros tratamentos para emagrecer?</span>
              </label>
              <textarea class="textarea custom-input textarea-sm h-16" placeholder="Descreva tratamentos anteriores e resultados..."></textarea>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Botão de Envio -->
    <div class="mt-8 text-center">
      <button type="button" class="btn btn-primary rounded-full px-8">
        <i class="fas fa-paper-plane mr-2"></i>
        Enviar Questionário
      </button>
    </div>

  </main>

</body>

</html>