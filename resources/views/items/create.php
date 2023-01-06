<a href="/items" class="btn btn-secondary mx-4 mt-5">Back
    <i class="fa-sharp fa-solid fa-backward"></i>
</a>
<div class="main-block mt-3 mb-5">

    <!-- <div class="img_create"> -->
    <h1 class=" text-center opacity-75 mt-4">Create New Item</h1>
    <!-- </div> -->

    <form action="/items/store " method="POST">

        <div class="info mb-3">

            <input type="text" name="name" placeholder="Name" required>
            <input type="number" name="cost" placeholder="Cost" required>
            <input type="number" name="selling_price" placeholder="Selling Price " required>
            <input type="number" name="quantity" placeholder="Quantity" required>
            <textarea class="form-control bg-black mt-3 mb-3 text-light" rows="2" name="Description"
                placeholder="Description"></textarea>




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