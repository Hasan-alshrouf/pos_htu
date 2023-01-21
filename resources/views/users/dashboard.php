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







<div class="row mt-3 ">
    <div class=" col-lg-6  col-md-11 col-11   mb-5   top-five2 ms-4 ">
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
                        <td><?php  
                    if($item->quantity != 0): ?>
                            <?= $item->quantity?>
                            <?php else :  ?>
                            0 (Empty)

                        </td>
                        <?php endif?>

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
    <div class=" col-lg-5  col-md-12 col-12  top-five-das">
        <p class="text-dark">Distribution of sold items </p>
        <canvas id="myChart"></canvas>
    </div>


</div>



<div class="row ">
    <div class=" col-lg-4  col-md-11 col-11  mt-3    top-five2  ms-4 me-3 ">

        <p class="text-dark mb-5">The quantity in stock for each item </p>
        <p class="quantity-in-stock"> </p>

        <div style="overflow-x:auto;">


            <?php foreach ($data->quantity_item as $item) :   ?>


            <div class="mb-4">

                <div class=" d-flex justify-content-between me-2">
                    <p class="text-muted"><?= $item->name ?></p>
                    <p class="text-dark"> <?= $item->quantity?></p>
                </div>
                <div class="progress ">

                    <div class="progress-bar progress-quantity " data-progress=" <?= $item->quantity ?>">
                    </div>
                </div>
            </div>
            <?php endforeach; ?>



        </div>
    </div>


    <div class=" col-lg-7  col-md-11 col-11  mt-3    top-five2  ms-lg-5 mx-4">

        <p class="text-dark mb-5">Total sales for each day in the last week </p>
        <p class="quantity-in-stock"> </p>

        <div style="overflow-x:auto;">

            <?php if(!empty($data->last_week)): ?>

            <?php foreach ($data->last_week as $item):?>


            <div class="mb-4">

                <div class=" d-flex justify-content-between me-2">
                    <p class="text-muted"><?= $item->day ?></p>
                    <p class="text-dark"> <?= $item->total?>$</p>
                </div>
                <div class="progress  ">

                    <div class="progress-bar bg-success progress-total" data-progress=" <?= $item->total ?>">
                    </div>
                </div>


            </div>
            <?php endforeach; ?>
            <?php if(count($data->last_week) < 7):?>
            <div class="mt-5  rounded w-75 m-auto l-bg-green-dark digital">
                <p class="fs-4 ">The remaining (<?= 7 - count($data->last_week)  ?>) days do not contain any
                    sales
                </p>
            </div>

            <?php endif; ?>

            <?php else : ?>
            <div class="mt-5  rounded w-75 m-auto l-bg-green-dark digital">
                <p class="fs-4 ">Last week contains no sales


                </p>
            </div>
            <?php endif; ?>




        </div>
    </div>
</div>