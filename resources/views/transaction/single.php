<div id="template" class="row py-2">

    <?php foreach ($data->transactions_one as $transaction) :


           $date1 = new \DateTime($transaction->created_att);
           $date = new \DateTime($transaction->udpated_att);
           $created_att = $date1->format('d/m/y');
           $udpated_att = $date->format('d/m/y');
        ?>
    <div class="col">
        <div class="mt-5 d-flex flex-row-reverse gap-3">

            <a href="/accountant/delete?id=<?= $transaction->transactions_id  ?>" class="btn btn-danger">
                Delete
            </a>
            <a href="/accountant" class="btn btn-secondary">Back
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
                    <td>Item Name </td>
                    <td><?= $transaction->name ?></td>
                </tr>
                <tr>
                    <td>Sold By</td>
                    <td><?=  $transaction->display_name?></td>
                </tr>
                <tr>
                    <td>Item Cost </td>
                    <td><?=$transaction->cost ?></td>
                </tr>
                <tr>
                    <td>Item Selling Price </td>
                    <td><?=$transaction->selling_price ?></td>
                </tr>
                <tr>
                    <td>Quantity Sold</td>
                    <td><?= $transaction->quntity_item ?></td>
                </tr>
                <tr>
                    <td>Total Price </td>
                    <td><?= $transaction->total ?>

                    </td>
                </tr>

                <tr>
                    <td>Created_at</td>
                    <td><?=$created_att?></td>
                </tr>
                <tr>
                    <td>Updated_at</td>
                    <td><?= $udpated_att?></td>
                </tr>

            </tbody>

        </table>
        <form action="/accountant/update " method="POST">
            <input type="hidden" name="id" value="<?= $transaction->transactions_id  ?>">
            <div class="input-group my-3 w-25 ms-auto bg-black ">
                <input type="number" class="form-control" placeholder="Change Total Price"
                    min="<?= $transaction->selling_price ?>" aria-label="Recipient's username"
                    aria-describedby="basic-addon2" name="total" required>

                <button type="submit" class="btn btn-dark">Edit Total Price</button>

            </div>
        </form>

        <?php endforeach; ?>
    </div>


    <?php if (!empty($_SESSION) && isset($_SESSION['transaction']['Edit_Total_Price']) && !empty($_SESSION['transaction']['Edit_Total_Price'])) : ?>
    <div class="popup-no-create">
        <h2 class="done">Not Done!</h2>
        <div class="popup-desian">
            <p> <?= $_SESSION['transaction']['Edit_Total_Price'] ?></p>
            <i class="i-no fa-sharp fa-solid fa-xmark btn-danger"></i>
            <button class="ok">OK!</button>
        </div>
    </div>
    <?php
   $_SESSION['transaction']['Edit_Total_Price'] = null;
    endif; 
    ?>