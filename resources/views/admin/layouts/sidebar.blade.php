<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{route('admin.dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh muc san pham</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('admin.category.create')}}">them danh muc san pham</a></li>
                        <li><a href="{{route('admin.category.index')}}">Liet ke danh muc san pham</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thuong hieu san pham</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('admin.brand.create')}}">them thuong hieu san pham</a></li>
                        <li><a href="{{route('admin.brand.index')}}">Liet ke thuong hieu san pham</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>san pham</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('admin.product.create')}}">them san pham</a></li>
                        <li><a href="{{route('admin.product.index')}}">Liet ke san pham</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->