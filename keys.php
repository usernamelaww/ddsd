<!-- keys.php -->

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Key Management</title>
</head>
<body>
    <h1>Key Management</h1>
    <input type="text" id="key" placeholder="Enter key">
    <input type="datetime-local" id="expires_at">
    <button onclick="createKey()">Create Key</button>
    <h2>All Keys</h2>
    <ul id="keyList"></ul>

    <script>
        function createKey() {
            const key = document.getElementById('key').value;
            const expires_at = document.getElementById('expires_at').value;
            fetch('create_key.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({key: key, expires_at: expires_at}),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                loadKeys();
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        function deleteKey(keyId) {
            fetch('delete_key.php?key_id=' + keyId, {
                method: 'DELETE',
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                loadKeys();
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        function loadKeys() {
            fetch('get_keys.php')
            .then(response => response.json())
            .then(data => {
                const keyList = document.getElementById('keyList');
                keyList.innerHTML = '';
                data.forEach(key => {
                    const li = document.createElement('li');
                    li.textContent = key.key + ' (Expires at: ' + key.expires_at + ') ';
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.onclick = () => deleteKey(key.id);
                    li.appendChild(deleteButton);
                    keyList.appendChild(li);
                });
            });
        }

        window.onload = loadKeys;
    </script>
</body>
</html>
