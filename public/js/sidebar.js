function toggleSidebar(){
    let sidebar = document.getElementById("sidebar");
    let sidebarOverlay = document.getElementById("sidebar-overlay");

    if(sidebar.classList.contains('sidebar-active')){
        sidebar.classList.remove('sidebar-active');
        sidebar.classList.add('sidebar-inactive');
        sidebarOverlay.classList.remove('sidebar-overlay-active');
        sidebarOverlay.classList.add('sidebar-overlay-inactive');
    }
    else{
        sidebar.classList.remove('sidebar-inactive');
        sidebar.classList.add('sidebar-active');
        sidebarOverlay.classList.remove('sidebar-overlay-inactive');
        sidebarOverlay.classList.add('sidebar-overlay-active');
    }
}

document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.btn-toggle-sidebar, .toggle-sidebar').forEach(function(button){
        button.addEventListener('click', function(){
            toggleSidebar();
        });
    });
});