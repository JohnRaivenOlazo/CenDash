import ScrollReveal from 'scrollreveal';

const sr = ScrollReveal();

// TOP
sr.reveal('.top',{
  delay: 100,
  duration: 1500,
  opacity: 0,
  distance: "20px",
  origin: "top",
  reset: true
});

sr.reveal('.top-2',{
  delay: 300,
  duration: 1500,
  opacity: 0,
  distance: "20px",
  origin: "top",
  reset: true
});

sr.reveal('.top-min-delay',{
  delay: 0,
  duration: 1500,
  distance: "20px",
  origin: "top",
  reset: false
});

sr.reveal('.left-min-delay', {
  delay: 0,
  duration: 1000,
  distance: "50px",
  origin: "left",
  reset: false
});

sr.reveal('.right-min-delay', {
  delay: 0,
  duration: 1000,
  distance: "20px",
  origin: "right",
  reset: false
});

sr.reveal('.bottom-min-delay', {
  delay: 0,
  duration: 1000,
  opacity: 0,
  distance: "50px",
  origin: "bottom",
  reset: false
});

// BOT
sr.reveal('.bottom',{
  delay: 600,
  duration: 1500,
  opacity: 0,
  distance: "20px",
  origin: "bottom",
  reset: false
});

sr.reveal('.button-container',{
  delay: 600,
  duration: 1500,
  opacity: 0,
  distance: "20px",
  origin: "bottom",
  reset: true
});

sr.reveal('.scale',{
  delay: 0,
  opacity: 0,
  scale: 0.5,
  duration: 1000,
  origin: "bottom",
  distance: "5px",
  reset: false
});


sr.reveal('.opacity',{
  delay: 0,
  opacity: 0,
  scale: 0.8,
  origin: "bottom",
  distance: "5px",
  duration: 1000,
  reset: false
});




