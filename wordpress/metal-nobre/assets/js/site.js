(function () {
  var reduz = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // imagens que não carregam mostram o desenho em traço dourado no lugar
  document.querySelectorAll('.foto img, .historia-foto img, .hero-foto img').forEach(function (img) {
    var marcar = function () { img.parentElement.classList.add('sem-img'); };
    if (img.complete && img.naturalWidth === 0) marcar();
    img.addEventListener('error', marcar);
  });

  // título letra por letra, com atrasos e inclinações levemente irregulares
  if (!reduz) {
    var base = 0.15;
    document.querySelectorAll('[data-letras]').forEach(function (linha) {
      var txt = linha.textContent; linha.textContent = '';
      linha.setAttribute('aria-hidden', 'true');
      for (var i = 0; i < txt.length; i++) {
        var s = document.createElement('span');
        s.className = 'letra';
        s.textContent = txt[i];
        base += 0.035 + Math.random() * 0.04;
        s.style.animationDelay = base.toFixed(3) + 's';
        s.style.setProperty('--r', ((Math.random() - 0.5) * 8).toFixed(1) + 'deg');
        linha.appendChild(s);
      }
      base += 0.12;
    });
  }

  // cabeçalho fica sólido ao rolar
  var topo = document.getElementById('topo');
  var aoRolar = function () { topo.classList.toggle('rolou', window.scrollY > 40); };
  window.addEventListener('scroll', aoRolar, { passive: true }); aoRolar();

  // menu no celular
  var botaoMenu = document.getElementById('abrirMenu'), menu = document.getElementById('menu');
  botaoMenu.addEventListener('click', function () {
    var aberto = menu.classList.toggle('aberto');
    botaoMenu.setAttribute('aria-expanded', aberto);
  });
  menu.addEventListener('click', function (e) {
    if (e.target.tagName === 'A') { menu.classList.remove('aberto'); botaoMenu.setAttribute('aria-expanded', 'false'); }
  });

  // link ativo conforme a seção
  var links = Array.prototype.slice.call(document.querySelectorAll('.menu a'));
  // só vale para links que apontam para uma seção desta mesma página
  var secoes = links.map(function (a) {
    if (!a.hash || a.pathname !== location.pathname) return null;
    try { return document.querySelector(a.hash); } catch (e) { return null; }
  });
  var temSecoes = secoes.some(Boolean);

  // revelar ao rolar: só esconde o que começa fora da tela, então a página parada já está completa
  var alturaTela = window.innerHeight;
  var revelaveis = document.querySelectorAll('.revelar, .revelar-img');
  var assinatura = document.getElementById('assinatura');
  var contadores = document.querySelectorAll('[data-conta]');

  if ('IntersectionObserver' in window && !reduz) {
    var io = new IntersectionObserver(function (entradas) {
      entradas.forEach(function (en) {
        if (!en.isIntersecting) return;
        var el = en.target;
        // irmãos aparecem em sequência, mas com ritmo levemente desigual
        var irmaos = Array.prototype.indexOf.call(el.parentElement.children, el);
        el.style.transitionDelay = (irmaos * 0.09 + Math.random() * 0.05).toFixed(2) + 's';
        el.classList.remove('escondido');
        io.unobserve(el);
      });
    }, { rootMargin: '0px 0px -8% 0px' });
    revelaveis.forEach(function (el) {
      if (el.getBoundingClientRect().top > alturaTela) { el.classList.add('escondido'); io.observe(el); }
    });

    var ioExtra = new IntersectionObserver(function (entradas) {
      entradas.forEach(function (en) {
        if (!en.isIntersecting) return;
        var el = en.target;
        if (el === assinatura) { el.classList.add('escrever'); }
        else contar(el);
        ioExtra.unobserve(el);
      });
    }, { threshold: 0.6 });
    if (assinatura && assinatura.getBoundingClientRect().top > alturaTela) ioExtra.observe(assinatura);
    contadores.forEach(function (el) {
      if (el.getBoundingClientRect().top > alturaTela) { el.textContent = '0' + el.dataset.suf; ioExtra.observe(el); }
    });
  }

  function contar(el) {
    var alvo = +el.dataset.conta, suf = el.dataset.suf, ini = null, dur = 1600 + Math.random() * 500;
    function passo(t) {
      if (!ini) ini = t;
      var p = Math.min((t - ini) / dur, 1);
      var e = 1 - Math.pow(1 - p, 4);
      el.textContent = Math.round(alvo * e).toLocaleString('pt-BR') + suf;
      if (p < 1) requestAnimationFrame(passo);
    }
    requestAnimationFrame(passo);
  }

  // cartões: inclinação leve e luz seguindo o mouse
  var ponteiroFino = window.matchMedia('(pointer: fine)').matches;
  if (ponteiroFino && !reduz) {
    document.querySelectorAll('.peca').forEach(function (card) {
      var foto = card.querySelector('.foto');
      card.addEventListener('mousemove', function (e) {
        var r = card.getBoundingClientRect();
        var x = (e.clientX - r.left) / r.width, y = (e.clientY - r.top) / r.height;
        card.style.transform = 'perspective(900px) rotateY(' + ((x - 0.5) * 5).toFixed(2) + 'deg) rotateX(' + ((0.5 - y) * 5).toFixed(2) + 'deg)';
        var fr = foto.getBoundingClientRect();
        foto.style.setProperty('--mx', (e.clientX - fr.left) + 'px');
        foto.style.setProperty('--my', (e.clientY - fr.top) + 'px');
      });
      card.addEventListener('mouseleave', function () { card.style.transform = ''; });
    });

    // botões "magnéticos": seguem o cursor só um pouco
    document.querySelectorAll('.ima').forEach(function (b) {
      b.addEventListener('mousemove', function (e) {
        var r = b.getBoundingClientRect();
        b.style.transform = 'translate(' + ((e.clientX - r.left - r.width / 2) * 0.18).toFixed(1) + 'px,' + ((e.clientY - r.top - r.height / 2) * 0.3).toFixed(1) + 'px)';
      });
      b.addEventListener('mouseleave', function () { b.style.transform = ''; });
    });

    // foto do hero acompanha o mouse em paralaxe sutil
    var heroImg = document.querySelector('.hero-foto'), hero = document.querySelector('.hero');
    if (hero && heroImg) hero.addEventListener('mousemove', function (e) {
      var x = e.clientX / window.innerWidth - 0.5, y = e.clientY / window.innerHeight - 0.5;
      heroImg.style.transform = 'translate(' + (x * -14).toFixed(1) + 'px,' + (y * -10).toFixed(1) + 'px)';
    });
  }

  // WhatsApp: troque pelo número da loja (DDI + DDD + número, só dígitos)
  var WHATSAPP = (window.metalNobre && window.metalNobre.whatsapp) || '556284307480';
  function linkZap(texto) { return 'https://wa.me/' + WHATSAPP + '?text=' + encodeURIComponent(texto); }
  document.querySelectorAll('[data-zap]').forEach(function (a) {
    a.href = linkZap('Olá, Metal Nobre! Vim pelo site e gostaria de atendimento.');
    a.target = '_blank'; a.rel = 'noopener';
  });

  var janela = document.getElementById('janela'), janelaFoto = document.getElementById('janelaFoto');
  var ultimoFoco = null;
  function abrirPeca(card) {
    var nome = card.dataset.nome, ref = card.dataset.ref;
    var img = card.querySelector('.foto img');
    var urlFoto = img ? new URL(img.getAttribute('src'), location.href).href : '';
    janelaFoto.innerHTML = '';
    if (img && !card.querySelector('.foto').classList.contains('sem-img')) {
      var copia = img.cloneNode(); copia.removeAttribute('loading'); janelaFoto.appendChild(copia);
    } else {
      var arteOrig = card.querySelector('.arte'); if (arteOrig) { var arte = arteOrig.cloneNode(true); arte.setAttribute('class', 'arte-copia'); janelaFoto.appendChild(arte); }
    }
    document.getElementById('janelaRef').textContent = ref;
    document.getElementById('janelaNome').textContent = nome;
    // o link da foto na mensagem faz o WhatsApp mostrar a imagem da peça na conversa
    document.getElementById('janelaZap').href = linkZap('Olá, Metal Nobre! Tenho interesse nesta peça: ' + nome + '.\n' + urlFoto);
    ultimoFoco = document.activeElement;
    janela.hidden = false;
    requestAnimationFrame(function () { janela.classList.add('on'); });
    document.getElementById('fechar').focus();
  }
  function fecharPeca() {
    janela.classList.remove('on');
    setTimeout(function () { janela.hidden = true; }, 350);
    if (ultimoFoco) ultimoFoco.focus();
  }
  document.querySelectorAll('.peca').forEach(function (card) {
    card.addEventListener('click', function () { abrirPeca(card); });
    card.addEventListener('keydown', function (e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); abrirPeca(card); } });
  });
  document.getElementById('fechar').addEventListener('click', fecharPeca);
  janela.addEventListener('click', function (e) { if (e.target === janela) fecharPeca(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !janela.hidden) fecharPeca(); });

  // newsletter
  document.getElementById('news').addEventListener('submit', function (e) {
    e.preventDefault();
    var campo = document.getElementById('email'), msg = document.getElementById('newsMsg');
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(campo.value)) { msg.textContent = 'Digite um e-mail completo, como nome@email.com.'; campo.focus(); return; }
    msg.textContent = 'Inscrição feita. A próxima carta chega no início do mês.';
    campo.value = '';
  });

  // destaca o link da seção visível
  window.addEventListener('scroll', function () {
    var y = window.scrollY + 160, atual = 0;
    if (!temSecoes) return;
    secoes.forEach(function (s, i) { if (s && s.offsetTop <= y) atual = i; });
    links.forEach(function (a, i) { a.classList.toggle('ativo', i === atual); });
  }, { passive: true });
})();
