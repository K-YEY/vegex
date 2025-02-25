gsap.registerPlugin(ScrollTrigger)

gsap.registerPlugin(ScrollToPlugin);

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



gsap.fromTo("#gear", 
    {   

        rotate: "0deg",  // نقطة البداية
    },
    {   

        rotate: "1080deg",  // نقطة البداية

        ease: "power3.out",
        scrollTrigger: {
            trigger: "#gear",
            start: "top 100%", // يبدأ عند وصول أعلى العنصر إلى 80% من ارتفاع النافذة
            end: "bottom -100%",   // ينتهي عند وصول أعلى العنصر إلى 30% من ارتفاع النافذة
            scrub: 1,      // يجعل الحركة سلسة مع التمرير
            markers: false    // لا يعرض علامات للتنقيح
        }
    }
);

gsap.fromTo("#arrow", 
    {   

        rotate: "-180deg",  // نقطة البداية
    },
    {   

        rotate: "0deg",  // نقطة البداية

        ease: "power3.out",
        scrollTrigger: {
            trigger: "#arrow",
            start: "top 80%", // يبدأ عند وصول أعلى العنصر إلى 80% من ارتفاع النافذة
            end: "bottom 75%",   // ينتهي عند وصول أعلى العنصر إلى 30% من ارتفاع النافذة
            scrub: 1,      // يجعل الحركة سلسة مع التمرير
            markers: false    // لا يعرض علامات للتنقيح
        }
    }
);

// var mainTitle = new SplitText("#mainTitle", { type: "words" });

// // تحريك كل حرف بشكل مستقل
// gsap.from(mainTitle.words, {
//     duration: 1,    
//     y: 300,    
//     delay:1,     
//     autoAlpha: 0,   
//     stagger: 0.17,
//     ease: "power5.Out",
    
// });

// var mainP = new SplitText("#mainP", { type: "words" });

// // تحريك كل حرف بشكل مستقل
// gsap.from(mainP.words, {
//     duration: 1,    
//     delay:.5,     

//     y: 100,         
//     autoAlpha: 0,   
//     stagger: 0.05,
//     ease: "power5.Out",
// });


// var sectionTitle1 = new SplitText("#sectionTitle1", { type: "words" });



// gsap.fromTo(sectionTitle1.words, 
//     {   
//         autoAlpha: 0,   

//     },
//     {   
//         autoAlpha: 1,   

//         stagger: 0.17,
//     duration: 1,    

//         ease: "power3.out",
//         scrollTrigger: {
//             trigger: "#sectionTitle1",
//             start: "top 80%", // يبدأ عند وصول أعلى العنصر إلى 80% من ارتفاع النافذة
//             end: "bottom 0%",   // ينتهي عند وصول أعلى العنصر إلى 30% من ارتفاع النافذة
//             scrub: 1,      // يجعل الحركة سلسة مع التمرير
//             markers: false    // لا يعرض علامات للتنقيح
//         }
//     }
// );









