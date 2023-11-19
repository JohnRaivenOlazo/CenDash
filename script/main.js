// ========================================================================== //
// Apply padding effect when the navbar is leave the scrollY point

const nav = document.querySelector(".nav_landing-page");
const navMobile = document.querySelector(".nav-mobile");

let navActive = () => {
    if(window.scrollY > nav.offsetHeight + 150){
        nav.classList.add('active');
        navMobile.classList.add('is-active');
    }else{
        nav.classList.remove('active');
        navMobile.classList.remove('is-active');
    }
} 

window.addEventListener('scroll', navActive);

// ========================================================================== //


// ========================================================================== //
// Apply functionality to the hamburger icon

const hamburger = document.querySelector(".burger-container");
const list = document.querySelector(".nav-mobile");

let hamburgerActive = () => {
    hamburger.classList.toggle('active');
    list.classList.toggle('active');

}

hamburger.addEventListener("click", hamburgerActive);

// ========================================================================== //
// TYPING ANIMATION

// Function to shuffle an array
const shuffleArray = (array) => {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
  }

  // Define an array of strings to be displayed and erased
  const textArray = [
    "Transform your dining experience.",
    "Smart dining, personalized for you.",
    "CenDash: Where food meets innovation.",
    "Effortless ordering, delightful dining.",
    "Explore, order, enjoy — all in one place.",
    "Your campus dining revolution starts here.",
    "Discover a world of flavors at your fingertips.",
    "Savor the convenience of campus dining like never before."
  ];
  
  // Shuffle the array
  shuffleArray(textArray);

  let typeJsText = document.querySelector(".animatedText");
  let stringIndex = 0; // Index of the current string in the array
  let charIndex = 0; // Index of the current character in the current string
  let isTyping = true; // Whether we are currently typing or erasing
  
  const typeJs = () => {
    if (stringIndex < textArray.length) {
      // Check if there are more strings to display or erase
      const currentString = textArray[stringIndex];
  
      if (isTyping) {
        // Typing animation
        if (charIndex < currentString.length) {
          typeJsText.innerHTML += currentString.charAt(charIndex);
          charIndex++;
        } else {
          isTyping = false; // Switch to erasing mode
        }
      } else {
        // Erasing animation
        if (charIndex > 0) {
          typeJsText.innerHTML = currentString.substring(0, charIndex - 1);
          charIndex--;
        } else {
          isTyping = true; // Switch back to typing mode
          stringIndex++; // Move to the next string
  
          if (stringIndex >= textArray.length) {
            stringIndex = 0; // Reset to the beginning of the array
          }
  
          charIndex = 0; // Reset character index
          typeJsText.innerHTML = ""; // Clear the content for the new string
        }
      }
    }
  }
  
  // Set an interval to call the typeJs function
  setInterval(typeJs, 75); // You can adjust the animation speed as needed
  

// ========================================================================== //
// Parallax

const parallax = document.getElementById("parallax");

// Parallax Effect for DIV 1
window.addEventListener("scroll", function () {
  let offset = window.pageYOffset;
  parallax.style.backgroundPositionY = offset * 0.7 + "px";
  // DIV 1 background will move slower than other elements on scroll.
});

