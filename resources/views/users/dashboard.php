<div class="row  ms-md-5 m-lg-auto  d-flex justify-content-center  mx-3 ">
    <div class="col-lg-3 col-md-6 col-sm-12 col-10   ">
        <div class="card l-bg-green-dark">
            <div class="card-statistic-3 p-4">
                <a href="/accountant" class="ece text-decoration-none text-light   ">
                    <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                    <div class="mb-4 text-center">
                        <h5 class="card-title mb-0">Total Transactions </h5>
                    </div>
                    <div class="card-count-number">

                        <h2 class=" text-center fs-1">
                            <?= $data->count_transaction ?>
                        </h2>


                    </div>
                </a>
            </div>
        </div>
    </div>





    <div class="col-lg-3 col-md-6 col-sm-12  col-10 ">
        <div class="card l-bg-orange-dark">
            <div class="card-statistic-3 p-4">
                <a href="/sales" class="ece text-decoration-none text-light   ">
                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                    <div class="mb-4 text-center">
                        <h5 class="card-title mb-0">Total Sales </h5>
                    </div>
                    <div class="card-count-number">

                        <h2 class="text-center fs-1">

                            <?= $data->total_sales ?>

                        </h2>


                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="col-lg-3  col-md-6 col-sm-12 col-10 ">

        <div class="card l-bg-cherry">

            <div class="card-statistic-3 p-4 ">
                <a href="/items" class="ece text-decoration-none text-light   ">
                    <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart "></i></div>
                    <div class="mb-4 text-center">
                        <h5 class="card-title mb-0">Total Items Number</h5>
                    </div>
                    <div class="card-count-number">
                        <h2 class=" text-center fs-1">
                            <?= $data->total_quantity ?>

                        </h2>
                    </div>

                </a>
            </div>

        </div>
    </div>



    <div class="col-lg-3 col-md-6  col-sm-12 col-10   mb-2 ">

        <div class="card l-bg-blue-dark">

            <div class="card-statistic-3 p-4">
                <a href="/users" class="ece text-decoration-none text-light   ">
                    <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                    <div class="mb-4 text-center">
                        <h5 class="card-title mb-0">All Users</h5>
                    </div>
                    <div class="card-count-number">
                        <h2 class=" text-center fs-1">
                            <?= $data->count_user ?>
                        </h2>
                    </div>

                </a>
            </div>
        </div>

    </div>


</div>




<div class="row">
    <div class=" col-lg-12  col-md-11 col-11  m-auto     top-five">
        <div class=" mb-2  fs-6  ">
            <caption>Top Five Expensive Items To Buy</caption>


        </div>
        <div style="overflow-x:auto;">
            <table class="table table-hover">
                <thead class="table-dark fs-5">
                    <tr>
                        <th scope="col">Num</th>
                        <th scope="col">Name</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Selling Price</th>
                        <th scope="col">Quantity</th>

                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id = 0;
                    foreach ($data->five_item as $item):
                        $id++;
                   ?>
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= $item->name ?></td>
                        <td><?= $item->cost ?></td>
                        <td><?= $item->selling_price ?></td>
                        <td><?= $item->	quantity ?></td>

                        <td>
                            <a href="./item?id=<?= $item->id ?>">
                                <i class="fa-sharp fa-solid fa-eye text-dark mx-2"></i></a>


                        </td>

                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>