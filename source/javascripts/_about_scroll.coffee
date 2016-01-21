window.onload = ->
  controller = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: 0.4}})
  #h = $("#section1").height()
  #console.log(h)
  new ScrollMagic.Scene({triggerElement: "#section1", duration: $("#section1").height()})
    .setClassToggle("#submenu1", "active")
    .addTo(controller)
    #.addIndicators()
  new ScrollMagic.Scene({triggerElement: "#section2", duration: $("#section2").height()})
    .setClassToggle("#submenu2", "active")
    .addTo(controller)
    #.addIndicators()
  new ScrollMagic.Scene({triggerElement: "#section3", duration: $("#section3").height()})
    .setClassToggle("#submenu3", "active")
    .addTo(controller)
    #.addIndicators()
  new ScrollMagic.Scene({triggerElement: "#section4", duration: $("#section4").height()})
    .setClassToggle("#submenu4", "active")
    .addTo(controller)
    #.addIndicators()
  new ScrollMagic.Scene({triggerElement: "#section5", duration: $("#section5").height()})
    .setClassToggle("#submenu5", "active")
    .addTo(controller)
    #.addIndicators()