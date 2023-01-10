<div class="row d-flex justify-content-center user-contorllers">
    <div class="col-xl-3 col-lg-6  col-md-6 col-sm-12  ">
        <div class="card l-bg-blue-dark">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                <div class="mb-4  text-center">
                    <h5 class="card-title mb-0">All Users</h5>
                </div>
                <div class="card-count-number">
                    <h2 class=" text-center">
                        <?= $data->count ?>
                    </h2>
                </div>

            </div>
        </div>

    </div>
    <form method="GIT" action="./user/find">


        <div class="search_user input-group  w-50  m-sm-auto ">
            <input type="text" class="form-control" placeholder="Search for a user by username"
                aria-label="Recipient's username" aria-describedby="button-addon2" name="username">
            <button class="btn btn-outline-primary" type="submit" id="button-addon2 ">Sehrch</button>
        </div>


        <?php if (!empty($_SESSION) && isset($_SESSION['user']['not_find_user']) && !empty($_SESSION['user']['not_find_user'])) : ?>

        <div class="error  ">
            <?= $_SESSION['user']['not_find_user'] ?>
        </div>
        <?php
$_SESSION['user']['not_find_user'] = null;
endif; 
?>
    </form>
</div>



<div class="col-lg-11 col-md-11 m-md-auto mb-sm-5 top-five mx-2">
    <div class="d-flex justify-content-between align-items-end mb-3 ">
        <caption>List Of Users </caption>
        <a href="/users/create" class="btn btn-secondary "><i class="fa-sharp fa-solid fa-plus"></i> Add New
            User</a>

    </div>
    <div style="overflow-x:auto;">
        <table class="table  table-hover">
            <thead class="table-primary fs-5">
                <tr>
                    <th scope="col">Num</th>
                    <th scope="col">Email</th>
                    <th scope="col">Display Name</th>
                    <th scope="col">Username</th>

                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $id = 0;
                foreach ($data->users as $user):
                    $id++;
                ?>
                <tr>

                    <td><?= $id ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->display_name ?></td>
                    <td><?= $user->username ?></td>

                    <td>
                        <a href="./user?id=<?= $user->id ?>">
                            <i class="fa-sharp fa-solid fa-eye text-dark mx-2"></i></a>

                        <a href="/users/edit?id=<?= $user->id ?>">
                            <i class="fa-sharp fa-solid fa-user-pen text-info mx-2"></i></a>
                        <a href="/users/delete?id=<?= $user->id ?>">
                            <i class="fa-sharp fa-solid fa-user-xmark text-danger mx-2"></i>
                        </a>
                    </td>


                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>