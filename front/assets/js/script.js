const menu = document.getElementById("main_menu");
const slider = document.getElementById("main_slider");
const menu_button = document.getElementById("navbar_burger");

function loadImage(url) {
  return new Promise((resolve, reject) => {
    const img = new Image(); // Create a new Image object

    img.onload = () => {
      // This function executes when the image is fully loaded
      resolve(img); // Resolve the promise with the loaded image element
    };

    img.onerror = () => {
      // This function executes if there's an error loading the image
      reject(new Error(`Failed to load image: ${url}`));
    };

    img.src = url; // Set the image source, which initiates loading
  });
}

const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        menu.classList.add("is-top");
      } else {
        menu.classList.remove("is-top");
      }
    });
  },
  {
    threshold: 0.05,
  }
);

observer.observe(slider);

menu_button.addEventListener("click", function (e) {
  const target = document.getElementById(this.dataset.target);
  if (this.classList.toggle("is-active")) {
    target.classList.add("is-active");
  } else {
    target.classList.remove("is-active");
  }
});

if ("loading" in HTMLImageElement.prototype) {
  const images = document.querySelectorAll("img.lazyload");
  images.forEach((img) => {
    img.src = img.dataset.src;
    img.srcset = img.dataset.srcset;
    img.onload = () => img.classList.add("finish");
    // img.removeAttribute("data-src");

  });
} else {
  // Иначе - загрузить и применить полифилл или JavaScript-библиотеку для
  // организации ленивой загрузки материалов.
  console.log("JS lazyload images");

  const imageObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          loadImage(entry.target.dataset.src)
            .then((imageElement) => {
              imageElement.classList = entry.target.classList;

              entry.target.replaceWith(imageElement); // Example: Add to body
              setTimeout(() => imageElement.classList.add("finish"), 0);
              // entry.target.src = imageElement.src;
              // entry.target.removeAttribute("data-src");
            })
            .catch((error) => {
              console.error(error.message);
            });
        }
      });
    },
    {
      threshold: 0.05,
    }
  );

  const images = document.querySelectorAll("img.lazyload");
  images.forEach((img) => {
    imageObserver.observe(img);
  });
}
