function uploadFile(file) {
    const formData = new FormData();
    formData.append('profile_picture', file);

    fetch('../../controller/admin-profile/create-profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Parse JSON directly
    .then(data => {
        if (data.status === 'success') {
            alert('File uploaded successfully!');
        } else {
            console.error('Upload error:', data.message);
        }
    })
    .catch(error => {
        console.error('Upload error:', error);
    });
}
