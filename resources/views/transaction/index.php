<div class="row  d-flex justify-content-center  user-contorllers">

    <div class="col-xl-3 col-lg-8 col-md-6 col-sm-12">
        <div class="card l-bg-green-dark">
            <div class="card-statistic-3 p-4">
                <a href="/accountant" class="ece text-decoration-none text-light   ">
                    <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                    <div class="mb-4 text-center">
                        <h5 class="card-title mb-0">All Transactions</h5>
                    </div>
                    <div class="card-count-number">
                        <h2 class=" text-center">
                            <?php if(!empty($data->count_transaction)) : ?>
                            <?=  $data->count_transaction ?>
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="card-count-number text-centr fs-5 mt-4">
                        <strong> Total Sales: </strong>
                        <?= $data-> total_sales ?>
                    </div>
                </a>
            </div>


        </div>

    </div>


    <form method="GIT" action="/accountant/find">


        <div class="search_user input-group  w-50  m-sm-auto ">
            <input type="text" class="form-control" placeholder="Search for transactions of a particular user by email "
                aria-label="Recipient's username" aria-describedby="button-addon2" name="email">
            <button class="btn btn-outline-primary sehrch-transactions" type="submit"
                id="button-addon2 ">Sehrch</button>
        </div>


        <?php if (!empty($_SESSION) && isset($_SESSION['transaction']['not_find_email']) && !empty($_SESSION['transaction']['not_find_email'])) : ?>

        <div class="error  ">
            <?= $_SESSION['transaction']['not_find_email'] ?>
        </div>
        <?php
$_SESSION['transaction']['not_find_email'] = null;
endif; 
?>
    </form>
</div>




<div class="all-transactions col-lg-11  col-md-11   m-md-auto mb-sm-5  mx-3 top-five ">
    <div class="mb-3">
        <caption>List Of All Transactions </caption>

    </div>
    <div style="overflow-x:auto;">
        <table class="table  table-hover ">
            <thead class="table-success fs-5 ">
                <tr>
                    <th scope="col">Num</th>
                    <th scope="col">Item</th>
                    <th scope="col">Sold By</th>
                    <th scope="col">Selling Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>

                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                  $id = 0; 
                if ($data->transactions ) {
                 ?>
                <?php foreach ($data->transactions as $transaction):
                      $id++; ?>
                <tr>

                    <td><?= $id ?></td>
                    <td><?= $transaction->name ?></td>
                    <td><?= $transaction->display_name ?></td>
                    <td><?= $transaction->selling_price ?></td>
                    <td><?= $transaction->quntity_item ?></td>
                    <td><?= $transaction->total ?></td>

                    <td>
                        <a href="/single?id=<?= $transaction->transactions_id ?>" class="btn btn-success">
                            More</a>



                    </td>

                </tr>
                <?php endforeach;
            } ?>

            </tbody>
        </table>
    </div>



</div>