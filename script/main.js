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
//PARALAX TEST

window.addEventListener('scroll', function () {
  // Add parallax scrolling to all images in .paralax-image container
  document.querySelectorAll('.parallax').forEach(function (element) {
      // only put top value if the window scroll has gone beyond the top of the image
      if (element.offsetTop < window.scrollY) {
          // Get amount of pixels the image is above the top of the window
          var difference = window.scrollY - element.offsetTop;
          // Top value of image is set to half the amount scrolled
          // (this gives the illusion of the image scrolling slower than the rest of the page)
          var half = (difference / 2) + 'px';
          var transform = 'translate3d(0, ' + half + ', 0)';

          element.querySelector('img').style.transform = transform;
      } else {
          // if image is below the top of the window set top to 0
          element.querySelector('img').style.transform = 'translate3d(0, 0, 0)';
      }
  });
});
