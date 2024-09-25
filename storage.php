<?php
// Menyertakan file koneksi database
include 'koneksi.php';

// Inisialisasi pesan 
$message = "";

// Proses Tambah, Update, dan Delete
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $id_storage = $_POST['id_storage']; 
        $nama_gudang = $_POST['nama_gudang'];

        // Query Insert Data
        $sql = "INSERT INTO storage (id_storage, nama_gudang ) VALUES ('$id_storage', '$nama_gudang')";

        if ($conn->query($sql) === TRUE) {
            $message = "Data storage berhasil ditambahkan.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }

    if (isset($_POST['update'])) {
        $id_storage = $_POST['id_storage'];
        $nama_gudang = $_POST['nama_gudang'];

        // Query Update Data
        $sql = "UPDATE storage SET nama_gudang='$nama_gudang' WHERE id_storage='$id_storage'";

        if ($conn->query($sql) === TRUE) {
            $message = "Data storage berhasil diupdate.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }

    if (isset($_POST['delete'])) {
        $id_storage = $_POST['id_storage'];

        // Query Delete Data
        $sql = "DELETE FROM storage WHERE id_storage='$id_storage'";

        if ($conn->query($sql) === TRUE) {
            $message = "Data storage berhasil dihapus.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Storage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTTXABKZ8d2e5xWmN1xXm+7/1+g1jZV5gO6j+P0Q1Y9DhV+4vEacX8IYdf1Rhx4ILkxY72V4sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Dasboard.css"> <!-- Sesuaikan dengan file CSS Anda -->
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 18px;
            transition: background 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            border-radius: 4px;
        }

        .sidebar ul li a i {
            margin-right: 15px;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 250px;
            padding: 40px;
            width: calc(100% - 250px);
        }

        .main-content header {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 40px;
            color: #343a40;
        }

        /* Message Styles */
        .message {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        /* Form Styles */
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .form-container h2 {
            margin-bottom: 25px;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
            color: #495057;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #80bdff;
        }

        .form-group button {
            padding: 12px 20px;
            background-color: #28a745;
            border: none;
            color: #fff;
            font-size: 18px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-group button:hover {
            background-color: #218838;
        }

        /* Table Styles */
        .table-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        table thead {
            background-color: #343a40;
            color: #fff;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Action Buttons Styles */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons form {
            display: inline;
        }

        .action-buttons button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .action-buttons .edit-button {
            background-color: #007bff;
        }

        .action-buttons .edit-button:hover {
            background-color: #0069d9;
        }

        .action-buttons .delete-button {
            background-color: #dc3545;
        }

        .action-buttons .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="Dasboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="inventory.php"><i class="fas fa-chalkboard-teacher"></i> Inventory</a></li>
            <li><a href="storage.php"><i class="fas fa-building"></i> Storage</a></li>
            <li><a href="vendor.php"><i class="fas fa-user-graduate"></i> Vendor</a></li>
           
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>Data Storage</header>

        <!-- Display Message -->
        <?php if(!empty($message)): ?>
            <div class="message">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Data Jurusan -->
        <div class="form-container">
            <h2>Tambah Data Storage</h2>
            <form action="storage.php" method="POST">
                <div class="form-group">
                    <label for="id_storage">ID storage</label>
                    <input type="text" id="id_storage" name="id_storage" required>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="nama_gudang" name="nama_gudang" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Tambah Storage</button>
                </div>
            </form>
        </div>

        
        <!-- Tabel Data Jurusan -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID Storage</th>
                        <th>Nama Barang</th>
                        <th>Nama Gudang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data dari tabel jurusan
                    $sql = "SELECT * FROM storage";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0):
                        while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $row['id_storage']; ?></td>
                        <td><?= $row['nama_gudang']; ?></td>
                        <td><?= $row['lokasi_gudang']; ?></td>
                        <td>
                            <div class="action-buttons">
                                <!-- Edit Button -->
                                <form action="storage.php" method="POST">
                                    <input type="hidden" name="id_storage" value="<?= $row['id_storage']; ?>">
                                    <input type="hidden" name="nama_gudang" value="<?= $row['nama_gudang']; ?>">
                                    <button type="button" class="edit-button" onclick="openEditModal('<?= $row['id_storage']; ?>', '<?= $row['nama_gudang']; ?>')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </form>
                                <!-- Delete Button -->
                                <form action="storage.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <input type="hidden" name="id_storage" value="<?= $row['id_storage']; ?>">
                                    <button type="submit" name="delete" class="delete-button">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="3">Tidak ada data storage ditemukan.</td>
                    </tr>
                    <?php
                    endif;
                    // Menutup koneksi database
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit Jurusan -->
    <div id="editModal" style="display: none;">
        <div style="position: fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5);">
            <div style="background-color: #fff; width: 500px; margin: 100px auto; padding: 30px; border-radius: 6px; position: relative;">
                <h2>Edit Data Storage</h2>
                <form action="storage.php" method="POST">
                    <div class="form-group">
                        <label for="edit_id_jurusan">ID Storage</label>
                        <input type="text" id="edit_id_jurusan" name="id_storage" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama_jurusan">Nama Gudang</label>
                        <input type="text" id="edit_nama_jurusan" name="nama_gudang" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update">Update Jurusan</button>
                        <button type="button" onclick="closeEditModal()" style="background-color: #6c757d; margin-left: 10px;">Batal</button>
                    </div>
                </form>
                <span onclick="closeEditModal()" style="position: absolute; top: 10px; right: 20px; cursor: pointer; font-size: 24px;">&times;</span>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Modal Edit -->
    <script>
        function openEditModal(id, name) {
            document.getElementById('edit_id_jurusan').value = id;
            document.getElementById('edit_nama_jurusan').value = name;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>

</body>
</html>
