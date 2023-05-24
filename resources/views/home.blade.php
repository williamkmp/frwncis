@extends('layout.app')


@section('page-head')
    <style>
        .banner {
            width: 100%;
            height: 50%;
        }

        .banner img.banner{
            object-fit: cover;
        }

        .banner img.logo {
            object-fit: contain;
        }

        .overlay {
            position: absolute;
            backdrop-filter: brightness(50%);
        }
    </style>
@endsection


@section('page-content')
    <div class="container-fluid position-relative m-0 p-0 banner text-white">
        <img src="{{ asset('images/banner.jpg') }}" class="banner w-100 h-100 p-0 m-0" alt="banner">
        <div class="row position-absolute top-0 left-0 w-100 h-100 overlay">
            <div class="col w-100 h-100 p-5 d-flex justify-content-center align-items-center">
                <div class="h-75 ratio ratio-1x1">
                    <img src="{{ asset('images/logo-white.png') }}" class="logo w-100" alt="logo">
                </div>
            </div>
            <div class="col w-100 h-100 p-5 d-flex flex-column justify-content-center align-items-center">
                <h1 class="fs-1 fw-bolder">Frawncis Bakery</h1>
                <h5>Since 1918</h5>
            </div>
        </div>
    </div>

    <div class="container-fuild mt-3 d-flex flex-column justify-content-center align-items-center p-5">
        <h2 class="fw-bolder">Our Story</h2>

        <p>Since its establishment in 1918, Francis Bakery has embarked on a remarkable journey of passion, craftsmanship,
            and delighting taste buds. With a rich history spanning over a century, our bakery has become an institution
            renowned for its commitment to exceptional quality and unwavering dedication to the art of baking.</p>

        <p>Rooted in tradition, Francis Bakery was founded by the visionary baker, Mr. John Francis, who set out on a
            mission to create delectable treats that would captivate hearts and palates alike. Starting as a humble
            neighborhood bakery, our commitment to using the finest ingredients and time-honored recipes quickly garnered a
            loyal following.</p>

        <p>As the years passed, Francis Bakery flourished, expanding its offerings and enchanting customers with an
            ever-growing array of artisanal bread, delectable pastries, and mouthwatering cakes. Each creation was
            meticulously crafted, embracing both innovation and the timeless techniques that have been passed down through
            generations.</p>

        <p>With the passing of the torch to subsequent generations, the spirit of excellence continued to burn bright within
            Francis Bakery. Our skilled bakers, confectioners, and pastry chefs have inherited the traditions and secrets
            that make our products so exceptional. Their unwavering dedication and artistic flair have allowed Francis
            Bakery to preserve its reputation as a hallmark of quality and taste.</p>

        <p>Throughout the years, Francis Bakery has had the privilege of becoming an integral part of countless
            celebrations, from birthdays to weddings, and every special moment in between. Our customers have come to rely
            on us for the perfect loaf of bread, the show-stopping cake, or the indulgent pastry that brings joy to their
            lives.</p>

        <p>As we step into the future, Francis Bakery remains committed to upholding the values that have defined us for
            more than a century. We continue to embrace innovation while staying true to our heritage, ensuring that every
            bite from Francis Bakery evokes memories, sparks happiness, and leaves an indelible mark on your palate.</p>

        <p>Join us on this extraordinary journey as we strive to delight your senses and create moments of pure bliss
            through our exceptional baked goods. Francis Bakery: where tradition meets taste, and every bite tells a story.
        </p>
    </div>
@endsection
