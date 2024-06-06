document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
  
    // Adicione aqui a lógica de validação e autenticação do usuário
    if (username && password) {
      alert('Login bem-sucedido!');
    } else {
      alert('Por favor, preencha todos os campos.');
    }
  });