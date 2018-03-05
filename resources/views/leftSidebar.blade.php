<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">

        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">Dashboard</li>
                <li>
                    <a href="{{route('stockinfo')}}"><i class="mdi mdi-gauge"></i><span class="hide-menu">Stock Info</span></a>

                </li>
                <li>
                    <a href="{{route('product.add')}}" ><i class="fa fa-plus"></i><span class="hide-menu">Enter New Product</span></a>

                </li>


                <li>
                    <a href="{{route('product.list')}}"><i class="fa fa-list-alt"></i><span class="hide-menu">Product List</span></a>

                </li>

                <li>
                    <a href="{{route('offer.add')}}"><i class="fa fa-plus"></i><span class="hide-menu">Enter Offer Details</span></a>

                </li>

                <li>
                    <a href="{{route('offer.generate')}}"><i class="fa fa-briefcase"></i><span class="hide-menu">Generate Offer Files</span></a>

                </li>


                <li>
                    <a href="{{route('historic.files')}}"><i class="fa fa-star"></i><span class="hide-menu">Historic uploaded files</span></a>

                </li>

                <li>
                    <a href="{{route('settings')}}"><i class="fa fa-plus-square"></i><span class="hide-menu">Settings</span></a>

                </li>






                <li class="nav-devider"></li>


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->

        <a href="#" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>