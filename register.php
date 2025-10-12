<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro - SlimVitta</title>

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
    }

    .auth-card {
      box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
      border: 1px solid #e8e6e1;
    }

    .hero-section {
      background: linear-gradient(135deg, rgba(212, 169, 96, 0.9) 0%, rgba(178, 139, 79, 0.9) 100%),
                  url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80');
      background-size: cover;
      background-position: center;
    }

    .step-indicator {
      width: 32px;
      height: 32px;
      border: 2px solid #d4a960;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.875rem;
      font-weight: 600;
    }

    .step-active {
      background-color: #d4a960;
      color: white;
    }

    .step-complete {
      background-color: #10b981;
      border-color: #10b981;
      color: white;
    }
  </style>
</head>

<body class="leading-relaxed">
  
  <!-- Layout Principal -->
  <div class="min-h-screen flex">
    
    <!-- Lado Esquerdo - Hero Image/Info -->
    <div class="hidden lg:flex lg:flex-1 hero-section text-white">
      <div class="flex flex-col justify-between p-12">
        
        <!-- Logo -->
        <div>
          <div class="flex items-center space-x-3 mb-8">
            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
              <span class="text-primary-600 font-bold text-xl">S</span>
            </div>
            <div>
              <h1 class="text-2xl font-bold">SlimVitta</h1>
              <p class="text-primary-100 text-sm">Saúde e bem-estar</p>
            </div>
          </div>
        </div>

        <!-- Conteúdo Informativo -->
        <div class="max-w-md">
          <h2 class="text-3xl font-bold mb-6">Comece sua jornada de transformação</h2>
          
          <div class="space-y-4 mb-8">
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-user-md text-sm"></i>
              </div>
              <span>Avaliação médica especializada</span>
            </div>
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-capsules text-sm"></i>
              </div>
              <span>Tratamento personalizado com tirzepatida</span>
            </div>
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-mobile-alt text-sm"></i>
              </div>
              <span>Acompanhamento 100% online</span>
            </div>
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-truck text-sm"></i>
              </div>
              <span>Entrega gratuita em todo o Brasil</span>
            </div>
          </div>

          <!-- Estatísticas -->
          <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="text-center">
              <div class="text-2xl font-bold">1.5k+</div>
              <div class="text-primary-100 text-sm">Pacientes</div>
            </div>
            <div class="text-center">
              <div class="text-2xl font-bold">92%</div>
              <div class="text-primary-100 text-sm">Sucesso</div>
            </div>
            <div class="text-center">
              <div class="text-2xl font-bold">24/7</div>
              <div class="text-primary-100 text-sm">Suporte</div>
            </div>
          </div>

          <!-- Depoimento -->
          <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
            <div class="flex items-center space-x-3 mb-3">
              <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
              </div>
              <div>
                <div class="font-semibold">Carlos Santos</div>
                <div class="text-primary-100 text-sm">-18kg em 4 meses</div>
              </div>
            </div>
            <p class="italic">"Finalmente encontrei um tratamento que funciona! A equipe da SlimVitta me acompanhou em cada etapa com muito profissionalismo."</p>
          </div>
        </div>

        <!-- Rodapé -->
        <div class="text-primary-100 text-sm">
          <p>© 2024 SlimVitta. Todos os direitos reservados.</p>
        </div>

      </div>
    </div>

    <!-- Lado Direito - Formulário de Registro -->
    <div class="flex-1 flex items-center justify-center p-6">
      <div class="w-full max-w-md">
        
        <!-- Logo Mobile -->
        <div class="lg:hidden flex justify-center mb-8">
          <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-primary-500 rounded-lg flex items-center justify-center">
              <span class="text-white font-bold text-xl">S</span>
            </div>
            <div>
              <h1 class="text-2xl font-bold text-primary-600">SlimVitta</h1>
              <p class="text-neutral-500 text-sm">Saúde e bem-estar</p>
            </div>
          </div>
        </div>

        <!-- Card de Registro -->
        <div class="auth-card bg-white rounded-2xl p-8">
          
          <!-- Indicador de Passos -->
          <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-2">
              <div class="step-indicator step-active">1</div>
              <span class="text-sm font-medium text-primary-600">Conta</span>
            </div>
            <div class="flex-1 h-0.5 bg-neutral-200 mx-2"></div>
            <div class="flex items-center space-x-2">
              <div class="step-indicator">2</div>
              <span class="text-sm text-neutral-500">Perfil</span>
            </div>
            <div class="flex-1 h-0.5 bg-neutral-200 mx-2"></div>
            <div class="flex items-center space-x-2">
              <div class="step-indicator">3</div>
              <span class="text-sm text-neutral-500">Saúde</span>
            </div>
          </div>

          <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-neutral-800 mb-2">Crie sua conta</h2>
            <p class="text-neutral-600">Primeiro, vamos criar seu acesso</p>
          </div>

          <form class="space-y-6" action="./middle/usuario.php" method="post">
            <!-- Nome Completo -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Nome Completo</span>
              </label>
              <div class="relative">
                <input type="text" id="nome" name="nome" placeholder="Seu nome completo" class="input bg-neutral-200 input-bordered w-full pl-10" required>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-user text-neutral-400"></i>
                </div>
              </div>
            </div>

            <!-- Email -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">E-mail</span>
              </label>
              <div class="relative">
                <input type="email" id="email" name="email" placeholder="seu@email.com" class="input bg-neutral-200 input-bordered w-full pl-10" required>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-envelope text-neutral-400"></i>
                </div>
              </div>
            </div>

            <!-- Telefone -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Telefone</span>
              </label>
              <div class="relative">
                <input type="tel" id="celular" name="celular"  class="input bg-neutral-200 input-bordered w-full pl-10" required>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-phone text-neutral-400"></i>
                </div>
              </div>
            </div>

            <!-- Senha -->
            <div class="form-control">
              <label class="label">
                <span class="label-text font-medium">Senha</span>
              </label>
              <div class="relative">
                <input type="password" id="senha" name="senha" placeholder="Crie uma senha segura" class="input input-bordered w-full pl-10 pr-10" required>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-lock text-neutral-400"></i>
                </div>
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <i class="fas fa-eye text-neutral-400 hover:text-neutral-600"></i>
                </button>
              </div>
              <label class="label">
                <span class="label-text-alt text-neutral-500">Mínimo 8 caracteres</span>
              </label>
            </div>

            <!-- Botão de Registro -->
            <button type="submit" class="btn bg-primary-600  w-full bc-black rounded-full py-3 text-lg text-white">
              <i class="fas fa-user-plus mr-2"></i>
              Criar minha conta
            </button>

            <!-- Link para Login -->
            <div class="text-center pt-4">
              <p class="text-neutral-600">
                Já tem uma conta?
                <a href="login.html" class="text-primary-600 font-semibold hover:underline">Faça login aqui</a>
              </p>
            </div>
          </form>
        </div>

        <!-- Informações Mobile -->
        <div class="lg:hidden mt-8 text-center text-sm text-neutral-500">
          <p>© 2024 SlimVitta. Todos os direitos reservados.</p>
        </div>

      </div>
    </div>

  </div>

  <script>
    // Alternar visibilidade da senha
    document.addEventListener('DOMContentLoaded', function() {
      const toggleButtons = document.querySelectorAll('.fa-eye');
      
      toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
          const passwordInput = this.closest('.relative').querySelector('input[type="password"]');
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);
          this.classList.toggle('fa-eye');
          this.classList.toggle('fa-eye-slash');
        });
      });

      // Validação de senha
      const passwordInput = document.querySelector('input[placeholder="Crie uma senha segura"]');
      const confirmPasswordInput = document.querySelector('input[placeholder="Digite novamente sua senha"]');
      
      function validatePassword() {
        if (passwordInput.value !== confirmPasswordInput.value) {
          confirmPasswordInput.setCustomValidity('As senhas não coincidem');
        } else {
          confirmPasswordInput.setCustomValidity('');
        }
      }
      
      passwordInput.addEventListener('input', validatePassword);
      confirmPasswordInput.addEventListener('input', validatePassword);
    });
  </script>

</body>

</html>