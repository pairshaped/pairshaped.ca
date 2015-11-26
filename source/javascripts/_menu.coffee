window.toggleMobileMenu = ->
  menu = document.getElementById('mobile-menu')
  menu.style.display = if menu.style.display == 'block' then 'none' else 'block'
