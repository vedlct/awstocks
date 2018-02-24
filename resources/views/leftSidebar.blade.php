<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">

        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">Dashboard</li>
                <li>
                    <a href="{{route('main')}}"><i class="mdi mdi-gauge"></i>Stock Info</a>

                </li>
                <li>
                    <a href="{{route('product.add')}}" ><i class="fa fa-plus"></i>Enter New Product</a>

                </li>


                <li>
                    <a href="{{route('generate.file')}}"><i class="fa fa-list-alt"></i>Generate Product File</a>

                </li>

                <li>
                    <a href="{{route('offer.add')}}"><i class="fa fa-plus"></i>Enter Offer Details</a>

                </li>

                <li>
                    <a href="{{route('offer.generate')}}"><i class="fa fa-briefcase"></i>Generate Offer Files</a>

                </li>


                <li>
                    <a href="{{route('historic.files')}}"><i class="fa fa-star"></i>Historic uploaded files</a>

                </li>

                <li>
                    <a href="{{route('settings')}}"><i class="fa fa-plus-square"></i>Settings</a>

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