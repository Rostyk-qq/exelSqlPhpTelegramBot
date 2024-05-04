<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Users List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="clean-switch-master/clean-switch.css">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="custom-font" id="page">
  <div class="container bg-white d-flex flex-column my-5 py-5 border rounded" id="page__table-container">
    <b>Users</b>
    <div class="col-3 d-flex" id="container__top-content">
      <button id="content__button-add" type="button" class="btn btn-primary shadow-none custom-font" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</button>
      <div class="dropdown">
        <button class="btn border dropdown-toggle custom-font px-2" type="button" data-bs-toggle="dropdown" aria-expanded="true">
          --Select Please--
        </button>
        <ul class="dropdown-menu custom-font">
          <li class="px-1"><button class="dropdown-item rounded" type="button">--Select Please--</button></li>
          <li class="px-1"><button class="dropdown-item rounded" type="button">Set Active</button></li>
          <li class="px-1"><button class="dropdown-item rounded" type="button">Set not Active</button></li>
          <li class="px-1"><button class="dropdown-item rounded" type="button">Delete</button></li>
        </ul>
      </div>
      <button id="content__button-select" type="submit" class="btn btn-primary shadow-none custom-font">Ok</button>
    </div>
    <br>
    <table id="container__table" class="table table-bordered m-0 p-0">
      <thead>
      <tr>
        <th>
          <input class="form-check-input shadow-none fs-6" type="checkbox" value="1">
        </th>
        <th>Name</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody id="users_list">
        <?php
            $server = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'users_db';

            $conn = new mysqli($server, $username, $password, $dbname);

            if ($conn->connect_error) {
                die('Connect Error: ' . $conn->connect_error);
            }

            $select = "SELECT * FROM users";
            $result = $conn->query($select);

            if (!$result) {
                die('Query Error: ' . $conn->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
            <td>
                <input class='form-check-input shadow-none fs-6 table_checkbox-child' type='checkbox' id='table_checkbox-child'>
            </td>
            <td>{$row['firstname']}</td>
            <td>{$row['secondname']}</td>
            <td class='position-relative p-0'>";

            if ($row['status'] === "Active") {
                echo "<span class='bg-success rounded-circle d-inline-block p-2 m-0 position-absolute top-50 start-50 translate-middle'></span>";
            } else {
                echo "<span class='bg-gray rounded-circle d-inline-block p-2 m-0 position-absolute top-50 start-50 translate-middle'></span>";
            }

            echo "</td>
                <td class='d-flex align-items-center justify-content-center border-start-0'>
                    <button data-bs-toggle='modal' data-bs-target='#staticBackdrop' class='px-1 rounded-start border-end-0 border-1 border bg-white border-black-50 fw-bolder text-black-50 p-0' id='table__btn-edit'>
                        Edit
                    </button>
                    <button class='px-1 rounded-end border-1 border border-black-50 bg-white text-black-50 p-0 table__btn-remove' id='table__btn-remove'>
                        <i class='fa fa-trash'></i>
                    </button>
                </td>
            </tr>";
            }

            $conn->close();
        ?>
        
      </tbody>
    </table>
    <br>
    <div class="col-3 d-flex" id="container__bottom-content">
      <button type="button" class="btn btn-primary shadow-none custom-font">Add</button>
      <div class="dropdown">
        <button class="btn border dropdown-toggle custom-font px-2" type="button" data-bs-toggle="dropdown" aria-expanded="true">
          --Select Please--
        </button>
        <ul class="dropdown-menu custom-font">
          <li class="px-1"><button class="dropdown-item rounded" type="button">--Select Please--</button></li>
          <li class="px-1"><button class="dropdown-item rounded" type="button">Set Active</button></li>
          <li class="px-1"><button class="dropdown-item rounded" type="button">Set not Active</button></li>
          <li class="px-1"><button class="dropdown-item rounded" type="button">Delete</button></li>
        </ul>
      </div>
      <button type="submit" class="btn btn-primary shadow-none custom-font">Ok</button>
    </div>

    <!-- Modal -->
    <div class="modal display-block" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog" id="modal-dialog">
        <div class="modal-content" id="modal-content">
          <div class="modal-header" id="modal-header">
            <h1 class="modal-title fs-5"></h1>
            <button type="button" class="btn-close button-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div id="modal-body" class="modal-body d-flex flex-column fs-6">
            <!-- form -->
            <form id="form">
              <label for="modal_first-name">First name</label><br>
              <input name="firstname" class="border py-1 px-2 custom-outline-none w-100" id="modal_first-name" type="text">
              <br>
              <br>
              <label for="modal_last-name">Last name</label><br>
              <input name="secondname" class="border py-1 px-2 w-100" id="modal_last-name" type="text">
              <br>
              <br>
              <label class="cl-switch cl-switch-large cl-switch-white">
                <label for="modal_switch">Status</label>
                <br>
                <input name="status" data-toggle="toggle" class="update_modal_switch" id="modal_switch" type="checkbox">
                <span class="switcher"></span>
              </label>
              <br>
              <br>
              <label for="modal_select">Role</label>
              <div id="modal_select" class="dropdown update-modal_select">
                <select name='role' class="form-select" aria-label="Default select example">
                  <option value="" selected>--Select Please--</option>
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                </select>
              </div>
              <br>
              <br>
              <div class="modal_footer text-end" >
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="footer_button-add" type="submit" class="btn btn-primary"></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<style>
  .custom-font {
    font-family: 'Mulish', sans-serif;
    font-size: 15px;
  }
  .back{
    background-color: aliceblue;
  }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="./script.js" defer></script>
</body>
</html>


