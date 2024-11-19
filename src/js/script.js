document.addEventListener("DOMContentLoaded", function () {

  window.toggleMenu = function (menuId) {
    const menu = document.getElementById(menuId);
    const parentItem = menu.closest('.nav-item');

    if (menu.style.display === "block") {
      menu.style.display = "none";
      parentItem.classList.remove('active');
    } else {
      menu.style.display = "block";
      parentItem.classList.add('active');
    }
  };

  const currentPath = window.location.pathname;
  const links = document.querySelectorAll('.sub-menu a');

  links.forEach(link => {
    if (currentPath.includes(link.getAttribute('href'))) {
      const parentItem = link.closest('.nav-item');
      const subMenu = parentItem.querySelector('.sub-menu');

      if (subMenu) {
        subMenu.style.display = "block";
      }
      parentItem.classList.add('active');
      link.style.color = "white"; // Destaque o link atual
    }
  });
});

const precoVenda = document.getElementById('preco_venda');
const precoCusto = document.getElementById('preco_custo');
Inputmask('decimal', {
    groupSeparator: '.', 
    alias: 'numeric',
    digits: 2, 
    decimalSeparator: ',', 
    rightAlign: false 
}).mask(precoVenda);
Inputmask('decimal', {
    groupSeparator: '.',
    alias: 'numeric',
    digits: 2,
    decimalSeparator: ',',
    rightAlign: false
}).mask(precoCusto);

const telefone = document.getElementById('telefone');
Inputmask('(99) 99999-9999').mask(telefone);

const salario = document.getElementById('salario');
Inputmask('decimal', {
    groupSeparator: '.',
    alias: 'numeric',
    digits: 2,
    decimalSeparator: ',',
    rightAlign: false
}).mask(salario);