// === ATELIER Front-end JS ===

// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', () => {
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const overlay = document.getElementById('mobile-menu-overlay');
    const closeBtn = document.getElementById('mobile-menu-close');

    if (mobileBtn && overlay) {
        mobileBtn.addEventListener('click', () => {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    if (closeBtn && overlay) {
        closeBtn.addEventListener('click', () => {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    // Toast System
    window.showToast = function(msg, duration = 3000) {
        let t = document.getElementById('global-toast');
        if (!t) {
            t = document.createElement('div');
            t.id = 'global-toast';
            t.className = 'toast';
            document.body.appendChild(t);
        }
        t.textContent = msg;
        t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), duration);
    };

    // Add to Cart
    document.querySelectorAll('[data-action="add-to-cart"]').forEach(btn => {
        btn.addEventListener('click', () => showToast('Added to your bag'));
    });

    // Size Selector
    document.querySelectorAll('[data-action="select-size"]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('[data-action="select-size"]').forEach(b => {
                b.classList.remove('border-primary', 'bg-primary', 'text-on-primary');
                b.classList.add('border-outline-variant/30');
            });
            btn.classList.add('border-primary', 'bg-primary', 'text-on-primary');
            btn.classList.remove('border-outline-variant/30');
        });
    });

    // Quantity Controls
    document.querySelectorAll('.qty-control').forEach(ctrl => {
        const minus = ctrl.querySelector('[data-qty="minus"]');
        const plus = ctrl.querySelector('[data-qty="plus"]');
        const val = ctrl.querySelector('[data-qty="value"]');
        if (minus && plus && val) {
            minus.addEventListener('click', () => {
                let v = parseInt(val.textContent);
                if (v > 1) val.textContent = String(v - 1).padStart(2, '0');
            });
            plus.addEventListener('click', () => {
                let v = parseInt(val.textContent);
                val.textContent = String(v + 1).padStart(2, '0');
            });
        }
    });

    // Payment Toggle (Checkout)
    const radios = document.querySelectorAll('input[name="payment"]');
    const ccFields = document.getElementById('credit-card-fields');
    if (radios.length && ccFields) {
        radios.forEach(r => r.addEventListener('change', () => {
            ccFields.style.display = r.value === 'credit-card' && r.checked ? 'grid' : 'none';
        }));
    }

    // Navbar scroll effect
    const nav = document.getElementById('main-navbar');
    if (nav) {
        window.addEventListener('scroll', () => {
            nav.classList.toggle('shadow-sm', window.scrollY > 100);
        }, { passive: true });
    }

    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('animate-fade-in-up');
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('[data-animate]').forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });
});
