// Función para manejar el estado del sidebar
document.addEventListener('alpine:init', () => {
    // Inicializar el estado del sidebar desde localStorage o usar true por defecto
    const sidebarState = localStorage.getItem('sidebarOpen');
    const initialSidebarState = sidebarState ? JSON.parse(sidebarState) : true;

    // Inicializar el estado de los submenús
    const submenusState = localStorage.getItem('submenus');
    const initialSubmenusState = submenusState ? JSON.parse(submenusState) : {
        ubicaciones: false,
        educacion: false
    };

    // Inicializar Alpine.js con el estado guardado
    Alpine.store('sidebar', {
        open: initialSidebarState,
        submenus: initialSubmenusState,
        activeSubmenu: null,
        
        toggle() {
            this.open = !this.open;
            localStorage.setItem('sidebarOpen', this.open);
        },
        
        toggleSubmenu(submenu) {
            if (this.activeSubmenu === submenu) {
                this.activeSubmenu = null;
            } else {
                this.activeSubmenu = submenu;
            }
        },
        
        toggleSubmenuState(key) {
            this.submenus[key] = !this.submenus[key];
            localStorage.setItem('submenus', JSON.stringify(this.submenus));
        }
    });
});
