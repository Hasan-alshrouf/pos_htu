<div id="template" class="row  ">

    <div class="col-3 ">
        <div class="img">
            <?php if (empty($data->user_one->picture)) : ?>
            <img src="/resources/img/168882.png" alt="">
            <?php else : ?>
            <img src="<?= $_SERVER['REQUEST_SCHEME'] ."://" . $_SERVER['HTTP_HOST'] ?>/resources/img/<?= $data->user_one->picture ?>"
                alt="">
            <?php endif;  ?>
        </div>

    </div>
    <div class="col">
        <div class="mt-5 d-flex flex-row-reverse gap-3">
            <a href="/users/edit?id=<?= $data->user_one->id ?>" class="btn btn-warning">
                Edit <i class="fa-sharp fa-solid fa-user-pen"></i></a>
            <a href="/users/delete?id=<?= $data->user_one->id ?>" class="btn btn-danger">
                Delete <i class="fa-sharp fa-solid fa-user-xmark"></i>
            </a>


            <a href="/users" class="btn btn-secondary">Back
                <i class="fa-sharp fa-solid fa-backward"></i>
            </a>
        </div>
        <table class="table table-hover mx-3">
            <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>id</td>
                    <td><?= $data->user_one->id ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= $data->user_one->email ?></td>
                </tr>
                <tr>
                    <td>Display Name</td>
                    <td><?=  $data->user_one->display_name ?></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td><?=  $data->user_one->permissions ?></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><?=$data->user_one->username ?></td>
                </tr>
                <tr>
                    <td>Created_at</td>
                    <td><?= $data->user_one->created_at ?></td>
                </tr>


            </tbody>
        </table>
    </div>
</div>