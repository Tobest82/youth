// ========================================
// AKPA-EDEM YOUTH HUB - ANIMATIONS & INTERACTIONS
// ======================================== 

// ========== INTERSECTION OBSERVER FOR SCROLL ANIMATIONS ==========
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe elements for animation
document.addEventListener('DOMContentLoaded', () => {
    const elementsToObserve = document.querySelectorAll(
        '.about-service-faq-div h1, .card, .expected-outcome > div, .accordion-item'
    );
    elementsToObserve.forEach(el => observer.observe(el));
});

// ========== NAVBAR SCROLL EFFECT ==========
let lastScrollTop = 0;
const navbar = document.querySelector('.navbar-section');
const firstHeader = document.querySelector('.first-header');

window.addEventListener('scroll', () => {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // Add shadow on scroll
    if (scrollTop > 50) {
        if (navbar) navbar.style.boxShadow = '0 10px 30px rgba(0,0,0,0.15)';
        if (firstHeader) firstHeader.style.boxShadow = '0 10px 30px rgba(0,0,0,0.15)';
    } else {
        if (navbar) navbar.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)';
        if (firstHeader) firstHeader.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)';
    }
    
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
});

// ========== SMOOTH SCROLL FOR ANCHOR LINKS ==========
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    });
});

// ========== COUNTER ANIMATION FOR STATS ==========
function animateCounter(element, duration = 2000) {
    const finalText = element.textContent.trim();
    const target = parseInt(finalText.match(/\d+/)[0]);
    let current = 0;
    
    // Easing function for smooth animation
    const easeOutQuad = (t) => t * (2 - t);
    
    const startTime = Date.now();
    
    const animate = () => {
        const elapsed = Date.now() - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easedProgress = easeOutQuad(progress);
        
        current = Math.floor(target * easedProgress);
        element.textContent = current + '+';
        
        if (progress < 1) {
            requestAnimationFrame(animate);
        } else {
            element.textContent = target + '+';
            element.classList.add('counting-complete');
        }
    };
    
    animate();
}

// Trigger counter animation when outcome section comes into view
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOMContentLoaded fired');
    
    const expectedOutcomeSection = document.querySelector('.expected-outcome-section');
    console.log('Expected outcome section found:', expectedOutcomeSection);
    
    if (!expectedOutcomeSection) {
        console.warn('Expected outcome section not found!');
        return;
    }

    const outcomeObserver = new IntersectionObserver((entries) => {
        console.log('IntersectionObserver callback triggered', entries);
        
        entries.forEach(entry => {
            console.log('Entry isIntersecting:', entry.isIntersecting);
            
            if (entry.isIntersecting) {
                console.log('Expected outcome section is visible');
                
                const outcomeNumbers = entry.target.querySelectorAll('.outcome-number');
                console.log('Found outcome numbers:', outcomeNumbers.length);
                
                outcomeNumbers.forEach((number, index) => {
                    console.log(`Animating number ${index}:`, number.textContent);
                    
                    // Stagger the animations by 100ms
                    setTimeout(() => {
                        if (!number.classList.contains('animated')) {
                            console.log('Starting animation for:', number.textContent);
                            animateCounter(number, 2000);
                            number.classList.add('animated');
                        }
                    }, index * 100);
                });
                
                outcomeObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    outcomeObserver.observe(expectedOutcomeSection);
    console.log('Outcome observer started');
});

// ========== PARALLAX EFFECT ON IMAGES ==========
window.addEventListener('scroll', () => {
    const parallaxImages = document.querySelectorAll('.carousel-image-div img');
    parallaxImages.forEach(img => {
        const scrollPosition = window.pageYOffset;
        img.style.transform = `translateY(${scrollPosition * 0.5}px)`;
    });
});

// ========== BUTTON RIPPLE EFFECT ==========
function addRippleEffect(button) {
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');
    
    button.appendChild(ripple);
    
    setTimeout(() => ripple.remove(), 600);
}

document.querySelectorAll('.login-button, .sign-up-button').forEach(button => {
    button.addEventListener('click', function(e) {
        if (this.style.position !== 'relative') {
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
        }
        addRippleEffect(this);
    });
});

// ========== ACCORDION SMOOTH ANIMATION ==========
document.querySelectorAll('.accordion-button').forEach(button => {
    button.addEventListener('click', function() {
        const accordionItem = this.closest('.accordion-item');
        accordionItem.classList.toggle('active');
    });
});

// ========== NAVBAR ACTIVE LINK ==========
window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section[id]');
    const scrollY = window.pageYOffset;
    
    sections.forEach(current => {
        const sectionHeight = current.offsetHeight;
        const sectionTop = current.offsetTop - 100;
        const sectionId = current.getAttribute('id');
        
        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            const activeLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);
            if (activeLink) {
                activeLink.classList.add('active');
            }
        }
    });
});

