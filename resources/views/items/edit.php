<a href="/items" class="btn btn-secondary mx-4 mt-5">Back
    <i class="fa-sharp fa-solid fa-backward"></i>
</a>
<div class="main-block mt-3 mb-5">

    <!-- <div class="img_create"> -->
    <h1 class=" text-center opacity-75 mt-4">Update Item</h1>
    <!-- </div> -->

    <form action="/items/update " method="POST">
        <input type="hidden" name="id" value="<?= $data->item_one->id ?>">
        <div class="info mb-3">
            <label class="mb-2" for="name">Name</label>
            <input type="text" name="name" value="<?= $data->item_one->name ?>" required>

            <label class="mb-2" for="cost">Cost</label>
            <input type="number" name="cost" value="<?= $data->item_one->cost ?>" required>

            <label class="mb-2" for="selling_price">Selling Price </label>
            <input type="number" name="selling_price" value="<?= $data->item_one->selling_price ?>" required>

            <label class="mb-2" for="quantity">Quantity </label>
            <input type="number" name="quantity" value="<?= $data->item_one->quantity ?>" required>

            <label class="mb-2" for="Description">Description </label>
            <textarea class="form-control bg-black mt-3 mb-3 text-light" rows="2"
                name="Description"><?= $data->item_one->Description ?></textarea>


            <button type="submit" class="button">Create</button>
    </form>
</div>

<?php if (!empty($_SESSION) && isset($_SESSION['item']['create_items']) && !empty($_SESSION['item']['create_items'])) : ?>


<div class="popup-no-create">
    <h2 class="done">Not Done!</h2>
    <div class="popup-desian">
        <p> <?= $_SESSION['item']['create_items'] ?></p>
        <i class="i-no fa-sharp fa-solid fa-xmark btn-danger"></i>
        <button class="ok">OK!</button>
    </div>
</div>
<?php
$_SESSION['item']['create_items'] = null;
endif; 
?>