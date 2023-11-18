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

// BOT
sr.reveal('.bottom',{
  delay: 600,
  duration: 1500,
  opacity: 0,
  distance: "20px",
  origin: "bottom",
  reset: true
});

sr.reveal('#s2',{
  delay: 125,
  duration: 1500,
  opacity: 0,
  distance: "50%",
  origin: "right",
  reset: true
});

sr.reveal('#s3',{
  delay: 175,
  duration: 1500,
  opacity: 0,
  distance: "50%",
  origin: "bottom",
  reset: true
});