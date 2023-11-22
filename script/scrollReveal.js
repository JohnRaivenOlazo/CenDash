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
  reset: true
});

sr.reveal('.left-min-delay', {
  delay: 0,
  duration: 1000,
  distance: "50px",
  origin: "left",
  reset: true,
});

sr.reveal('.right-min-delay', {
  delay: 0,
  duration: 1000,
  distance: "20px",
  origin: "right",
  reset: true,
});

sr.reveal('.bottom-min-delay', {
  delay: 0,
  duration: 1000,
  opacity: 0,
  distance: "50px",
  origin: "bottom",
  reset: true,
});

// BOT
sr.reveal('.bottom',{
  delay: 600,
  duration: 1500,
  opacity: 0,
  distance: "20px",
  origin: "bottom",
  reset: true
});

sr.reveal('.scale',{
  opacity: 0,
  scale: 0.5,
  duration: 1000,
  reset: true
});


sr.reveal('.opacity',{
  opacity: 0,
  scale: 0.8,
  duration: 1500,
  reset: true
});


sr.reveal('.text-reveal',{
  opacity: 0,
  duration: 1500,
  reset: true
});



