// Language Switcher Module
const LanguageSwitcher = {
    init(options = {}) {
        this.savedLang = localStorage.getItem("selectedLang") || "en";
        this.translations = options.translations || {};
        this.updateCallbacks = options.updateCallbacks || [];
        this.setupI18next();
        this.bindEvents();
        this.updateContent();
    },

    setupI18next() {
        i18next.init({
            lng: this.savedLang,
            resources: this.translations
        });
    },

    bindEvents() {
        const toggleBtn = document.getElementById("toggleLang");
        if (toggleBtn) {
            toggleBtn.addEventListener("click", () => this.toggleLanguage());
        }
    },

    toggleLanguage() {
        const newLang = i18next.language === "en" ? "ar" : "en";
        localStorage.setItem("selectedLang", newLang);
        i18next.changeLanguage(newLang, () => this.updateContent());
        document.getElementById("toggleLang").textContent = newLang === "en" ? "ع" : "E";
    },

    updateContent() {
        const isArabic = i18next.language === "ar";
        
        // Update text alignment for all relevant elements
        this.updateTextAlignment(isArabic);
        
        // Update button styles
        this.updateButtonStyles(isArabic);
        
        // Execute all update callbacks
        this.updateCallbacks.forEach(callback => callback(isArabic));
    },

    updateTextAlignment(isArabic) {
        document.querySelectorAll('[data-i18n-align]').forEach(element => {
            element.style.textAlign = isArabic ? "right" : "left";
        });
    },

    updateButtonStyles(isArabic) {
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
    },

    translate(key) {
        return i18next.t(key);
    }
};

export default LanguageSwitcher;