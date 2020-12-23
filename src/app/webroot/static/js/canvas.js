/* default dom id (particles-js) */
//particlesJS();

/* config dom id */
//particlesJS('dom-id');

/* config dom id (optional) + config particles params */
particlesJS('particles-js', {
  particles: {
    color: '#999',
    shape: 'circle', // "circle", "edge" or "triangle"
    opacity: 0.3,
    size: 8,
    size_random: true,
    nb: 80,    
    line_linked: {
      enable_auto: true,
      distance: 150,
      color: '#d3d3d3',
      opacity: 1,
      width: 1,
      condensed_mode: {
        enable: true,
        rotateX: 64000,
        rotateY: 64000
      }
    },
    anim: {
      enable: true,
      speed: 1,
    	size_min: 0.4,
    	sync: false
    }
  },
  interactivity: {
    enable: true,
    mouse: {
      distance: 500
    },
    detect_on: 'canvas', // "canvas" or "window"
    mode: 'grab',
    line_linked: {
      opacity: .5
    },
    events: {
      onclick: {
        enable: true,
        mode: 'remove', // "push" or "remove"
        nb: 4
      }
    }
  },
  /* Retina Display Support */
  retina_detect: true
});