<?php require_once "../includes/db.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <img src="../images/L.svg" id="logo" onclick="hideAll()">

    <button class="navbarbuttons" onclick="showSection('create')">Create</button>
    <button class="navbarbuttons" onclick="showSection('read')">Read</button>
    <button class="navbarbuttons" onclick="showSection('update')">Update</button>
    <button class="navbarbuttons" onclick="showSection('delete')">Delete</button>
</nav>

<!-- HOME -->
<section id="home" class="homecontent"> 
    <h1 class="splash">Welcome to Student Management System</h1>
    <h2 class="splash">A Project in Integrative Programming Technologies</h2>
</section>

<!-- CREATE -->
<section id="create" class="content">
    <h1 class="contenttitle">Insert New Student</h1>

    <form action="../includes/insert.php" method="POST">
        <label class="label">Surname</label>
        <input type="text" name="surname" class="field" required><br/>

        <label class="label">Name</label>
        <input type="text" name="name" class="field" required><br/>

        <label class="label">Middle name</label>
        <input type="text" name="middlename" class="field"><br/>

        <label class="label">Address</label>
        <input type="text" name="address" class="field"><br/>

        <label class="label">Mobile Number</label>
        <input type="text" name="contact" class="field"><br/>

        <div id="btncontainer">
            <button type="reset" class="btns">Clear Fields</button>
            <button type="submit" class="btns">Save</button>
        </div>

        <div id="success-toast" class="toast-hidden">
            Registration Successful!
        </div>
    </form>   
</section>

<!-- READ -->
<section id="read" class="content">
    <h1 class="contenttitle">View Students</h1>

        <?php
        $stmt = $pdo->query("SELECT * FROM students");
        $students = $stmt->fetchAll();
        ?>

        <table border="1" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Surname</th>
                <th>Name</th>
                <th>Middlename</th>
                <th>Address</th>
                <th>Contact</th>
            </tr>
            
            <?php foreach ($students as $s): ?>
                <tr> 
                    <td><?= $s['id'] ?></td>
                    <td><?= $s['surname'] ?></td>
                    <td><?= $s['name'] ?></td>
                    <td><?= $s['middlename'] ?></td>
                    <td><?= $s['address'] ?></td>
                    <td><?= $s['contact'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>        

</section>

<!-- UPDATE -->
<section id="update" class="content">
    <h1 class="contenttitle">Update Student Records</h1>

    <!-- Select ID -->
    <form method="GET">
        <label>Enter Student ID:</label>
        <input type="number" name="edit_id" required>
        <button type="submit">Load</button>
    </form>

    <?php
    if (isset($_GET['edit_id'])) {

        $id = $_GET['edit_id'];

        $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        $student = $stmt->fetch();

        if ($student):
    ?>

    <!-- UPDATE FORM -->
    <form action="../includes/update.php" method="POST">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">

        <label>Surname</label>
        <input type="text" name="surname" value="<?= $student['surname'] ?>"><br>

        <label>Name</label>
        <input type="text" name="name" value="<?= $student['name'] ?>"><br>

        <label>Middlename</label>
        <input type="text" name="middlename" value="<?= $student['middlename'] ?>"><br>

        <label>Address</label>
        <input type="text" name="address" value="<?= $student['address'] ?>"><br>

        <label>Contact</label>
        <input type="text" name="contact" value="<?= $student['contact'] ?>"><br>

        <button type="submit">Update</button>
    </form>

    <?php
        else:
            echo "Student not found.";
        endif;
    }
    ?>

</section>

<!-- DELETE -->
<section id="delete" class="content">
    <h1 class="contenttitle">Remove Student Records</h1>

         <form action="../includes/delete.php" method="POST">
        <label>Enter Student ID to Delete:</label>
        <input type="number" name="id" required>
        <button type="submit">Delete</button>
    </form>

</section>

<script src="script.js"></script>
</body>
</html>