console.log("Hello");
///////////////////////////////////////////////////////////
// Fixing flexbox gap property missing in some Safari versions
function checkFlexGap() {
  var flex = document.createElement("div");
  flex.style.display = "flex";
  flex.style.flexDirection = "column";
  flex.style.rowGap = "1px";

  flex.appendChild(document.createElement("div"));
  flex.appendChild(document.createElement("div"));

  document.body.appendChild(flex);
  var isSupported = flex.scrollHeight === 1;
  flex.parentNode.removeChild(flex);
  console.log(isSupported);

  if (!isSupported) document.body.classList.add("no-flexbox-gap");
}
checkFlexGap();

const button = document.querySelector(".mobile-btn");
const header = document.querySelector(".header");
button.addEventListener("click", function () {
  header.classList.toggle("open");
});

// const links = document.querySelectorAll("a:link");
// links.forEach(function (i) {
//   i.addEventListener("click", function (e) {
//     const link = i.getAttribute("href");

//     // Prevent default only for in-page links (anchor links)
//     if (link.startsWith("#")) {
//       e.preventDefault();
//       if (link === "#") {
//         window.scrollTo({ top: 0, behavior: "smooth" });
//       }
//       if (link !== "#" && link.startsWith("#")) {
//         document.querySelector(link).scrollIntoView({ behavior: "smooth" });
//         console.log(link);
//       }
//     }

//     // Keep this toggle functionality if needed for navigation menus
//     if (i.classList.contains("header-nav-link")) {
//       header.classList.toggle("open");
//     }
//   });
// });

// const hero = document.querySelector(".hero-section");
// const obs = new IntersectionObserver(
//   function (entries) {
//     const e = entries[0];
//     console.log(e);
//     if (!e.isIntersecting) document.body.classList.add("sticky");
//     if (e.isIntersecting) document.body.classList.remove("sticky");
//   },
//   {
//     root: null,
//     threshold: 0,
//     rootMargin: "-37px",
//   }
// );
// obs.observe(hero);
// https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js

// Save the current scroll position in local storage
