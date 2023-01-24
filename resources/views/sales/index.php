<div class="row  d-flex justify-content-center user-contorllers ">
    <div class="col-lg-3 col-md-5 col-sm-12 ">
        <div class="card l-bg-orange-dark">
            <div class="card-statistic-3 p-4">
                <a href="/sales" class="ece text-decoration-none text-light   ">
                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                    <div class="mb-4 text-center">
                        <h5 class="card-title mb-0">Your Total sales </h5>
                    </div>

                    <div class="card-count-number">
                        <h2 class="text-center">

                            <span id="total-sales">0</span>

                        </h2>
                    </div>


                </a>
            </div>
        </div>
    </div>
</div>


<div class="mx-xl-5 row mx-2 ">

    <form class="  d-lg-flex  col-xl-12 col-md-10 col-sm-9 col-12 user-contorllers">
        <div class="input-group col align-items-center  mb-3 mb-md-5  mb-sm-5">
            <span class="input-group-text bg-dark text-white">Items</span>
            <select class="form-select " id="items">
                <option>Open this select menu</option>

            </select>
        </div>
        <div class="input-group col align-items-center  mb-3  mb-md-5 mx-md-5 mb-sm-5">
            <span class="input-group-text bg-dark text-white">Quantity</span>
            <input id="quantity" type="number" class="form-control" min="0" max="" value="">
        </div>

        <div class="input-group col align-items-center  mb-3  mb-md-5 mx-md-4 mb-sm-5">
            <span class="input-group-text bg-dark text-white">Price (JOD)</span>
            <input id="price" type="number" class="form-control" value="" min="0">
        </div>
        <div class="col d-flex justify-content-center align-items-center mb-md-5 mb-sm-5 ">
            <button class="btn btn-warning" id="add">Add Transaction</button>
        </div>
    </form>



    <div class="col-lg-12 col-md-11 m-md-auto mb-sm-5 top-five">
        <div class=" mb-3" id="caption">

            <caption>List Of Total Transactions </caption>
        </div>
        <div style="overflow-x:auto;">
            <table class="table table-hover Transactions-table   ">
                <thead class="table-dark fs-5 ">
                    <tr>
                        <th scope="col">Num</th>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>

                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="table-transaction">

                </tbody>
            </table>
        </div>
    </div>

</div>



<!-- 


popup


-->


<div class="popup">
    <div class="popup-desian">
        <h2 class="done">Done!</h2>

        <p>You've successfully Add Transaction!</p>

        <i class="i-done fa-sharp fa-solid fa-circle-check  btn-success"></i>
    </div>
</div>


<div class="popup-no">
    <div class="popup-desian">
        <h2 class="done">Not Done!</h2>

        <p>The quantity of this item you selected is out of stock !</p>
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

<div class="popup-accept-delete">
    <div class="popup-desian">
        <h2 class="done">Wait!</h2>

        <p>Are you sure to delete the Transactions</p>
        <i class="i-no fa-sharp fa-solid fa-question btn-danger"></i>


        <button class="yes">YES!</button>
        <button class="no">NO!</button>
    </div>

</div>