function intro(){
    
    

    
    setTimeout(function(){
        gsap.to(".intro", {
            duration: .5, 
            filter: "invert(1)", // تحويل الألوان للعكس

            stagger: 0.05,
            delay:0,
            ease: "power3.inOut"
        });
         
        gsap.to(".logo", 
          
            {   
        
                scale:"1.2",
        
                ease: "power2.inOut",
              
            }
        );
    
        setTimeout(function(){
            gsap.to(".intro", {
                duration: .5, 
                scaleY: 0,   // تكبير العنصر رأسيًا
                transformOrigin: "top center", // نقطة الأصل: أعلى منتصف العنصر   

                delay:0,
                ease: "power3.inOut"
            });
             
            gsap.to(".logo", 
              
                {   
                    duration: .2, 

                    scale:"0",
            
                    ease: "power2.inOut",
                  
                }
            );
        
            
         
            setTimeout(function(){
              
            
          
            
            },500)
         
        },500)
     
    
    },500)
    
    }
    
    intro();



    document.addEventListener("DOMContentLoaded", function () {
        let savedLang = localStorage.getItem("selectedLang") || "en"; // قراءة اللغة المحفوظة أو استخدام "en" كافتراضية
    
        i18next.init({
            lng: savedLang,
            resources: {
                en: {
                    translation: {
                        "mainTitle": "Vegex Agency",
                        "mainP": "From Ahmed Momen",
                        "mainTitle2": "Explore Avilable Courses",
                        "mainP2": "We craft motion graphics, websites, designs, and courses that make an impact ",
                        "sectionTitle1": "Latest Projects",
                        "sectionText1": "We create stunning websites, motion graphics, and designs that bring your vision to life. Let's build something amazing together!",
                        "getStarted": "Get Started",
                        "sectionTitle2": "Our Courses",
                        "sectionText2": "Master the latest web development technologies, computer science, animation, and design. Elevate your skills and turn your passion into a professional career!"
                    }
                },
                ar: {
                    translation: {
                        "mainTitle": "وكالة فيجيكس",
                        "mainP": "من أحمد مؤمن",
                        "mainTitle2": "تصفح الكورسات المتاحة",
                        "mainP2": "تعلم الرسوم المتحركة، والتصميم مع دورة افترافكتس . ارتقِ بمهاراتك وحوّل شغفك إلى مهنة! ",
                        "sectionTitle1": "أحدث المشاريع",
                        "sectionText1": "نحن نصمم مواقع رائعة، ورسوم متحركة، وتصاميم تُحوّل رؤيتك إلى حقيقة. لنُبدع معًا!",
                        "getStarted": "ابدأ الآن",
                        "sectionTitle2": " دوراتنا التعليمية",
                        "sectionText2": "تعلم أحدث تقنيات تطوير الويب، وعلوم الحاسب، والرسوم المتحركة، والتصميم. ارتقِ بمهاراتك، واجعل شغفك طريقك نحو الاحتراف"
                    }
                }
            }
        });
    
        function updateContent() {
            document.getElementById("mainTitle").textContent = i18next.t("mainTitle");
            document.getElementById("mainP").textContent = i18next.t("mainP");
            document.getElementById("sectionTitle1").textContent = i18next.t("sectionTitle1");
            document.querySelector("#sectionTitle1 + p").textContent = i18next.t("sectionText1");
            document.getElementById("sectionTitle2").textContent = i18next.t("sectionTitle2");
            document.querySelector("#sectionTitle2 + p").textContent = i18next.t("sectionText2");
    
            document.querySelectorAll("button").forEach(btn => {
                if (btn.textContent.trim() === "Get Started" || btn.textContent.trim() === "ابدأ الآن") {
                    btn.textContent = i18next.t("getStarted");
                }
            });
    
            let isArabic = i18next.language === "ar";
            document.querySelectorAll("button").forEach(btn => {
                btn.style.marginLeft = isArabic ? "auto" : "0";
                btn.style.marginRight = isArabic ? "0" : "auto";
            });

            
            document.querySelectorAll("button").forEach(btn => {
                if (btn.textContent.trim() === "Get Started" || btn.textContent.trim() === "ابدأ الآن") {
                    btn.textContent = i18next.t("getStarted");
                }
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
            
                // document.body.style.textAlign = isArabic ? "right" : "left";
                document.querySelector("#sectionTitle1 + p").style.textAlign = isArabic ? "right" : "left";
                document.getElementById("sectionTitle1").style.textAlign = isArabic ? "right" : "left";
                document.querySelector("#sectionTitle2 + p").style.textAlign = isArabic ? "right" : "left";
                document.getElementById("sectionTitle2").style.textAlign = isArabic ? "right" : "left";
                
            
    
            document.querySelectorAll(".swiper-slide h2, .swiper-slide p").forEach(element => {
                element.style.textAlign = isArabic ? "right" : "left";
            });
        }
    
        document.getElementById("toggleLang").addEventListener("click", function () {
            let newLang = i18next.language === "en" ? "ar" : "en";
            localStorage.setItem("selectedLang", newLang); // ✅ تخزين اللغة المختارة
            i18next.changeLanguage(newLang, updateContent);
            this.textContent = newLang === "en" ? "ع" : "E";
        });
    
        updateContent();
    });
    



    function sectionNotFound() {
        Swal.fire({
            icon: "warning",
            title: i18next.language === "ar" ? "هذا القسم غير متاح حاليًا" : "This Section is not available right now!",
            text: i18next.language === "ar" ? "انتقل الى قسم الكورسات" : "Go to The courses section",
            iconColor: "white",
            color: "white",
            background: "black",
            showCancelIcon: true, // ✅ إضافة زر إلغاء
            confirmButtonText: i18next.language === "ar" ? "انتقل الآن" : "Go Now",
            cancelButtonText: i18next.language === "ar" ? "إلغاء" : "Cancel",
            customClass: {
                popup: "custom-swal",
                confirmButton: "custom-button",
                cancelButton: "custom-cancel-button" // ✅ تطبيق ستايل مخصص لزر الإلغاء
            }
        }).then((result) => {
            if (result.isConfirmed) {
                barba.go("tutorials.html"); // ✅ الانتقال بالاعتماد على Barba.js
            }
        });
    }
    
    
      
    function linkNotFound() {
        Swal.fire({
            icon: "warning",
            title: i18next.language === "ar" ? "عذرًا" : "Sorry",
            text: i18next.language === "ar" ? "هذا الرابط غير متاح حاليًا" : "This link is not available right now!",
            iconColor: "white",
            color: "white",
            background: "black",
            customClass: {
              popup: "custom-swal",
              confirmButton: "custom-button"
            }
          });
      }
      
      

       
