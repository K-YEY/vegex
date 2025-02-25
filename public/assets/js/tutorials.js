document.addEventListener("DOMContentLoaded", function () {
  barba.init({
      transitions: [
          {
              name: "fade-transition",
              leave(data) {
                  return gsap.to(data.current.container, {
                      opacity: 0,
                      duration: 1,
                      ease: "power2.out"
                  });
              },
           
              enter(data) {
                  return gsap.to(data.next.container, {
                      opacity: 1,
                      duration: 1,
                      ease: "power2.out"
                  });
              }
          }
      ]
  });
});





var swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },

    on: {
              slideChangeTransitionStart: function () {
                  gsap.fromTo(".swiper-slide-active .title", 
                      { opacity: 0, y: 50 }, 
                      { opacity: 1, y: 0, duration: 1, ease: "power2.out" }
                  );
                  gsap.fromTo(".swiper-slide-active .par", 
                    { opacity: 0, y: 50 }, 
                    { opacity: 1, y: 0, duration: 1, delay:.2, ease: "power2.out" }
                );
                gsap.fromTo(".swiper-slide-active .img-fluid", 
                    { opacity: 0, y: 50 }, 
                    { opacity: 1, y: 0, duration: 1, delay:0, ease: "power2.out" }
                );
                gsap.fromTo(".swiper-slide-active .button", 
                    { opacity: 0, y: 50 }, 
                    { opacity: 1, y: 0, duration: 1, delay:.2, ease: "power2.out" }
                );
              }
          }
          ,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  window.onload = function () {
    gsap.fromTo(".swiper-slide-active .title", 
        { opacity: 0, y: 50 }, 
        { opacity: 1, y: 0, duration: 1, delay:.8, ease: "power2.out" }
    );
    gsap.fromTo(".swiper-slide-active .par", 
      { opacity: 0, y: 50 }, 
      { opacity: 1, y: 0, duration: 1, delay:.9, ease: "power2.out" }
  );
  gsap.fromTo(".swiper-slide-active .img-fluid", 
      { opacity: 0, y: 50 }, 
      { opacity: 1, y: 0, duration: 1, delay:.7, ease: "power2.out" }
  );
  gsap.fromTo(".swiper-slide-active .button", 
      { opacity: 0, y: 50 }, 
      { opacity: 1, y: 0, duration: 1, delay:1, ease: "power2.out" }
  );
  gsap.fromTo(".button", 
    { opacity: 0,  }, 
    { opacity: 1, duration: 1, delay:2, ease: "power2.out" }
);
};

document.addEventListener("DOMContentLoaded", function () {
  let savedLang = localStorage.getItem("selectedLang") || "en"; // ✅ قراءة اللغة المحفوظة

  i18next.init({
      lng: savedLang,
      resources: {
          en: {
              translation: {
                  "mainTitle2": "Explore Available Tutorials",
                  // "mainP2": "We craft motion graphics, websites, designs, and courses that make an impact.",
                  "getStarted": "Get Started"
              }
          },
          ar: {
              translation: {
                  "mainTitle2": "تصفح الكورسات المتاحة",
                  // "mainP2": "تعلم الرسوم المتحركة، والتصميم مع دورة افترافكتس . ارتقِ بمهاراتك وحوّل شغفك إلى مهنة",
                  "getStarted": "ابدأ الآن"
              }
          }
      }
  });

  const coursesData = {
      "After Effects": {
          en: {
              title: "Master Adobe After Effects",
              description: "Create stunning motion graphics and visual effects! Learn animation, compositing, and advanced editing techniques to bring your ideas to life."
          },
          ar: {
              title: "احتراف أدوبي أفتر إفكتس",
              description: "اصنع رسومًا متحركة ومؤثرات بصرية مذهلة! تعلم التحريك، الدمج، وتقنيات المونتاج المتقدمة لتحويل أفكارك إلى واقع."
          }
      },
      "PowerPoint": {
          en: {
              title: "Master PowerPoint",
              description: "Create professional presentations with ease! Learn design, animations, transitions, and storytelling to captivate your audience."
          },
          ar: {
              title: "احتراف باوربوينت",
              description: "أنشئ عروضًا تقديمية احترافية بسهولة! تعلم التصميم، التحريك، الانتقالات، وتقنيات السرد لإبهار جمهورك."
          }
      },
      "Operating System": {
          en: {
              title: "Operating Systems",
              description: "Understand the OS and how it manages hardware, software, and resources efficiently. Learn process management, memory allocation, and security."
          },
          ar: {
              title: "أنظمة التشغيل",
              description: "تعلم كيف يدير نظام التشغيل العتاد والبرامج والموارد بكفاءة. اكتسب معرفة في إدارة العمليات، تخصيص الذاكرة، والأمان."
          }
      }
  };

  function updateContent2() {
      let isArabic = i18next.language === "ar";

      document.getElementById("mainTitle2").textContent = i18next.t("mainTitle2");
      // document.getElementById("mainP2").textContent = i18next.t("mainP2");

      document.querySelectorAll("button").forEach(btn => {
          if (btn.textContent.trim() === "Get Started" || btn.textContent.trim() === "ابدأ الآن") {
              btn.textContent = i18next.t("getStarted");
          }
      });

      // تحديث كل السلايدز بناءً على `data-course`
      document.querySelectorAll(".swiper-slide").forEach(slide => {
          let courseKey = slide.getAttribute("data-course");
          if (coursesData[courseKey]) {
              slide.querySelector("h2").textContent = coursesData[courseKey][isArabic ? "ar" : "en"].title;
              slide.querySelector("p").textContent = coursesData[courseKey][isArabic ? "ar" : "en"].description;
          }
      });

      // ضبط المحاذاة بناءً على اللغة
      document.querySelectorAll("button").forEach(btn => {
          btn.style.marginLeft = isArabic ? "auto" : "0";
          btn.style.marginRight = isArabic ? "0" : "auto";
      });

          document.querySelectorAll("button").forEach(btn => {
                if (isArabic) {
                    btn.style.marginLeft = "auto";
                    btn.style.marginRight = "0";
                    btn.style.display = "block";
                } else {
                    btn.style.marginLeft = "0";
                    btn.style.marginRight = "auto";
                }
            });

      document.querySelectorAll(".swiper-slide h2, .swiper-slide p").forEach(element => {
          element.style.textAlign = isArabic ? "right" : "left";
      });
  }

  document.getElementById("toggleLang").addEventListener("click", function () {
      let newLang = i18next.language === "en" ? "ar" : "en";
      localStorage.setItem("selectedLang", newLang); // ✅ تخزين اللغة المختارة
      i18next.changeLanguage(newLang, updateContent2);
      this.textContent = newLang === "en" ? "ع" : "E";
  });

  updateContent2();
});


function courseNotFound() {
  Swal.fire({
      icon: "warning",
      title: i18next.language === "ar" ? "عذرًا" : "Sorry",
      text: i18next.language === "ar" ? "هذا الكورس غير متاح حاليًا!" : "This course is not available right now!",
      iconColor: "white",
      color: "white",
      background: "black",
      customClass: {
        popup: "custom-swal",
        confirmButton: "custom-button"
      }
    });
}
