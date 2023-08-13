var scrollArrow = document.getElementById("scroll-arrow");
var targetIndex = 0;
var targets = [
  "#parallax-1-body",
  "#parallax-2",
  "#parallax-2-body",
  "#parallax-3",
  "#parallax-1",
];

scrollArrow.addEventListener("click", function () {
  var target = targets[targetIndex];

  document.querySelector(target).scrollIntoView({
    behavior: "smooth",
    block: "start",
  });

  targetIndex = (targetIndex + 1) % targets.length;

  updateArrowDirection();
});

function updateArrowDirection() {
  var arrowIcon = scrollArrow.querySelector("span");
  if (targetIndex === 4) {
    arrowIcon.innerHTML = "&uarr;";
  } else {
    arrowIcon.innerHTML = "&darr;";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const options = {
    root: null,
    rootMargin: "0px",
    threshold: 0.5,
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate-fade-in");
      }
    });
  }, options);

  const parallaxSections = document.querySelectorAll(".parallax-section");
  parallaxSections.forEach(function (section) {
    observer.observe(section);
  });
});
