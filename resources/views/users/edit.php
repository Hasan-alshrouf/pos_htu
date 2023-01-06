<a href="/users" class="btn btn-secondary mx-4 mt-3">Back
    <i class="fa-sharp fa-solid fa-backward"></i>
</a>
<div class="main-block mb-5">

    <div class="img_create">
        <h1 class=" text-center opacity-75">Update User</h1>
    </div>

    <form action="/users/update " method="POST">
        <input type="hidden" name="id" value="<?= $data->user_one->id ?>">
        <div class="info">

            <label class="mb-2" for="email">Email</label>
            <input type="email" name="email" placeholder="Email" value="<?= $data->user_one->email ?>" required>

            <label class="mb-2" for="username">Username</label>
            <input type="text" name="username" placeholder="Username" value="<?= $data->user_one->username ?>" required>

            <label class="mb-2" for="display-name">Display Name</label>
            <input type="text" name="display_name" placeholder="Display Name"
                value="<?= $data->user_one->display_name ?>" required>

            <label class="mb-2" for="phone">Phone</label>
            <input type="tel" name="phone" placeholder="Phone" value="<?= $data->user_one->phone ?>">



            <label for="user-role  " class="form-label ">Role</label>
            <select class="form-select w-50" aria-label="Role" name="role" required>
                <option value="">Please choose an option</option>
                <option value="admin">Admin</option>
                <option value="seller">Seller</option>
                <option value="accountant">Accountant</option>
                <option value="procurement">procurement</option>

            </select>







            <button type="submit" class="button">Update</button>
    </form>

</div>



<?php if (!empty($_SESSION) && isset($_SESSION['user']['create_users']) && !empty($_SESSION['user']['create_users'])) : ?>

<div class="popup-no-create">
    <h2 class="done">Not Done!</h2>
    <div class="popup-desian">
        <p> <?= $_SESSION['user']['create_users'] ?></p>
        <i class="i-no fa-sharp fa-solid fa-xmark btn-danger"></i>
        <button class="ok">OK!</button>
    </div>
</div>
<?php
$_SESSION['user']['create_users'] = null;
endif; 
?>