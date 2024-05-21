

// slider start 

  const carousel = document.getElementById('myCarousel');
  const interval = 1000; // Change interval in milliseconds (1 second)

  carousel.addEventListener('slide.bs', () => {
    clearInterval(carousel._interval); // Clear previous interval
  });

  carousel.addEventListener('slid.bs', () => {
    carousel._interval = setInterval(() => {
      carousel.cycle('next');
    }, interval); // Set new interval for automatic slide
  });

  // Start the carousel initially
  carousel._interval = setInterval(() => {
    carousel.cycle('next');
  }, interval);

// slider end

