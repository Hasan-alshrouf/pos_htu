<div id="template" class="row py-2">


    <div class="col">
        <div class="mt-5 d-flex flex-row-reverse gap-3">
            <a href="/items/edit?id=<?= $data->item_one->id ?>" class="btn btn-warning">
                Edit </a>
            <a href="/items/delete?id=<?= $data->item_one->id ?>" class="btn btn-danger">
                Delete </i>
            </a>
            <a href="/items" class="btn btn-secondary">Back
                <i class="fa-sharp fa-solid fa-backward"></i>
            </a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>Name</td>
                    <td><?= $data->item_one->name ?></td>
                </tr>
                <tr>
                    <td>Description Item</td>

                    <td><?php  
                    if(!empty($data->item_one->Description)) : ?>
                        <?=  $data->item_one->Description?>
                        <?php else :  ?>
                        No description

                    </td>
                    <?php endif?>
                </tr>
                <tr>
                    <td>Cost</td>
                    <td><?=$data->item_one->cost ?></td>
                </tr>
                <tr>
                    <td>Selling Price</td>
                    <td><?= $data->item_one->selling_price ?></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><?= $data->item_one->quantity ?></td>
                </tr>

                <tr>
                    <td>Created_at</td>
                    <td><?= $data->item_one->created_at ?></td>
                </tr>
                <tr>
                    <td>Updated_at</td>
                    <td><?= $data->item_one->updated_at ?></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>