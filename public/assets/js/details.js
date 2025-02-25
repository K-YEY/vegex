
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



const player = new Plyr('#player');

const courses = {
    "After Effects": { video: "ad2.mp4" },
    "PowerPoint": { video: "powerpoint.mp4" },
    "Operating System": { video: "os.mp4" }
};

const urlParams = new URLSearchParams(window.location.search);
const courseName = urlParams.get("course") || "After Effects"; // القيمة الافتراضية

// تعيين الفيديو لمرة واحدة عند تحميل الصفحة
if (courses[courseName]) {
    document.getElementById("course-video").src = courses[courseName].video;
}

document.addEventListener("DOMContentLoaded", function () {
    let savedLang = localStorage.getItem("selectedLang") || "en"; // ✅ قراءة اللغة المحفوظة

    i18next.init({
        lng: savedLang,
        resources: {
            en: {
                translation: {
                    "After Effects_title": "Master Adobe After Effects",
                    "After Effects_description": "Learn motion graphics and visual effects from scratch to expert level.",
                    "After Effects_price": "$10",
                    "After Effects_lectures": "10 Lectures",
                    "PowerPoint_title": "Master Microsoft PowerPoint",
                    "PowerPoint_description": "Create stunning presentations with advanced PowerPoint techniques.",
                    "PowerPoint_price": "$199",
                    "PowerPoint_lectures": "10 Lectures",
                    "Operating System_title": "Operating System Fundamentals",
                    "Operating System_description": "Understand OS concepts, file systems, and process management.",
                    "Operating System_price": "$5",
                    "Operating System_lectures": "10 Lectures",
                    "enroll": "Enroll Now",
                    "More": "More Courses"

                }
            },
            ar: {
                translation: {
                    "After Effects_title": "احتراف أدوبي أفتر إفكتس",
                    "After Effects_description": "تعلم الرسوم المتحركة والمؤثرات البصرية من الصفر حتى الاحتراف.",
                    "After Effects_price": "10 دولار",
                    "After Effects_lectures": "10 محاضرات",
                    "PowerPoint_title": "احتراف مايكروسوفت باوربوينت",
                    "PowerPoint_description": "أنشئ عروضًا تقديمية رائعة باستخدام تقنيات باوربوينت المتقدمة.",
                    "PowerPoint_price": "199 دولار",
                    "PowerPoint_lectures": "10 محاضرات",
                    "Operating System_title": "أساسيات أنظمة التشغيل",
                    "Operating System_description": "افهم مفاهيم نظام التشغيل، أنظمة الملفات، وإدارة العمليات.",
                   "Operating System_price": "5 دولار",
"Operating System_lectures": "10 محاضرات",
                    "enroll": "اشترك الآن",
                    "More" : "المزيد من الكورسات"
                }
            }
        }
    });

  

    function updateCourseContent() {
        let isArabic = i18next.language === "ar";

        if (courses[courseName]) {
            document.getElementById("course-title").innerText = i18next.t(`${courseName}_title`);
            document.getElementById("course-description").innerText = i18next.t(`${courseName}_description`);
            document.getElementById("course-price").innerText = i18next.t(`${courseName}_price`);
            document.getElementById("course-lectures").innerText = i18next.t(`${courseName}_lectures`);

            // تحديث زر الاشتراك
            let enrollBtn = document.getElementById("enroll-button");
            enrollBtn.innerText = i18next.t("enroll");
            enrollBtn.style.direction = isArabic ? "rtl" : "ltr";

            enrollBtn.onclick = function () {
                sendWhatsAppMessage(courseName);
            };

            let moreBtn = document.getElementById("more-button");
            moreBtn.innerText = i18next.t("More");
            moreBtn.style.direction = isArabic ? "rtl" : "ltr";

         
        }

        function toArabicNumbers(num) {
            const arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
            return num.toString().replace(/\d/g, (digit) => arabicNumbers[digit]);
        }
        if (isArabic) {
            document.getElementById("course-price").innerText = toArabicNumbers(i18next.t(`${courseName}_price`));
            document.getElementById("course-lectures").innerText = toArabicNumbers(i18next.t(`${courseName}_lectures`));
        } else {
            document.getElementById("course-price").innerText = i18next.t(`${courseName}_price`);
            document.getElementById("course-lectures").innerText = i18next.t(`${courseName}_lectures`);
        }
        
        // ضبط الاتجاه
        document.querySelectorAll(".course-info h2, .course-info p").forEach(element => {
            element.style.textAlign = isArabic ? "right" : "left";
        });
    }

    document.getElementById("toggleLang").addEventListener("click", function () {
        let newLang = i18next.language === "en" ? "ar" : "en";
        localStorage.setItem("selectedLang", newLang);
        i18next.changeLanguage(newLang, updateCourseContent);
        this.textContent = newLang === "en" ? "ع" : "E";
    });

    function sendWhatsAppMessage(courseName) {
        const phoneNumber = "201032210758"; // رقم الواتساب بدون "+"
        const message = `أرسل بوابة الدفع للاشتراك في كورس ${i18next.t(`${courseName}_title`)}`;
        const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(whatsappURL, "_blank");
    }

    updateCourseContent();
});
