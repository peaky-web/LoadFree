document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.show-pass').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = document.getElementById(btn.dataset.target);
      if (!input) return;
      input.type = input.type === 'password' ? 'text' : 'password';
      btn.textContent = input.type === 'password' ? 'Show' : 'Hide';
    });
  });

  const menu = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.navbar nav');
  if (menu && nav) menu.addEventListener('click', () => nav.classList.toggle('open'));

  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({behavior:'smooth'});
        if (nav) nav.classList.remove('open');
      }
    });
  });
});