// ========== MOBILE MENU TOGGLE ==========
const navbarToggler = document.querySelector('.navbar-toggler');
const navbarCollapse = document.querySelector('.navbar-collapse');

if (navbarToggler) {
    navbarToggler.addEventListener('click', function() {
        if (navbarCollapse.classList.contains('show')) {
            navbarCollapse.classList.remove('show');
        } else {
            navbarCollapse.classList.add('show');
        }
    });
}

// Close mobile menu when link is clicked
document.querySelectorAll('.navbar-nav a').forEach(link => {
    link.addEventListener('click', () => {
        if (navbarCollapse && navbarCollapse.classList.contains('show')) {
            navbarCollapse.classList.remove('show');
        }
    });
});

// ========== CAROUSEL AUTO-ROTATE ==========
const carousel = document.querySelector('.carousel');
if (carousel) {
    // Bootstrap carousel auto-rotation is handled by data-bs-ride="carousel"
    // Add custom pause on hover
    carousel.addEventListener('mouseenter', () => {
        const carouselInstance = new bootstrap.Carousel(carousel, {pause: true});
    });
}

// ========== TEXT ANIMATION ON PAGE LOAD ==========
function animateTextOnLoad() {
    const headings = document.querySelectorAll('h1:first-of-type');
    headings.forEach(heading => {
        heading.style.animation = 'fadeInScale 0.8s ease-out';
    });
}

window.addEventListener('load', animateTextOnLoad);

// ========== LAZY LOAD IMAGES ==========
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            }
        });
    });
    
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// ========== SCROLL TO TOP BUTTON ==========
function createScrollToTopButton() {
    const scrollBtn = document.createElement('button');
    scrollBtn.innerHTML = '↑';
    scrollBtn.className = 'scroll-to-top';
    scrollBtn.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #BE3144, #ffc107);
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999;
        box-shadow: 0 4px 12px rgba(190, 49, 68, 0.3);
        transition: all 300ms ease-out;
        font-weight: bold;
    `;
    
    document.body.appendChild(scrollBtn);
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollBtn.style.display = 'flex';
        } else {
            scrollBtn.style.display = 'none';
        }
    });
    
    scrollBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    scrollBtn.addEventListener('mouseenter', () => {
        scrollBtn.style.transform = 'scale(1.1) rotate(20deg)';
    });
    
    scrollBtn.addEventListener('mouseleave', () => {
        scrollBtn.style.transform = 'scale(1) rotate(0)';
    });
}

window.addEventListener('load', createScrollToTopButton);

// ========== PAGE LOAD ANIMATIONS ==========
window.addEventListener('load', () => {
    // Animate nav links
    document.querySelectorAll('.nav-link').forEach((link, index) => {
        link.style.animation = `slideInFromLeft 0.6s ease-out ${0.1 * index}s backwards`;
    });
});

// ========== MOUSE FOLLOW EFFECT ON CARDS ==========
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        card.style.background = `radial-gradient(circle at ${x}px ${y}px, rgba(190, 49, 68, 0.1), transparent)`;
    });
    
    card.addEventListener('mouseleave', () => {
        card.style.background = 'var(--light-bg)';
    });
});

// ========== HEADER STICKY EFFECT ==========
const header = document.querySelector('.first-header');
let ticking = false;
let lastScrollY = 0;

window.addEventListener('scroll', () => {
    lastScrollY = window.scrollY;
    if (!ticking) {
        window.requestAnimationFrame(() => {
            if (header) {
                if (lastScrollY > 10) {
                    header.style.padding = '8px 0';
                } else {
                    header.style.padding = '12px 0';
                }
            }
            ticking = false;
        });
        ticking = true;
    }
});

// ========== FORM INPUT FOCUS EFFECTS ==========
document.querySelectorAll('input, textarea').forEach(input => {
    input.addEventListener('focus', function() {
        this.style.boxShadow = '0 0 0 3px rgba(190, 49, 68, 0.1)';
    });
    
    input.addEventListener('blur', function() {
        this.style.boxShadow = 'none';
    });
});

// ========== ACCESSIBILITY: FOCUS VISIBLE KEYBOARD NAVIGATION ==========
document.addEventListener('keydown', (e) => {
    if (e.key === 'Tab') {
        document.body.classList.add('keyboard-nav');
    }
});

document.addEventListener('mousedown', () => {
    document.body.classList.remove('keyboard-nav');
});

console.log('✨ Animations initialized successfully!');
