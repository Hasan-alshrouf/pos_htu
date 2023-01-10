<div id="template" class="row mx-2 ">

    <div class="col-lg-3 col-md-3 ">
        <div class="img">
            <?php if (empty($data->user_one->picture)) : ?>
            <img src="/resources/img/168882.png" alt="">
            <?php else : ?>
            <img src="<?= $_SERVER['REQUEST_SCHEME'] ."://" . $_SERVER['HTTP_HOST'] ?>/resources/img/<?= $data->user_one->picture ?>"
                alt="">
            <?php endif;  ?>
        </div>

    </div>
    <div class="col-lg-9 col-md-12 col-sm-12">
        <div class="mt-5 mb-2 d-flex flex-row-reverse gap-3">


            <a class="btn btn-danger Edit-Profile">Edit Profile
                <i class="fa-sharp fa-solid fa-user-gear"></i>
            </a>
            <a href="/dashboard" class="btn btn-secondary">Back
                <i class="fa-sharp fa-solid fa-backward"></i>
            </a>
        </div>
        <table class="table table-hover mx-3">
            <thead class="table-dark fs-5">
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>

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
                <tr>
                    <td>Phone</td>
                    <td><?= $data->user_one->phone?></td>
                </tr>


            </tbody>
        </table>
    </div>
</div>




<div class="row profile d-flex align-items-end d-none ">
    <div class="mt-2  ">


        <a href="/profile" class="btn btn-secondary">Back
            <i class="fa-sharp fa-solid fa-backward"></i>
        </a>
    </div>
    <div class="mt-3 text-center">
        <h2 class="text-right font-monospace text-decoration-underline">Profile Settings</h2>
    </div>
    <div class="col-md-4 col-sm-2 ">
        <form action="/profile/update/picture" method="POST" enctype="multipart/form-data">

            <div class="container">

                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="picture">
                        <label for="imageUpload"></label>
                    </div>

                    <div class="avatar-preview ">
                        <div class="img ">
                            <?php if (empty($data->user_one->picture)) : ?>
                            <img src="/resources/img/168882.png" alt="">
                            <?php else : ?>
                            <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" .$_SERVER['HTTP_HOST'] ?>/resources/img/<?= $data->user_one->picture ?>"
                                alt="">
                            <?php endif;  ?>

                        </div>
                        <div class="save_picter"><button class="btn btn-dark rounded-pill  profile-button"
                                type="submit">Save Photo
                                <i class="fa-sharp fa-solid fa-circle-check"></i>
                            </button></div>
                    </div>


                </div>

            </div>

        </form>
    </div>

    <div class="col-md-6 col-sm-3   ">
        <form action="/profile/update" method="POST">
            <input type="hidden" name="id" value="<?= $data->user_one->id ?>">
            <div class="container  py-5">

                <div class="row mt-2">
                    <div class="col-md-6 col-sd-2"><label class="labels">Username</label><input type="text" required
                            class="form-control" name="username" value="<?=$data->user_one->username ?>"></div>
                    <div class="col-md-6 col-sd-2"><label class="labels">Display Name</label><input type="text" required
                            name="display_name" class="form-control" value="<?=  $data->user_one->display_name ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 col-sd-6"><label class="labels">Email</label><input type="email" required
                            class="form-control" c name="email" value="<?= $data->user_one->email ?>"></div>
                    <div class="col-md-12 col-sd-6"><label class="labels">Phone</label><input type="tel"
                            class="form-control" name="phone" value="<?=$data->user_one->phone ?>"></div>

                    <div class="mt-5 text-center"><button class="btn btn-secondary profile-button" type="submit">Save
                            Profile</button></div>
                </div>
            </div>
        </form>

    </div>

</div>