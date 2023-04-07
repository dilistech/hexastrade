

const headerId = document.querySelector("#header-id");
const SectionId = document.querySelector("#section-id");
const preLoader = document.querySelector("#pre-loader");
const showCase = document.querySelector(".show-case");
const customerSupport = document.querySelector("#customer-support-counter");
const happyCustomer = document.querySelector("#happy-customer-counter");
const totalTransaction = document.querySelector("#total-transactions-done-counter");
const teamMembers = document.querySelector("#team-members-counter");
const faqH3 = document.querySelectorAll(".faq-content h3");



$(function () {
   var siteSticky = function () {
     $(".js-sticky-header").sticky({ topSpacing: 0 });
   };
   siteSticky();

   var siteMenuClone = function () {
     $(".js-clone-nav").each(function () {
       var $this = $(this);
       $this
         .clone()
         .attr("class", "site-nav-wrap")
         .appendTo(".site-mobile-menu-body");
     });

     setTimeout(function () {
       var counter = 0;
       $(".site-mobile-menu .has-children").each(function () {
         var $this = $(this);

         $this.prepend('<span class="arrow-collapse collapsed">');

         $this.find(".arrow-collapse").attr({
           "data-toggle": "collapse",
           "data-target": "#collapseItem" + counter,
         });

         $this.find("> ul").attr({
           class: "collapse",
           id: "collapseItem" + counter,
         });

         counter++;
       });
     }, 1000);

     $("body").on("click", ".arrow-collapse", function (e) {
       var $this = $(this);
       if ($this.closest("li").find(".collapse").hasClass("show")) {
         $this.removeClass("active");
       } else {
         $this.addClass("active");
       }
       e.preventDefault();
     });

     $(window).resize(function () {
       var $this = $(this),
         w = $this.width();

       if (w > 768) {
         if ($("body").hasClass("offcanvas-menu")) {
           $("body").removeClass("offcanvas-menu");
         }
       }
     });

     $("body").on("click", ".js-menu-toggle", function (e) {
       var $this = $(this);
       e.preventDefault();

       if ($("body").hasClass("offcanvas-menu")) {
         $("body").removeClass("offcanvas-menu");
         $this.removeClass("active");
       } else {
         $("body").addClass("offcanvas-menu");
         $this.addClass("active");
       }
     });

     // click outisde offcanvas
     $(document).mouseup(function (e) {
       var container = $(".site-mobile-menu");
       if (!container.is(e.target) && container.has(e.target).length === 0) {
         if ($("body").hasClass("offcanvas-menu")) {
           $("body").removeClass("offcanvas-menu");
         }
       }
     });
   };
   siteMenuClone();
 });

window.addEventListener("load", () => {

  preLoader.classList.add('display-none');
  headerId.classList.remove('display-none');
  SectionId.classList.remove('display-none');





   faqH3.forEach((h3) => {
    h3.addEventListener("click", e => {
      let parent = e.target.parentNode;
      let p = parent.querySelector("p");
      let arrow = parent.querySelector("#arrow");
      let style = window.getComputedStyle(p);
      let display = style.getPropertyValue("display");

      $(p).slideToggle(700);

      if (display === "block") {
        arrow.classList.remove("fa-arrow-right");
        arrow.classList.add("fa-arrow-down");
      } else {
        arrow.classList.remove("fa-arrow-down");
        arrow.classList.add("fa-arrow-right");
      }
    });
  });

  



});
const toTop = document.querySelector(".to-top");
window.addEventListener("scroll", () => {
  if (window.pageYOffset > 300) {
    toTop.classList.add("active");
  } else {
    toTop.classList.remove("active");
  }
});





let matches = window.matchMedia("(min-width: 750px)").matches;
matches
  ? (options = { threshold: 0.2, rootMargin: "-80px 0px" })
  : (options = { threshold: 0.4, rootMargin: "0px 0px" });
const planObserver = new IntersectionObserver(
  plansObserver,
  options
);

function plansObserver(entries, planObserver) {
  entries.forEach(entry => {
    if (!entry.isIntersecting) {
      return;
    } else {
      const plan = entry.target;
      plan.classList.add("smooth-flow");
      planObserver.unobserve(plan);
    }
  });
}

let plans = document.querySelectorAll(".pricing-plans");
plans.forEach(plan => {
  planObserver.observe(plan);
});


let flexMatches = window.matchMedia("(min-width: 913px)").matches;
flexMatches
  ? (options = { threshold: 0.5, rootMargin: "-80px 0px" })
  : (options = { threshold: 1, rootMargin: "-200px 0px" });
const flexObserver = new IntersectionObserver(
  flexsObserver,
  options
);

function flexsObserver(entries, flexObserver) {
  entries.forEach(entry => {
    if (!entry.isIntersecting) {
      return;
    } else {
      const flex = entry.target;
      let font =flex.querySelector('.font');
      let detail = flex.querySelector('.detail');
      font.classList.add("smooth-flow");
      detail.classList.add("smooth-flow");
      flexObserver.unobserve(flex);
    }
  });
}

let flexs = document.querySelectorAll(".how-it-works .flex");
flexs.forEach(flex => {
  flexObserver.observe(flex);
});

let counterMatches = window.matchMedia("(min-width: 913px)").matches;

counterMatches
  ? (options = { threshold: 0.5, rootMargin: "-80px 0px" })
  : (options = { threshold: 0.4, rootMargin: "-120px 0px" });
const counterObserver = new IntersectionObserver(
  countersObserver,
  options
);

function countersObserver(entries, counterObserver) {
  entries.forEach(entry => {
    if (!entry.isIntersecting) {
      return;
    } else {
        
      $(customerSupport).counterUp({
        delay: 10,
    time: 2000
      });
       $(happyCustomer).counterUp({
        delay: 10,
    time: 2000
      });
       $(teamMembers).counterUp({
        delay: 10,
    time: 2000
      });
       $(totalTransaction).counterUp({
        delay: 10,
    time: 2000
      });
      
          
      counterObserver.unobserve(showCase);
    }
  });
}
  counterObserver.observe(showCase);

 