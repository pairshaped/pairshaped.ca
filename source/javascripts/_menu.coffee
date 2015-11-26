window.toggleMobileMenu = ->
  menu = document.getElementById('mobile-menu')
  menu.className = if menu.className == 'mobile-menu' then 'mobile-menu--open' else 'mobile-menu'
