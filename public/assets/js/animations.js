// Animations Module
const Animations = {
    init() {
        this.setupBarbaTransitions();
        this.setupScrollAnimations();
    },

    setupBarbaTransitions() {
        barba.init({
            transitions: [{
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
            }]
        });
    },

    setupScrollAnimations() {
        this.setupGearAnimation();
        this.setupArrowAnimation();
    },

    setupGearAnimation() {
        gsap.fromTo("#gear", 
            { rotate: "0deg" },
            {
                rotate: "1080deg",
                ease: "power3.out",
                scrollTrigger: {
                    trigger: "#gear",
                    start: "top 100%",
                    end: "bottom -100%",
                    scrub: 1,
                    markers: false
                }
            }
        );
    },

    setupArrowAnimation() {
        gsap.fromTo("#arrow", 
            { rotate: "-180deg" },
            {
                rotate: "0deg",
                ease: "power3.out",
                scrollTrigger: {
                    trigger: "#arrow",
                    start: "top 80%",
                    end: "bottom 75%",
                    scrub: 1,
                    markers: false
                }
            }
        );
    },

    animateIntro() {
        setTimeout(() => {
            gsap.to(".intro", {
                duration: .5,
                filter: "invert(1)",
                stagger: 0.05,
                delay: 0,
                ease: "power3.inOut"
            });

            gsap.to(".logo", {
                scale: "1.2",
                ease: "power2.inOut"
            });

            setTimeout(() => {
                gsap.to(".intro", {
                    duration: .5,
                    scaleY: 0,
                    transformOrigin: "top center",
                    delay: 0,
                    ease: "power3.inOut"
                });

                gsap.to(".logo", {
                    duration: .2,
                    scale: "0",
                    ease: "power2.inOut"
                });
            }, 500);
        }, 500);
    },

    animateSlideContent() {
        const elements = [
            { selector: ".title", delay: 0 },
            { selector: ".par", delay: 0.2 },
            { selector: ".img-fluid", delay: 0 },
            { selector: ".button", delay: 0.2 }
        ];

        elements.forEach(({ selector, delay }) => {
            gsap.fromTo(
                `.swiper-slide-active ${selector}`,
                { opacity: 0, y: 50 },
                { opacity: 1, y: 0, duration: 1, delay, ease: "power2.out" }
            );
        });
    }
};

export default Animations;