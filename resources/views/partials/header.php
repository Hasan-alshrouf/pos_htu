<?php

use Core\Helpers\Helper; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon"
        href="<?=  $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/img/Kids-Finance.jpg">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
        integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

    <link rel="stylesheet"
        href="<?=  $_SERVER['REQUEST_SCHEME'] . "://" .$_SERVER['HTTP_HOST'] ?>/resources/css/dashboard/styles.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg  " id="Home">
        <div class="collapse navbar-collapse" id="clock">

            <a class="navbar-brand   " href="#">
                <img src="<?=  $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/views/partials/logo1.jpg"
                    alt="">

            </a>

        </div>






        <?php if (Helper::check_permission(['role:admin' ])) : ?>
        <a class="  li-dashboard nav-link p-4   " href="/dashboard">HOME DASHBOARD</a>
        <?php endif; ?>


        <div class="img_header">
            <?php if (empty($data->user_picture->picture)) : ?>
            <img src="/resources/img/168882.png" alt="">
            <?php else : ?>
            <img src="<?=  $_SERVER['REQUEST_SCHEME'] . "://" .$_SERVER['HTTP_HOST'] ?>/resources/img/<?= $data->user_picture->picture ?>"
                alt="">
            <?php endif;  ?>
        </div>



        <!-- dropdown -->
        <div class="dropdown d-lg-none d-sm-block ">
            <button class="btn btn-secondary " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-sharp fa-solid fa-bars-staggered fs-2"></i>
            </button>
            <ul class="dropdown-menu bg-black  ">

                <?php if (Helper::check_permission(['role:seller' ])) : ?>
                <li class=" m-3 ">

                    <a class=" nav-link  dropdown-item  " href="/sales "> <i
                            class="fa-sharp fa-solid fa-dollar-sign  text-secondary"> </i> Sales</a>
                </li>

                <?php endif; 
                     if (Helper::check_permission(['role:accountant' ])) : ?>
                <li class=" m-3 ">
                    <a class=" nav-link  dropdown-item " href="/accountant">
                        <i class="fas fa-ticket-alt text-secondary"> </i> Transactions</a>
                </li>
                <?php endif; 
                    if (Helper::check_permission(['role:procurement' ])) : ?>
                <li class="m-3  ">
                    <a class=" nav-link   dropdown-item " href="/items">
                        <i class="fa-sharp fa-solid fa-layer-group text-secondary"> </i> Items Stock</a>
                </li>
                <?php endif; 
                     if (Helper::check_permission(['role:admin' ])) : ?>
                <li class=" m-3 ">
                    <a class=" nav-link  dropdown-item " href="/users">
                        <i class="fa-sharp fa-solid fa-user text-secondary"> </i> Users</a>
                </li>
                <?php endif; ?>
                <li class="m-3  ">
                    <a class="nav-link   dropdown-items " href="/profile"> My
                        profile
                        <i class="fa-sharp fa-solid fa-address-card"></i>
                    </a>
                </li>
                <li class="m-3  ">
                    <a class="nav-link dropdown-items " href="/logout">Logout
                        <i class="fa-sharp fa-solid fa-right-from-bracket"></i>
                    </a>
                </li>
            </ul>
        </div>



        <a class="btn-my-profile btn   text-bg-light d-lg-block d-sm-none d-none" href="/profile"> My profile
            <i class="fa-sharp fa-solid fa-address-card"></i>
        </a>
        <a class="btn btn-secondary d-lg-block d-sm-none d-none" href="/logout">Logout
            <i class="fa-sharp fa-solid fa-right-from-bracket"></i>
        </a>
        <div class="digital-clock ms-3 me-4 fs-3  ">00:00</div>




    </nav>


    <div class=" row  " id="addd">
        <div class="nav2  col-lg-2  text-center d-lg-block d-sm-none d-none" id="nav2 ">
            <nav id="navbar-side" class="h-100 flex-column align-items-stretch  border-end">
                <ul class="navbar-nav ms-auto  mb-lg-0">
                    <li class=" nav-itemm mt-4  ">

                        <span class="title-word title-word-1 fs-3">Welcome !</span>
                        <div class="title fs-2">
                            <hr>

                        </div>

                    </li>
                    <?php if (Helper::check_permission(['role:seller' ])) : ?>
                    <li class=" nav-itemm  ">

                        <a class=" nav-link p-lg-4  " href="/sales "> <i
                                class="fa-sharp fa-solid fa-dollar-sign  text-secondary"> </i> Sales</a>
                    </li>

                    <?php endif; 
                     if (Helper::check_permission(['role:accountant' ])) : ?>
                    <li class=" nav-itemm">
                        <a class=" nav-link p-lg-4 " href="/accountant">
                            <i class="fas fa-ticket-alt text-secondary"> </i> Transactions</a>
                    </li>
                    <?php endif; 
                    if (Helper::check_permission(['role:procurement' ])) : ?>
                    <li class=" nav-itemm">
                        <a class=" nav-link p-lg-4  " href="/items">
                            <i class="fa-sharp fa-solid fa-layer-group text-secondary"> </i> Items Stock</a>
                    </li>
                    <?php endif; 
                     if (Helper::check_permission(['role:admin' ])) : ?>
                    <li class=" nav-itemm">
                        <a class=" nav-link p-lg-4  " href="/users">
                            <i class="fa-sharp fa-solid fa-user text-secondary"> </i> Users</a>
                    </li>
                    <?php endif; ?>





                </ul>

            </nav>
        </div>
        <div class="col-lg-10  col-md-9 col-sm-6   mt-5 mb-5  ">