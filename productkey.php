<?php
    session_start();
    if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "admin") {
        header("Location: login.php");
        exit();
    }
?>
<?php
include 'connection.php'; // Ensure your database connection is included

// Fetch data from the database
$sql = "SELECT part_number, part_name FROM product_list";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>admin Dashboard</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.7.2-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
    <style>
        ::after,
        ::before {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        h1 {
            font-weight: 600;
            font-size: 1.5rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            display: flex;
        }

        .main {
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            transition: all 0.35s ease-in-out;
            background-color: #fafbfe;
        }

        #sidebar {
            width: 70px;
            min-width: 70px;
            z-index: 1000;
            transition: all .25s ease-in-out;
            background-color: #0e2238;
            display: flex;
            flex-direction: column;
        }

        #sidebar.expand {
            width: 260px;
            min-width: 260px;
        }

        .toggle-btn {
            background-color: transparent;
            cursor: pointer;
            border: 0;
            padding: 1rem 1.5rem;
        }

        .toggle-btn i {
            font-size: 1.5rem;
            color: #FFF;
        }

        .sidebar-logo {
            margin: auto 0;
        }

        .sidebar-logo a {
            color: #FFF;
            font-size: 1.15rem;
            font-weight: 600;
        }

        #sidebar:not(.expand) .sidebar-logo,
        #sidebar:not(.expand) a.sidebar-link span {
            display: none;
        }

        .sidebar-nav {
            padding: 2rem 0;
            flex: 1 1 auto;
        }

        a.sidebar-link {
            padding: .625rem 1.5rem;
            color: #FFF;
            display: block;
            font-size: 0.9rem;
            white-space: nowrap;
            border-left: 3px solid transparent;
        }

        .sidebar-item, .sidebar-footer {
            position: relative;
        }

        .sidebar-link i {
            font-size: 1.2rem;
            color: white;
            margin-right: 10px;
        }

        a.sidebar-link:hover {
            background-color: rgba(255, 255, 255, .075);
            border-left: 3px solid #3b7ddd;
        }

        .sidebar-item {
            position: relative;
        }

        #sidebar:not(.expand) .sidebar-link span {
            display: none;
            position: absolute;
            left: 80px;
            top: 50%;
            transform: translateY(-50%);
            background: #0e2238;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 0.85rem;
            white-space: nowrap;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        #sidebar:not(.expand) .sidebar-item:hover .sidebar-link span,
        #sidebar:not(.expand) .sidebar-footer:hover .sidebar-link span {
            display: block;
        }

        .sidebar-item, .sidebar-footer {
            position: relative;
        }
    </style>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">LOGO</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="admin_dashboard.php" class="sidebar-link">
                    <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="ncprfiling.php" class="sidebar-link">
                    <i class="fa-regular fa-folder-open"></i>
                        <span>NCPR Filing</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="ncprlist.php" class="sidebar-link">
                    <i class="fa-regular fa-address-card"></i>
                        <span>NCPR List</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="productkey.php" class="sidebar-link">
                        <i class="fa-solid fa-helmet-safety"></i>
                        <span>Product Key</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="status.php" class="sidebar-link">
                        <i class="fa-solid fa-paperclip"></i>
                        <span>Status</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="setting.php" class="sidebar-link">
                        <i class="fa-solid fa-gear"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
        <div class="container mt-4">
        <h2>Product Key Table</h2>
        <!-- Button to Open Modal -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
        <table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Part Number</th>
            <th>Part Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['part_number']); ?></td>
                <td><?= htmlspecialchars($product['part_name']); ?></td>
                <td>
                    <button class="btn btn-warning btn-sm edit-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#editProductModal"
                        data-id="<?= htmlspecialchars($product['part_number']); ?>"
                        data-name="<?= htmlspecialchars($product['part_name']); ?>">
                        Edit
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php if (empty($products)): ?>
            <tr><td colspan="3" class="text-center">No products found</td></tr>
        <?php endif; ?>
    </tbody>
</table>


    </div>
        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_product.php" method="POST">
                        <div class="mb-3">
                            <label for="part_number" class="form-label">Part Number</label>
                            <input type="text" class="form-control" id="part_number" name="part_number" required>
                        </div>
                        <div class="mb-3">
    <label for="part_name" class="form-label">Part Name</label>
    <input type="text" class="form-control" id="part_name" name="part_name" required>
</div>

                        <button type="submit" class="btn btn-success">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="update_product.php" method="POST">
                    <div class="mb-3">
                        <label for="edit_part_number" class="form-label">Part Number</label>
                        <input type="text" class="form-control" id="edit_part_number" name="part_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_part_name" class="form-label">Part Name</label>
                        <input type="text" class="form-control" id="edit_part_name" name="part_name" required>
                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function () {
            let partNumber = this.getAttribute("data-id");
            let partName = this.getAttribute("data-name");

            // Populate modal fields
            document.getElementById("edit_part_number").value = partNumber;
            document.getElementById("edit_part_name").value = partName;
        });
    });
});

    </script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    
</body>
</html>