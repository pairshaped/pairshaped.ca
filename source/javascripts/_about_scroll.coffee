window.onload = ->
  #init controller
  controller = new ScrollMagic.Controller({globalSceneOptions: {duration: 100}})

  # build scenes
  new ScrollMagic.Scene({triggerElement: "#section1"})
    .setClassToggle("#submenu1", "active")
    .addIndicators()
    .addTo(controller)
  new ScrollMagic.Scene({triggerElement: "#section2"})
    .setClassToggle("#submenu2", "active")
    .addIndicators()
    .addTo(controller)
  new ScrollMagic.Scene({triggerElement: "#section3"})
    .setClassToggle("#submenu3", "active")
    .addIndicators()
    .addTo(controller)
  new ScrollMagic.Scene({triggerElement: "#section4"})
    .setClassToggle("#submenu4", "active")
    .addIndicators()
    .addTo(controller)
  new ScrollMagic.Scene({triggerElement: "#section5"})
    .setClassToggle("#submenu5", "active")
    .addIndicators()
    .addTo(controller)