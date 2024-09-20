// $(document).ready(function() {});

$(function() {

  // Mascaras de Formulário
  $('#telefone').mask('(00) 0000-0000');
  $('#cel').mask('(00) 00000-0000');
  $('#cpf').mask('000.000.000-00');

  $('#bolsa_aux').on('keyup', function() {
    $(this).maskMoney({
      thousands:'.', 
      decimal:',', 
      allowZero:true, 
      suffix: ''
    });
  });

  // 'OWL' Image Carousel 
  $(".owl-carousel").owlCarousel({
    loop: true, // Habilita a repetição dos itens no carrossel
    margin: 10,
    nav: true, // Habilita as setas de navegação
    rewind: true, // Se "loop" não for adequado, use "rewind" para permitir navegação no final/início
    navText: ["<span class='nav-arrow'>&#10094;</span>", "<span class='nav-arrow'>&#10095;</span>"],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 3
      }
    }
  });


  
  


})

  
