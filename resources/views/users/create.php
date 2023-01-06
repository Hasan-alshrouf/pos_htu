<a href="/users" class="btn btn-secondary mx-4 mt-4">Back
    <i class="fa-sharp fa-solid fa-backward"></i>
</a>
<div class="main-block mb-5">

    <div class="img_create">
        <h1 class=" text-center opacity-75">Create New User</h1>
    </div>

    <form action="/users/store " method="POST">
        <div class="info">
            <input class="Email" type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="display_name" placeholder="Display Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="tel" name="phone" placeholder="Phone">

            <label for="user-role  " class="form-label ">Role</label>
            <select class="form-select w-50" aria-label="Role" name="role" required>
                <option value="">Please choose an option</option>
                <option value="admin">Admin</option>
                <option value="seller">Seller</option>
                <option value="accountant">Accountant</option>
                <option value="procurement">procurement</option>

            </select>

            <button type="submit" class="button">Create</button>
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