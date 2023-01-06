<a href="/sales" class="btn btn-secondary mx-4 mt-3">Back
    <i class="fa-sharp fa-solid fa-backward"></i>
</a>
<div class="main-block mb-5">


    <h1 class=" text-center opacity-75">Update Transactions</h1>


    <form>

        <div class="info">

            <input type="hidden" name="id" id="idItem">

            <label class="mb-2" for="text">Item</label>
            <input type="email" name="text" id="updateItem">

            <label class="mb-2" for="Quantity">Quantity</label>
            <input type="number" name="Quantity" id="updateQuantity" data-old="" max="" min="0" data-database="">

            <label class="mb-2" for="Price">Total Price (JOD)</label>
            <input type="number" name="Price" id="updatePrice" disabled>







            <button class="btn btn-success" id="update">Update</button>

    </form>
</div>

<div class="popup">
    <div class="popup-desian">
        <h2 class="done">Done!</h2>

        <p>You've successfully Edit Transaction !</p>

        <i class="i-done fa-sharp fa-solid fa-circle-check  btn-success"></i>
    </div>
</div>


<div class="popup-no">
    <div class="popup-desian">
        <h2 class="done">Not Done!</h2>

        <p>The item you wish to modify is not available in the required quantity !</p>
        <i class="i-no fa-sharp fa-solid fa-xmark btn-danger"></i>
        <button class="ok">OK!</button>
    </div>

</div>

<div class="popup-empty">
    <div class="popup-desian">
        <h2 class="done">Not Done!</h2>

        <p>You must fill in all fields !</p>
        <i class="i-no fa-sharp fa-solid fa-xmark btn-danger"></i>
        <button class="ok">OK!</button>
    </div>

</div>