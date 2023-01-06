<div class="row  d-flex justify-content-center user-contorllers">
    <div class="col-xl-3 col-lg-6  col-md-6 col-sm-12  ">
        <div class="card l-bg-cherry">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                <div class="mb-4 text-center">
                    <h5 class="card-title mb-0">All Items</h5>
                </div>
                <div class="card-count-number">
                    <h2 class=" text-center">
                        <?= $data->count ?>
                    </h2>
                </div>


            </div>

        </div>
    </div>

    <form method="GIT" action="./item/find">


        <div class="search_user input-group w-50    ">
            <input type="text" class="form-control" placeholder="Search for a Item by name"
                aria-label="Recipient's username" aria-describedby="button-addon2" name="name">
            <button class="btn btn-outline-primary" type="submit" id="button-addon2 ">Sehrch</button>
        </div>

        <?php if (!empty($_SESSION) && isset($_SESSION['item']['not_find_item']) && !empty($_SESSION['item']['not_find_item'])) : ?>

        <div class="error  ">
            <?= $_SESSION['item']['not_find_item'] ?>
        </div>
        <?php
                $_SESSION['item']['not_find_item'] = null;
                endif; 
                ?>


    </form>
    <div>

    </div>
</div>



<div class="col-lg-11 col-md-11 m-md-auto mb-sm-5 top-five  mx-2">
    <div class="d-flex justify-content-between align-items-end mb-3  ">
        <caption>List of items </caption>
        <a href="/items/create" class="btn btn-secondary  "><i class="fa-sharp fa-solid fa-plus"></i> Add New
            Item</a>

    </div>
    <div style="overflow-x:auto;">
        <table class="table table-hover ">
            <thead class="table-active fs-5">
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Cost</th>
                    <th scope="col">Selling Price</th>
                    <th scope="col">Stock Available Quantity</th>
                    <th scope="col">Created_at</th>

                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->items as $item) : 
                $date1 = new \DateTime($item->created_at);
                $created_at = $date1->format('d/m/Y');
                ?>
                <tr>
                    <td><?= $item->id ?></td>
                    <td><?= $item->name ?></td>
                    <td><?= $item->cost ?></td>
                    <td><?= $item->selling_price ?></td>
                    <td><?= $item->	quantity ?></td>
                    <td><?= $created_at ?></td>

                    <td>
                        <a href="./item?id=<?= $item->id ?>">
                            <i class="fa-sharp fa-solid fa-eye text-dark mx-2"></i></a>

                        <a href="/items/edit?id=<?= $item->id ?>">

                            <i class="fa-sharp fa-solid fa-file-pen text-primary  mx-2"></i></a>

                        <a href="/items/delete?id=<?= $item->id ?>">

                            <i class="fa-sharp fa-solid fa-trash text-danger mx-2"></i></a>
                    </td>

                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>