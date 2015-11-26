window.toggleMobileMenu = ->
  menu = document.getElementById('mobile-menu')
  console.log(menu.className)
  menu.className = if menu.className == 'mobile-menu' then 'mobile-menu--open' else 'mobile-menu'
