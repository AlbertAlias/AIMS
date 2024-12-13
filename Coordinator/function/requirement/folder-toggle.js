function toggleIcon(element) { 
    if (element.classList.contains('fa-folder')) { 
        element.classList.remove('fa-folder'); element.classList.add('fa-folder-open'); 
    } else { 
        element.classList.remove('fa-folder-open'); element.classList.add('fa-folder'); 
    } 
}