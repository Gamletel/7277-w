class MobileMenu {
    menu;
    burger;
    closeToggler;
    touchStats;

    constructor(menu) {
        this.menu = document.getElementById('mobile-mnu');
        this.burger = Array.from(document.querySelectorAll('.burger.open_menu'));
        this.closeToggler = document.querySelector('#mobile-mnu #close-mnu');
        this.touchStats = {
            'startX': 0,
            'startY': 0,
            'endX': 0,
            'endY': 0,
        };

        this.init = this.init.bind(this);
        this.destroy = this.destroy.bind(this);
        //
        this.setOpenMenuHandler = this.setOpenMenuHandler.bind(this);
        this.setCloseMenuHandler = this.setCloseMenuHandler.bind(this);
        this.setSwipeMenuHandler = this.setSwipeMenuHandler.bind(this);
        this.removeSwipeMenuHandler = this.removeSwipeMenuHandler.bind(this);
        //
        this.maybeCloseMenu = this.maybeCloseMenu.bind(this);
        this.toggleMenu = this.toggleMenu.bind(this);
        this.openMenu = this.openMenu.bind(this);
        this.closeMenu = this.closeMenu.bind(this);
        this.handleGesture = this.handleGesture.bind(this);
        this.onSwipeStart = this.onSwipeStart.bind(this);
        this.onSwipeEnd = this.onSwipeEnd.bind(this);
    }

    init() {
        if (!this.menu) {
            alert('Мобильное меню не добавлено в DOM-дерево!');
            return;
        }
        this.setOpenMenuHandler();
        this.setCloseMenuHandler();
    }

    destroy() {
        this.removeCloseMenuHandler();
        this.removeSwipeMenuHandler();
    }

    //
    setOpenMenuHandler() {
        this.burger.forEach((burger) => {
            burger.addEventListener('click', this.toggleMenu, false);
        })
    }

    removeOpenMenuHandler() {
        this.burger.forEach((burger) => {
            burger.addEventListener('click', this.toggleMenu, false);
        })
    }

    setCloseMenuHandler() {
        this.closeToggler.addEventListener('click', this.closeMenu, false);
        document.body.addEventListener('mouseup', this.maybeCloseMenu, false);
    }

    removeCloseMenuHandler() {
        this.closeToggler.removeEventListener('click', this.closeMenu, false);
        document.body.removeEventListener('mouseup', this.maybeCloseMenu, false);
    }

    setSwipeMenuHandler() {
        this.menu.addEventListener('touchstart', this.onSwipeStart, false);
        this.menu.addEventListener('touchend', this.onSwipeEnd, false);
    }

    removeSwipeMenuHandler() {
        this.menu.removeEventListener('touchstart', this.onSwipeStart, false);
        this.menu.removeEventListener('touchend', this.onSwipeEnd, false);
    }

    //
    maybeCloseMenu(e) {
        var t = e.target;
        var isBurgerClicked = false;

        this.burger.forEach(function (burger) {
            if (burger.isEqualNode(t) || burger.contains(t)) {
                isBurgerClicked = true;
            }
        });

        if (!this.menu.isEqualNode(t) && !isBurgerClicked && !this.menu.contains(t)) {
            this.closeMenu();
        }
    }

    toggleMenu() {
        if (this.menu.classList.contains('opened')) {
            this.closeMenu();
        } else {
            this.openMenu();
        }
    }

    openMenu() {
        this.burger.forEach((burger) => {
            burger.classList.add('clicked');
        })
        this.menu.classList.add('opened');
        this.setCloseMenuHandler();
        this.setSwipeMenuHandler();
    }

    closeMenu() {
        this.menu.classList.remove('opened');
        this.burger.forEach((burger) => {
            burger.classList.remove('clicked');
        })
        this.destroy();
    }

    handleGesture() {
        var moveX = (this.touchStats.startX - this.touchStats.endX);
        var moveY = Math.abs(this.touchStats.startY - this.touchStats.endY);
        if (moveX > moveY && moveX > 15) {
            this.closeMenu();
        }
    }

    onSwipeStart(e) {
        this.touchStats.startX = e.changedTouches[0].screenX;
        this.touchStats.startY = e.changedTouches[0].screenY;
    }

    onSwipeEnd(e) {
        this.touchStats.endX = e.changedTouches[0].screenX;
        this.touchStats.endY = e.changedTouches[0].screenY;
        this.handleGesture();
    }
}

window.MobileMenu = MobileMenu;