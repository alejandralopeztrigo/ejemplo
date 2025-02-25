<?php

    $servidor = "mysql";
    $usuario = "root";
    $password = "root";
    $base_datos = "todo_app";

    $conn = mysqli_connect($servidor, $usuario, $password, $base_datos);

    if (!$conn) {
      die("Error de conexión: " . mysqli_connect_error());
  }

  if(isset($_POST['add'])) {
   
    $task = $_POST['task'];
    
    if(!empty($task)) {

        $task = mysqli_real_escape_string($conn, $task);
        $sql = "INSERT INTO tasks (task) VALUES ('$task')";
        
        if(mysqli_query($conn, $sql)) {
            header("Location: index.php");
        } else {
            echo "Error al agregar la tarea: " . mysqli_error($conn);
        }
    }
  }

  if(isset($_POST['complete'])) {

    $id = $_POST['complete'];
    $sql = "DELETE FROM tasks WHERE id = $id";
    
    if(mysqli_query($conn, $sql)) {
      header("Location: index.php");
    } else {
        echo "Error al eliminar la tarea: " . mysqli_error($conn);
    }
  }

  $sql = "SELECT * FROM tasks ORDER BY id ASC";

  $result = mysqli_query($conn, $sql);

  $tasks = $result;
    // while(!empty(mysqli_fetch_assoc($result))) {
    //     $tasks[] = $row;
    // }


?>
  

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>TO DO LIST</title>
</head>
<body>
  <div class="container">
        <h1>THINGS TO DO:</h1>
        <form method="POST" action="index.php">
          <label for="title">To-do</label>
            <input type="text" id="task" name="task" placeholder="New task" required>
            <button type="submit" name= "add" id="add_btn">Add</button>
        </form>
        <ul>
        <?php foreach ($tasks as $task): ?>
                <li>
                    <?php if ($task['complete']): ?>
                        <span><?php echo htmlspecialchars($task['task']); ?></span>
                    <?php else: ?>
                        <span><?php echo htmlspecialchars($task['task']); ?></span>
                        <form method="post" style="display:inline;">
                            <button type="submit" name="complete" value="<?php echo htmlspecialchars($task['id']); ?>">
<<<<<<< HEAD
                                12321321321321321
=======
                                Completados
>>>>>>> feature/KS-12345
                            </button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
    </ul>
    </div>
</body>
</html>

 