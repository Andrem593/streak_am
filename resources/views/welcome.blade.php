<x-plantilla>

    @push('css')
        <style>
            .breadcrumb {
                display: inline-block;
                padding: 0;
                margin: 0;
                background: transparent;
                overflow: hidden;
            }

            .breadcrumb li {
                float: left;
                padding: 8px 15px 8px 25px;
                background: #fdec82;
                font-size: 16px;
                font-weight: bold;
                color: #777;
                position: relative;
            }
/* 
            .breadcrumb li:first-child {
                background: #fdf9cc;
            }

            .breadcrumb li:last-child {
                background: #fddc05;
                margin-right: 18px;
            } */

            .breadcrumb li:before {
                display: none;
            }

            .breadcrumb li:after {
                content: "";
                display: block;
                border-left: 20px solid #fdec82;
                border-top: 20px solid transparent;
                border-bottom: 20px solid transparent;
                position: absolute;
                top: 0;
                right: -20px;
                z-index: 1;
                -webkit-filter: drop-shadow(1px 0px 0px rgba(0,0,0,.5));
                filter: drop-shadow(1px 0px 0px rgba(0,0,0,.5));
            }
/* 
            .breadcrumb li:first-child:after {
                border-left-color: #fdf9cc;
            }

            .breadcrumb li:last-child:after {
                border-left-color: #fddc05;
            } */

            .breadcrumb li a {
                font-size: 16px;
                font-weight: bold;
                color: #777;
            }

            @media only screen and (max-width: 479px) {
                .breadcrumb li {
                    padding: 8px 15px 8px 30px;
                }
            }

        </style>
    @endpush

    <div class="container text-center">

        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
</x-plantilla>
